<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuGroup;
use App\Models\MenuMapping;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class MenuController extends Controller
{
    public function ShowMenuList():Response
    {
        $menus=Menu::from('menu as m1')
            ->select('m1.menuID','m1.menuTitle','m1.url','m1.isSubMenu','m1.sortOrder','m1.iconClass','m1.parentID')
            ->selectSub(
                Menu::from('menu as m2')
                ->whereColumn('m2.menuID','m1.parentID')
                ->limit(1)
                ->select('menuTitle'),
                'parentMenuName'
            )
            ->orderBy('m1.sortOrder','desc')
            ->get();

        $parentInitial=array(['id'=>0,'text'=>'Root']);
        $data=Menu::where([
            ['parentID',0],
            ['isSubMenu',1]
        ])
        ->select('menuId as id','menuTitle as text')
        ->get()
        ->toArray();

        $parentMenus=array_merge($parentInitial,$data);
        return inertia('menu/menuList',[
            'menus'=>$menus,
            'parentMenus'=>$parentMenus
        ]);
    }

    public function AddMenu():RedirectResponse
    {
        $validated=request()->validate([
            'parentID'=>'required|integer',
            'menuTitle'=>'required|string|unique:menu',
            'url'=>'nullable|string',
            'isSubMenu'=>'required|integer',
            'sortOrder'=>'required|integer',
            'iconClass'=>'nullable|string',
        ]);
        
        if(Menu::where([['sortOrder','=',request()->sortOrder],['parentID','=',0],['sortOrder','>',0]])->get()->count()>0)
        {
            return back()->withErrors(['sortOrder' => 'Duplicate Order No.'])->onlyInput('sortOrder');
        }
        else if(request()->parentID==0 && request()->sortOrder<=0)
        {
            return back()->withErrors(['sortOrder' => 'Order No. must greater than 0.'])->onlyInput('sortOrder');
        }
        else
        {
            $validated['addedBy']=Auth::user()->userId;
            Menu::create($validated);
            return redirect()->route('menu.show-menus')->with('success', 'Menu added successfully.');
        }
    }

    public function UpdateMenu():RedirectResponse
    {
        $validated = request()->validate([
            'menuID' => 'required|integer',
            'parentID' => 'required|integer',
            'menuTitle' => 'required|string',
            'url' => 'nullable|string',
            'isSubMenu' => 'required|integer',
            'sortOrder' => 'required|integer',
            'iconClass' => 'nullable|string',
        ]);

        if(Menu::where([['menuTitle','=',request()->menuTitle],['menuID','!=',request()->menuID]])->get()->count()>0){
            return back()->withErrors(['menuTitle' => 'Duplicate Menu Title'])->onlyInput('menuTitle');
        }else if (Menu::where([['sortOrder','=',request()->sortOrder],['parentID','=',0],['menuID','!=',request()->menuID]])->get()->count()>0) {
            return back()->withErrors(['sortOrder' => 'Duplicate Order No.'])->onlyInput('sortOrder');
        } else if (request()->parentID == 0 && request()->sortOrder <= 0) {
            return back()->withErrors(['sortOrder' => 'Order No. must greater than 0.'])->onlyInput('sortOrder');
        } else {
            $menu = Menu::find($validated['menuID']);
            if ($menu) {
                $validated['lastUpdatedBy'] = Auth::user()->userId;
                $menu->update($validated);
                return redirect()->route('menu.show-menus')->with('success', 'Menu updated successfully.');
            }
            return redirect()->route('menu.show-menus')->with('error', 'Menu not found.');
        }
    }

    public function DeleteMenu():RedirectResponse
    {
        $validated = request()->validate([
            'menuID' => 'required|integer',
        ]);
        $menu = Menu::find($validated['menuID']);
        if ($menu) {
            $menu->delete();
            return redirect()->route('menu.show-menus')->with('success', 'Menu deleted successfully.');
        }
        return redirect()->route('menu.show-menus')->with('error', 'Menu not found.');
    }

    public function ShowSidebarMenu($menuGroupId)
    {     
        $parentMenus=Menu::where('parentID',0)
        ->select('menuID','parentID','menuTitle','url','isSubMenu','sortOrder','iconClass')
        ->orderBy('sortOrder')
        ->get();
        $sidebar=array();
        foreach($parentMenus as $menu){
            $childMenus=Menu::from('menu as m1')
            ->where('m1.parentID',$menu->menuID)
            ->select('m1.menuID as id','m1.menuTitle as title')
            ->selectRaw('? as groupId', [$menuGroupId])
            ->selectSub(
                MenuMapping::where('menuGroupId',$menuGroupId)
                ->whereColumn('menuId','m1.menuID')
                ->limit(1)
                ->selectRaw('count(*)'),
                'isSelected'
            )             
            ->get();

            if(count($childMenus)>0){
                $sidebar[]=[
                    'id'=>$menu->menuID,
                    'title'=>$menu->menuTitle,
                    'isParentSelected'=>true,
                    'groupId'=>$menuGroupId,
                    'children'=>$childMenus->map(function($child){
                        $child->isSelected=$child->isSelected>0?true:false;
                        return $child;
                    })->toArray()
                ];
            }else{
                $checkMenu=MenuMapping::where('menuGroupId',$menuGroupId)
                ->where('menuId',$menu->menuID)
                ->exists();
                $sidebar[]=[
                    'id'=>$menu->menuID,
                    'title'=>$menu->menuTitle,
                    'isParentSelected'=>$checkMenu,
                    'groupId'=>$menuGroupId,
                    'children'=>[]
                ];                  
            }
        }
        /* return Inertia::render('menu/AssignMenu', [
            'sidebar' => $sidebar
        ]); */
        return response()->json([
            'sidebar' => $sidebar
        ]);
        //return back()->with('userInfo',$user);
        /* return back()->with('sidebar', [
            'assignedMenus' => $sidebar,
            'menuGroupId' => $menuGroupId,
        ]); */
    }

    public function ShowMenuGroupList():Response
    {
        return Inertia::render('menu/menuGroupList', [
            'menuGroups' => MenuGroup::all(),
        ]);
    }

    public function AddMenuGroup():RedirectResponse
    {
        $validated = request()->validate([
            'menuGroupName' => 'required|string',
        ]);
        if (MenuGroup::where('menuGroupName', $validated['menuGroupName'])->exists()) {
            return back()->withErrors(['menuGroupName' => 'Duplicate Menu Group Name'])->onlyInput('menuGroupName');
        } else {
            $validated['addedBy'] = Auth::user()->userId;
            MenuGroup::create($validated);
            return redirect()->route('menu.show-menuGroups')->with('success', 'Menu Group added successfully.');
        }
    }

    public function UpdateMenuGroup():RedirectResponse
    {
        $validated = request()->validate([
            'menuGroupId' => 'required|integer',
            'menuGroupName' => 'required|string',
        ]);
        if (MenuGroup::where([['menuGroupName', '=', request()->menuGroupName], ['menuGroupId', '!=', request()->menuGroupId]])->exists()) {
            return back()->withErrors(['menuGroupName' => 'Duplicate Menu Group Name'])->onlyInput('menuGroupName');
        } else {
            $menu = MenuGroup::find($validated['menuGroupId']);
            if ($menu) {
                $validated['lastUpdatedBy'] = Auth::user()->userId;
                $menu->update($validated);
                return redirect()->route('menu.show-menuGroups')->with('success', 'Menu Group updated successfully.');
            }
            return redirect()->route('menu.show-menuGroups')->with('error', 'Menu Group not found.');
        }
    }

    public function DeleteMenuGroup():RedirectResponse
    {
        $validated = request()->validate([
            'menuGroupId' => 'required|integer',
        ]);
        $menu = MenuGroup::find($validated['menuGroupId']);
        if ($menu) {
            $menu->delete();
            return redirect()->route('menu.show-menuGroups')->with('success', 'Menu Group deleted successfully.');
        }
        return redirect()->route('menu.show-menuGroups')->with('error', 'Menu Group not found.');
    }
}
