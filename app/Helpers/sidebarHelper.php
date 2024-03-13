<?php

use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\AccessUserMenu;
use Illuminate\Support\Facades\Auth;

//SIDEBAR DASHBOARD

function getMenuByRoleId()
{
    $user = Auth::user();

    // Check if the user is authenticated and has a role_id
    if ($user && $user->role_id) {
        // Retrieve menu access based on the user's role_id
        $AccessUserMenu = AccessUserMenu::where('role_id', $user->role_id)->pluck('menu_id');

        // Retrieve menu items based on the menu access
        $menus = Menu::whereIn('id', $AccessUserMenu)->get();

        // Retrieve submenus for each menu
        foreach ($menus as $menu) {
            $menu->subMenus = SubMenu::where('menu_id', $menu->id)->get();
        }

        return $menus;
    }
}
