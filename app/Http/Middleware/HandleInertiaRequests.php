<?php

namespace App\Http\Middleware;

use App\Models\LogHistory;
use App\Models\Menu;
use App\Models\MenuMapping;
use App\Models\Settings;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'appSettings' => Settings::first(),
            'auth'=>[
                'user' => $request->user() ? [
                    'id' => $request->user()->userId,
                    'name' => $request->user()->fullName,
                    'email' => $request->user()->email,
                    'roleId' => $request->user()->userRoleId,
                    'roleName'=>UserRole::where('userRoleId',$request->user()->userRoleId)->value('roleName'),
                    'imagePath'=> $request->user()->imagePath,
                ] : null,
            ],
            'menu'=>$request->user()?$this->getSidebarItems($request->user()->userRoleId):null,
            'notifications'=>$request->user()?$this->getUserNotifications($request->user()->userId):null,
            'flash'=>[
                'success'=>session('success'),
                'error'=>session('error'),
            ],          
        ]);
    }

    private function getSidebarItems($roleId)
    {
        $parentMenus=Menu::where('parentID',0)
            ->select('menuID','parentID','menuTitle','url','isSubMenu','sortOrder','iconClass')
            ->orderBy('sortOrder')
            ->get();
        $sidebar=array();
        foreach($parentMenus as $menu){
            $menuGroup=UserRole::where('userRoleId',$roleId)
            ->select('menuGroupId')
            ->first();

            $childMenus=Menu::from('menu as m1')
            ->where('m1.parentID',$menu->menuID)
            ->where('m1.menuID','=',DB::raw('(select menuId from menugroupwisemenumapping where menuGroupId='.$menuGroup->menuGroupId.' and menuId=m1.menuID)'))
            ->select('m1.menuID as id','m1.menuTitle as title','m1.url as route')
            ->get();

            if(count($childMenus)>0){
                $sidebar[]=[
                    'id'=>$menu->menuID,
                    'title'=>$menu->menuTitle,
                    'icon'=>$menu->iconClass,
                    'route'=>$menu->url,
                    'order'=>$menu->sortOrder,
                    'childItems'=>$childMenus
                ];
            }else{
                $checkMenu=MenuMapping::where('menuGroupId',$menuGroup->menuGroupId)
                ->where('menuId',$menu->menuID)
                ->get();
                if(count($checkMenu)>0){
                    $sidebar[]=[
                        'id'=>$menu->menuID,
                        'title'=>$menu->menuTitle,
                        'icon'=>$menu->iconClass,
                        'route'=>$menu->url,
                        'order'=>$menu->sortOrder,
                        'childItems'=>[]
                    ];
                }    
            }   
        }
        return $sidebar;            
                
    }   

    private function getUserNotifications($userId){
        $notificationsRecord=LogHistory::join('users','users.userId','=','loghistory.userId')
            ->select('users.userId','fullName','email','logInTime','logOutTime','ip','browser','browserVersion','platform')
            ->where('users.userId',$userId)
            ->whereDate('loghistory.logDate','>=',Carbon::now()->subDays(3))
            ->get();

        return ['data'=>$notificationsRecord,'recordsTotal'=>count($notificationsRecord),'recordsFiltered'=>count($notificationsRecord)];
    }
}
