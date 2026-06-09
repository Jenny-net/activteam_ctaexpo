<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Content;
use Illuminate\Support\Str;

class FooterMenuController extends Controller
{
    public function index()
    {
        $menuArr = Menu::with('parentMenu')->where('type', 'footer')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Footer Menu",
            "menuArr" => $menuArr
        ];

        return view('pages.admin.footer_menu.index')->with('dataArr', $dataArr);
    }

    public function footermenuAdd()
    {
        $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'footer')->orderBy('created_at', 'DESC')->get();
        $dataArr = [
            "page_title" => "Add Footer Menu",
            "parentMenuArr" => $parentMenuArr
        ];
        return view('pages.admin.footer_menu.add_menu')->with('dataArr', $dataArr);
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
        $menu->type = 'footer';
        $menu->save();

        // Check Slug & Create
      
        $menu->save();

        return redirect()->route('admin.footer.menu')->with([
            "message" => [
                "result" => "success",
                "msg" => "Menu added successfully."
            ]
        ]);
    
     }



     public function menuEdit($id)
     {
        $menuArr = Menu::find($id);
        $parentMenuArr = Menu::where('id', '!=', $id)
        ->where(['parent_id' => '0', 'type' => 'footer'])
        ->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Edit Footer Menu",
            "menuArr" => $menuArr,
            "parentMenuArr" => $parentMenuArr
        ];

         return view('pages.admin.footer_menu.edit_menu')->with('dataArr', $dataArr);
     }

    //  public function menuUpdate(Request $request, $id)
    //  {
    //      $request->validate([
    //          'menu_name' => 'required',
    //      ]);

    //     // check and update slug
    //      $menu = Menu::find($id);

    //      if ($request->menu_name != $menu->menu_name) {

    //          $slug = Str::slug($request->menu_name);
    //          $check_slug = Menu::where('slug', $slug)->first();

    //          $menu->slug = $check_slug ? $slug . "-" . $menu->id : $slug;
    //      }
    //      $menu->page_url = $request->page_url;
    //      $menu->menu_name = $request->menu_name;
    //      $menu->type = "footer";
    //      $menu->save();


    //      return redirect()->route('admin.footer.menu')->with([
    //          "message" => [
    //              "result" => "success",
    //              "msg" => "Menu updated successfully."
    //          ]
    //      ]);
    //  }








            public function menuUpdate(Request $request, $id)
        {
            $request->validate([
                'menu_name' => 'required',
            ]);

            // Retrieve the menu item
            $menu = Menu::find($id);

            // Check and update slug
            if ($request->menu_name != $menu->menu_name) {
                $slug = Str::slug($request->menu_name);
                $check_slug = Menu::where('slug', $slug)->first();
                $menu->slug = $check_slug ? $slug . "-" . $menu->id : $slug;
            }

            if ($menu->parent_id != $request->parent) {
                $menu->parent_id = $request->parent;
            }
            
            $menu->page_url = $request->page_url;
            $menu->menu_name = $request->menu_name;
            $menu->type = "footer";
            $menu->save();

            return redirect()->route('admin.footer.menu')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Menu updated successfully."
                ]
            ]);
        }


      public function menuRemove($id)
      {

          Menu::find($id)->delete();
          Content::where('menu_id', $id)->delete();

          return redirect()->route('admin.footer.menu')->with([
              "message" => [
                  "result" => "success",
                  "msg" => "Menu deleted successfully."
              ]
          ]);
      }
}
