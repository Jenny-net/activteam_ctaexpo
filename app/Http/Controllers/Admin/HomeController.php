<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Page;
use App\Models\PageBoxContent;
use Exception;
use App\Models\PageImage;
use App\Models\BoothImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
   
       public function homecontentindex()
    {
        $data = Page::where('type', 'home')->get();
        $dataArr = [
            "page_title" => "HomeContent",
            "data" => $data

        ];

        return view('pages.admin.home_content.index')->with('dataArr', $dataArr);
    }

    public function homecontentEdit($id)
    {
        $page = Page::find($id);
        if (!$page) {
            return redirect()->route('admin.home.content')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }

        $dataArr = [
            'page' => $page
        ];

        return view('pages.admin.home_content.edit_content', compact('dataArr'));
    }

    public function homeupdateContent(Request $request)
    {
        try {
            DB::beginTransaction();
            $pageId = $request->input('page_id');
            $page = Page::find($pageId);

            if (!$page) {
                return redirect()->route('admin.home.content')
                    ->with([
                        "message" => [
                            "result" => "error",
                            "msg" => "Content Not Found."
                        ]
                    ]);
            }

            $newPageName = $request->input('page_name');
            $page->page_name = $newPageName;
            $slugBase = $newPageName . '-' . $page->id;
            $page->page_url = Str::slug($slugBase);

            $page->meta_title = $request->input('meta_title');
            $page->meta_Robots = $request->input('meta_Robots');
            $page->meta_revisit_after = $request->input('meta_revisit_after');
            $page->meta_description = $request->input('meta_description');
            $page->meta_canonical = $request->input('meta_canonical');
            

            $page->save();

            DB::commit();

            return redirect()->route('admin.homecontent.step.one.update',  ['id' => $pageId])
                ->with([
                    "message" => [
                        "result" => "success",
                        "msg" => "Content updated successfully."
                    ]
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception here, you can log it or return an error response
            return redirect()->route('admin.home.content')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "An error occurred while updating content."
                    ]
                ]);
        }
    }
//section one

    public function homeContenOneEdit($id)
    {

        $page = Page::find($id);

        // Check if the content exists
        if (!$page) {
            abort(404);
        }

        $dataArr = [
            'page' => $page,
        ];

        return view('pages.admin.home_content.edit_content_step_one', compact('dataArr'));
    }



    public function homeContenOneUpdate(Request $request, $id)
    {
        
        try {
            DB::beginTransaction();

            $page = Page::find($id);

            if (!$page) {
                return redirect()->route('admin.home.content')->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
            }

            $sectionOneContent = $request->input('section_one');
            $page->section_one = $sectionOneContent;
            $page->save();
           

          
            DB::commit();

            return redirect()->route('admin.home.content')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Section one content updated successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.home.content')->with([
                "message" => [
                    "result" => "error",
                    "msg" => "An error occurred while updating section one content."
                ]
            ]);
        }
    } 
    
    //=================old home content =================//
//     public function homecontentindex()
//     {
//         $data = Page::where('type', 'home')->get();
//         $dataArr = [
//             "page_title" => "HomeContent",
//             "data" => $data

//         ];

//         return view('pages.admin.home_content.index')->with('dataArr', $dataArr);
//     }

//     public function homecontentEdit($id)
//     {
//         $page = Page::find($id);
//         if (!$page) {
//             return redirect()->route('admin.home.content')
//                 ->with([
//                     "message" => [
//                         "result" => "error",
//                         "msg" => "Content Not Found."
//                     ]
//                 ]);
//         }

//         $dataArr = [
//             'page' => $page
//         ];

//         return view('pages.admin.home_content.edit_content', compact('dataArr'));
//     }

//     public function homeupdateContent(Request $request)
//     {
//         try {
//             DB::beginTransaction();
//             $pageId = $request->input('page_id');
//             $page = Page::find($pageId);

//             if (!$page) {
//                 return redirect()->route('admin.home.content')
//                     ->with([
//                         "message" => [
//                             "result" => "error",
//                             "msg" => "Content Not Found."
//                         ]
//                     ]);
//             }

//             $newPageName = $request->input('page_name');
//             $page->page_name = $newPageName;
//             $slugBase = $newPageName . '-' . $page->id;
//             $page->page_url = Str::slug($slugBase);

//             $page->meta_title = $request->input('meta_title');
//             $page->meta_Robots = $request->input('meta_Robots');
//             $page->meta_revisit_after = $request->input('meta_revisit_after');
//             $page->meta_description = $request->input('meta_description');

//             $page->save();

//             DB::commit();

//             return redirect()->route('admin.homecontent.step.one.update',  ['id' => $pageId])
//                 ->with([
//                     "message" => [
//                         "result" => "success",
//                         "msg" => "Content updated successfully."
//                     ]
//                 ]);
//         } catch (\Exception $e) {
//             DB::rollBack();
//             // Handle the exception here, you can log it or return an error response
//             return redirect()->route('admin.home.content')
//                 ->with([
//                     "message" => [
//                         "result" => "error",
//                         "msg" => "An error occurred while updating content."
//                     ]
//                 ]);
//         }
//     }
// //section one

//     public function homeContenOneEdit($id)
//     {

//         $page = Page::find($id);

//         // Check if the content exists
//         if (!$page) {
//             abort(404);
//         }

//         $dataArr = [
//             'page' => $page,
//         ];

//         return view('pages.admin.home_content.edit_content_step_one', compact('dataArr'));
//     }



//     public function homeContenOneUpdate(Request $request, $id)
//     {
        
//         try {
//             DB::beginTransaction();

//             $page = Page::find($id);

//             if (!$page) {
//                 return redirect()->route('admin.home.content')->with([
//                     "message" => [
//                         "result" => "error",
//                         "msg" => "Content Not Found."
//                     ]
//                 ]);
//             }

//             $sectionOneContent = $request->input('section_one');
//             $page->section_one = $sectionOneContent;
//             $page->save();
           

          
//             DB::commit();

//             return redirect()->route('admin.home.content')->with([
//                 "message" => [
//                     "result" => "success",
//                     "msg" => "Section one content updated successfully."
//                 ]
//             ]);
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return redirect()->route('admin.home.content')->with([
//                 "message" => [
//                     "result" => "error",
//                     "msg" => "An error occurred while updating section one content."
//                 ]
//             ]);
//         }
//     }

   

    
}
