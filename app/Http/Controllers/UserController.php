<?php

namespace App\Http\Controllers;

use App\Models\LogHistory;
use App\Models\MenuGroup;
use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function ShowSignIn():Response
    {
        return Inertia::render('signIn');
    }

    public function SignIn(Request $request):RedirectResponse
    {
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('user.show-dashboard')->with('success','Successfully sign in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function SignOut(Request $request):RedirectResponse
    {
        LogHistory::where('logCode',$request->session()->token())->update([
            'logOutTime'=>now(),
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.show-signIn')->with('success','Successfully sign out');
    }

    public function Register(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'fullName'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        $validated['userRoleId']=2;
        $validated['addedBy']=1;
        if ($validated) {
            User::create($validated);
            if(Auth::attempt(['email'=>$validated['email'],'password'=>$validated['password']]))
            {
                $request->session()->regenerate();
                return redirect()->route('user.show-dashboard')->with('success','Successfully registered and sign in');
            }
        }       
        return back()->withErrors(['email'=>'Some Error Occurred'])->onlyInput('email');
    }

    public function StoreLogHistory(Request $request):void
    {
        LogHistory::create([
            'logCode'=>$request->session()->token(),
            'userId'=>Auth::user()->userId,
            'logDate'=>date('Y-m-d'),
            'logInTime'=>now(),
            'browser'=>$request->browser,
            'browserVersion'=>$request->browserVersion,
            'platform'=>$request->platform,
            'ip'=>$request->ipAddress,
        ]);
    }
    

    public function ShowDashboard()
    {
        //user status
        $totalUser=User::count();
        $activeUser=User::where('isActive',true)->count();
        $inActiveUser=User::where('isActive',false)->count();
        $adminUser=User::where('userRoleId',1)->count();
        $userStatus=[
            'totalUser'=>$totalUser,
            'activeUser'=>$activeUser,
            'inActiveUser'=>$inActiveUser,
            'adminUser'=>$adminUser,
        ];
        
        //login summary by date
        $dateQuery = LogHistory::select('logDate as date', DB::raw('count(*) as count'))
            ->groupBy('logDate')
            ->orderBy('logDate', 'desc')
            ->take(10);

        if (Auth::user()->userRoleId != 1) {
            $dateQuery->where('userId', Auth::user()->userId);
        }

        $logHistoryByDate = $dateQuery->get();

        //login summary by month
        $monthQuery = LogHistory::select(DB::raw('month(logDate) as month,count(*) as count'))
        ->orderBy(DB::raw('month(logDate)'))
        ->groupBy(DB::raw('month(logDate)'));

        if (Auth::user()->userRoleId != 1) {
            $monthQuery->where('userId', Auth::user()->userId);
        }

        $logHistoryByMonth = $monthQuery->get();

        //login summary by year
        $monthQuery = LogHistory::select(DB::raw('year(logDate) as year,count(*) as count'))
        ->orderBy(DB::raw('year(logDate)'))
        ->groupBy(DB::raw('year(logDate)'));

        if (Auth::user()->userRoleId != 1) {
            $monthQuery->where('userId', Auth::user()->userId);
        }

        $logHistoryByYear = $monthQuery->get();

        //browser summary
        $browserQuery=LogHistory::select('browser',DB::raw('count(*) as count'))
        ->groupBy('browser'); 

        if (Auth::user()->userRoleId != 1) {
            $browserQuery->where('userId', Auth::user()->userId);
        }

        $logHistoryByBrowser = $browserQuery->get();

        //role wise user
        $roleWiseUser=User::join('userrole','users.userRoleId','=','userrole.userRoleId')
            ->select('userrole.roleName',DB::raw('count(*) as count'))
            ->groupBY('userrole.roleName')
            ->get();
        
        return Inertia::render('dashboard',
            [
                //'userStatus'=>$userStatus,
                'userStatus'=>Inertia::defer(fn()=>$userStatus),
                'logHistoryByDate'=>$logHistoryByDate,
                'logHistoryByMonth'=>$logHistoryByMonth,
                'logHistoryByYear'=>$logHistoryByYear,
                'logHistoryByBrowser'=>$logHistoryByBrowser,
                'roleWiseUser'=>$roleWiseUser,               
            ]
        );
    }

    public function ShowChangePassword()
    {
        return Inertia::render('user/changePassword');
    }

    public function ChangePassword()
    {
        $validated = request()->validate([
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8',
        ]);
        if($validated['password']!=$validated['confirmPassword'])
        {
            return back()->withErrors(['password' => 'Password and confirm password do not match'])->onlyInput('email');
        }
        $user=User::where('userId',Auth::user()->userId)->first();
        $user->password=$validated['password'];
        $user->lastUpdatedBy=Auth::user()->userId;
        $user->lastUpdatedDate=now();
        $user->save();
        return back()->with('success','Password changed successfully');
    }

    public function ShowProfile()
    {
        return Inertia::render('user/profile',
            [
                'userInfo'=>User::where('userId',Auth::user()->userId)->first(),
            ]
        );
    }

    public function UpdateProfile()
    {
        $validated = request()->validate([
            'fullName'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mobile'=> 'nullable|string|max:15',
            'dateOfBirth'=>'nullable|string'
        ]);
        $user=User::where('userId',Auth::user()->userId)->first();
        $user->fullName=$validated['fullName'];
        $user->email=$validated['email'];
        $user->mobile=$validated['mobile'];
        $user->dateOfBirth=$validated['dateOfBirth'];
        if(request()->hasFile('image'))
        {
            $fileName=Carbon::now()->timestamp.'.'.$validated['image']->extension();
            $validated['image']->move(public_path('images'),$fileName);
            $user->imagePath=$fileName;
        }
        $user->lastUpdatedBy=Auth::user()->userId;
        $user->lastUpdatedDate=now();
        $user->save();
        return back()->with('success','Profile updated successfully')->with('userInfo',$user);
    }

    public function UnLock()
    {
        $validated = request()->validate([
            'password' => 'required|string|min:8',
        ]);
        if(Auth::attempt(['email'=>Auth::user()->email,'password'=>$validated['password']]))
        {
            return back()->with('success','Successfully unlocked');
        }
        return back()->withErrors(['password' => 'Invalid credentials'])->onlyInput('email');
    }

    public function ShowUserList()
    {
        $userList=User::join('userrole','users.userRoleId','userrole.userRoleId')
        ->select(
            'users.userId',
            'users.userRoleId',
            'userrole.roleName',
            'users.fullName',
            'users.email',
            'users.password',
            'users.mobile',
            'users.dateOfBirth',
            'users.imagePath',
            'users.forgetPasswordRef',
            'users.addedBy'
        )
        ->get();
        $roleList=DB::table('userrole')->get();
        return Inertia::render('user/userList',
            [
                'userList'=>$userList,
                'roleList'=>$roleList,
            ]
        );
    }

    public function AddUser(): RedirectResponse
    {
        $validated = request()->validate([
            'userRoleId'=>'required|integer',
            'fullName'=>'required|string|max:255',
            'password'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mobile'=> 'nullable|string|max:15',
            'dateOfBirth'=>'nullable|string'
        ]);
        $fileName=null;
        if(request()->hasFile('image'))
        {
            $fileName=Carbon::now()->timestamp.'.'.$validated['image']->extension();
            $validated['image']->move(public_path('images'),$fileName);
        }
        if ($validated) {
            User::create([
                'userRoleId'=>request()->userRoleId,
                'fullName'=>request()->fullName,
                'email'=>request()->email,
                'password'=>request()->password,
                'mobile'=>request()->mobile,
                'dateOfBirth'=>request()->dateOfBirth,
                'imagePath'=>$fileName,
                'addedBy'=>Auth::user()->userId
            ]);
            return redirect()->route('user.show-users')->with('success', 'User added successfully.');
        }
        return redirect()->route('user.show-users')->with('error', 'Some error occurred.');
    }

    public function UpdateUser():RedirectResponse
    {
        $validated = request()->validate([
            'userId'=>'required|integer',
            'userRoleId'=>'required|integer',
            'fullName'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mobile'=> 'nullable|string|max:15',
            'dateOfBirth'=>'nullable|string'
        ]);
        $user=User::where('userId',$validated['userId'])->first();
        $user->userRoleId=$validated['userRoleId'];
        $user->fullName=$validated['fullName'];
        $user->email=$validated['email'];
        $user->mobile=$validated['mobile'];
        $user->dateOfBirth=$validated['dateOfBirth'];
        if(request()->hasFile('image'))
        {
            $fileName=Carbon::now()->timestamp.'.'.$validated['image']->extension();
            $validated['image']->move(public_path('images'),$fileName);
            $user->imagePath=$fileName;
        }
        $user->lastUpdatedBy=Auth::user()->userId;
        $user->lastUpdatedDate=now();
        $user->save();
        return back()->with('success','User updated successfully');
    }

    public function DeleteUser(): RedirectResponse
    {
        $validated = request()->validate([
            'userId' => 'required|integer',
        ]);
        $user = User::find($validated['userId']);
        if ($user) {
            $user->delete();
            return redirect()->route('user.show-users')->with('success', 'User deleted successfully.');
        }
        return redirect()->route('user.show-users')->with('error', 'User not found.');
    }

    public function ShowUserRoles():Response
    {
        $roles=UserRole::join('menugroup','userrole.menuGroupId','=','menugroup.menuGroupId')
        ->select('userRoleId','roleName','roleDesc','menugroup.menuGroupId','menuGroupName')
        ->get();
        $menuGroups=MenuGroup::all();
        return Inertia::render('user/roleList',
            [
                'roles'=>$roles,
                'menuGroups'=>$menuGroups,
            ]
        );
    }

    public function AddRole(): RedirectResponse
    {
        $validated = request()->validate([
            'roleName'=>'required|string|max:255',
            'roleDesc'=>'required|string|max:255',
            'menuGroupId'=>'required|integer'
        ]);
        $validated['addedBy']=Auth::user()->userId;
        if ($validated) {
            UserRole::create($validated);
            return redirect()->route('user.show-roles')->with('success', 'Role added successfully.');
        }
        return redirect()->route('user.show-roles')->with('error', 'Some error occurred.');
    }
    public function UpdateRole(): RedirectResponse
    {
        $validated = request()->validate([
            'userRoleId'=>'required|integer',
            'roleName'=>'required|string|max:255',
            'roleDesc'=>'required|string|max:255',
            'menuGroupId'=>'required|integer'
        ]);
        $role=UserRole::where('userRoleId',$validated['userRoleId'])->first();
        $role->roleName=$validated['roleName'];
        $role->roleDesc=$validated['roleDesc'];
        $role->menuGroupId=$validated['menuGroupId'];
        $role->lastUpdatedBy=Auth::user()->userId;
        $role->lastUpdatedDate=now();
        $role->save();
        return back()->with('success','Role updated successfully');
    }

    public function DeleteRole(): RedirectResponse
    {
        $validated = request()->validate([
            'userRoleId' => 'required|integer',
        ]);
        $role = UserRole::find($validated['userRoleId']);
        if ($role) {
            $role->delete();
            return redirect()->route('user.show-roles')->with('success', 'Role deleted successfully.');
        }
        return redirect()->route('user.show-roles')->with('error', 'Role not found.');
    }
}
