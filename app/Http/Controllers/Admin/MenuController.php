<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Menu;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menuArr = Menu::with('parentMenu')->where('type', 'header')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Header Menu",
            "menuArr" => $menuArr
        ];

        return view('pages.admin.menu.index')->with('dataArr', $dataArr);
    }

    public function menuAdd()
    {

        $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
        $dataArr = [
            "page_title" => "Add Header Menu",
            "parentMenuArr" => $parentMenuArr
        ];

        return view('pages.admin.menu.add_menu')->with('dataArr', $dataArr);
    }

     function categoryTree($parent_id = 0, $sub_mark = '')
     {
         $query = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
         if ($query->count() > 0) {
             foreach ($query as $row) {
                 echo '<option value="' . $row->id . '">' . $sub_mark . $row->menu_name . '</option>';
                 categoryTree($row->id, $sub_mark . '---');
             }
         }
     }

    public function menuInsert(Request $request)
    {
        $request->validate([
            'menu_name' => 'required'
        ]);

        $menu = new Menu();
        $menu->parent_id = $request->parent ? $request->parent : 0;
        $menu->menu_name = $request->menu_name;
        $menu->page_url = $request->page_url;
        $menu->save();

        // Check Slug & Create
        $slug = Str::slug($request->menu_name);
        $check_slug = Menu::where('slug', $slug)->first();

        $menu->slug = $check_slug ? $slug . "-" . $menu->id : $slug;
        $menu->save();

        return redirect()->route('admin.menu')->with([
            "message" => [
                "result" => "success",
                "msg" => "Menu added successfully."
            ]
        ]);
    }


    // public function menuEdit($id)
    // {
    //     $menuArr = Menu::find($id);
    //     $parentMenuArr = Menu::where(['type' => 'header'])
    //         ->orderBy('created_at', 'DESC')->get();

    //     $dataArr = [
    //         "page_title" => "Edit Header Menu",
    //         "menuArr" => $menuArr,
    //         "parentMenuArr" => $parentMenuArr
    //     ];

    //     return view('pages.admin.menu.edit_menu')->with('dataArr', $dataArr);
    // }
    public function menuEdit($id)
    {
        $menu = Menu::find($id);
        $parentMenus = Menu::where(['type' => 'header'])
            ->orderBy('created_at', 'DESC')->get();

        // Define the recursive function within the controller
        $thisMenuIsChildOfCurrent = function ($currentMenu, $potentialParent) use (&$thisMenuIsChildOfCurrent) {
            foreach ($currentMenu->subMenu as $submenu) {
                if ($submenu->id == $potentialParent->id || $thisMenuIsChildOfCurrent($submenu, $potentialParent)) {
                    return true;
                }
            }

            return false;
        };

        $dataArr = [
            "page_title" => "Edit Header Menu",
            "menuArr" => $menu,
            "parentMenus" => $parentMenus,
            "currentMenuId" => $menu->parent_id,
            "thisMenuIsChildOfCurrent" => $thisMenuIsChildOfCurrent,
        ];

        return view('pages.admin.menu.edit_menu', compact('dataArr'));
    }



    // public function menuEdit($id)
    // {
    //     $menuArr = Menu::find($id);
    //     $parentMenuArr = Menu::where('id', '!=', $id)
    //     ->where(['parent_id' => '0', 'type' => 'header'])
    //     ->orderBy('created_at', 'DESC')->get();

    //     $dataArr = [
    //         "page_title" => "Edit Header Menu",
    //         "menuArr" => $menuArr,
    //         "parentMenuArr" => $parentMenuArr
    //     ];

    //     return view('pages.admin.menu.edit_menu')->with('dataArr', $dataArr);
    // }

    public function menuUpdate(Request $request, $id)
    {
        $request->validate([
            'menu_name' => 'required',
        ]);

        // check and update slug
        $menu = Menu::find($id);

        if ($request->menu_name != $menu->menu_name) {
            $slug = Str::slug($request->menu_name);
            $check_slug = Menu::where('slug', $slug)->first();

            $menu->slug = $check_slug ? $slug . "-" . $id : $slug;
        }

        $menu->parent_id = $request->parent ? $request->parent : 0;
        $menu->menu_name = $request->menu_name;
        $menu->page_url = $request->page_url;
        $menu->save();

        return redirect()->route('admin.menu')->with([
            "message" => [
                "result" => "success",
                "msg" => "Menu updated successfully."
            ]
        ]);
    }

    public function menuRemove($id)
    {

        $sMenu = Menu::where('parent_id', $id)->pluck('id');
        Content::whereIn('menu_id', $sMenu)->delete();
        Content::where('menu_id', $id)->delete();
        Menu::where('parent_id', $id)->delete();
        Menu::where('id', $id)->delete();

        return redirect()->route('admin.menu')->with([
            "message" => [
                "result" => "success",
                "msg" => "Menu deleted successfully."
            ]
        ]);
    }
}
