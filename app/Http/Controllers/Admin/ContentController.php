<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Content;
use App\Models\Page;
use App\Models\PageBoxContent;
use App\Models\PageImage;
use App\Models\InnerBannerPage;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    // public function contentindex()
    // {
    //     $contentArr = Content::join('menus', 'contents.menu_id', '=', 'menus.id')
    //     ->whereNotIn('contents.template', ['portfolio'])
    //         ->orderBy('contents.created_at', 'DESC')
    //         ->select('contents.*', 'menu_name as menu_name')
    //         ->get();

    //     $dataArr = [
    //         "page_title" => "Content",
    //         "contentArr" => $contentArr
    //     ];

    //     return view('pages.admin.content.index')->with('dataArr', $dataArr);
    // }


    // public function contentAdd()
    // {
    //     $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
    //     $dataArr = [
    //         "page_title" => "Add Content",
    //         "parentMenuArr" => $parentMenuArr
    //     ];

    //     return view('pages.admin.content.add_content')->with('dataArr', $dataArr);
    // }

  
    // public function saveContent(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'template' => 'required',
    //         'menu_id' => 'nullable',
    //         'page_name.*' => 'required',
    //         'page_url.*' => 'required',
    //         'meta_title.*' => 'required',
    //         'meta_revisit_after.*' => 'required',
    //         'meta_Robots.*' => 'required',
    //         'meta_canonical.*' => 'required',
    //         'meta_description.*' => 'required',
    //     ]);
    
    //     try {
    //         DB::beginTransaction();
    
    //         $pageName = $request->input('page_name');
    //         $pageUrls = $request->input('page_url');
    //         $metaTitles = $request->input('meta_title');
    //         $metaRevisitAfter = $request->input('meta_revisit_after');
    //         $metaRobots = $request->input('meta_Robots');
    //         $metaCanonical = $request->input('meta_canonical');
    //         $metaDescriptions = $request->input('meta_description'); 
    
    //         // Check if page URLs already exist
    //         foreach ($pageUrls as $pageUrl) {
    //             $existingPage = Page::where('page_url', $pageUrl)->first();
    //             if ($existingPage) {
    //                 // Page URL already exists, show a message and handle accordingly
    //                 DB::rollBack();
    //                 return redirect()->back()->with([
    //                     "message" => [
    //                         "result" => "error",
    //                         "msg" => "Page URL '$pageUrl' already exists."
    //                     ]
    //                 ]);
    //             }
    //         }
    
    //         // Continue storing the content and pages if all page URLs are unique
    //         $content = new Content();
    //         $content->content_title = $pageName[0];
    //         $content->content_type = 'menu';
    //         $content->template = $request->input('template');
    //         $content->menu_id = $request->input('menu_id');
    //         $content->save();
    
    //         foreach ($pageUrls as $key => $pageUrl) {
    //             $page = new Page();
    //             $page->content_id = $content->id;
    //             $page->page_name = $pageName[$key];
    //             $page->page_url = $pageUrl;
    //             $page->meta_title = $metaTitles[$key];
    //             $page->meta_revisit_after = $metaRevisitAfter[$key];
    //             $page->meta_Robots = $metaRobots[$key];
    //             $page->meta_canonical = $metaCanonical[$key];
    //             $page->meta_description = $metaDescriptions[$key];
    //             $page->save();
    //         }
    
    //         DB::commit();
    
    //         return redirect()->route('admin.banner-content.update', $content->id)->with([
    //             "message" => [
    //                 "result" => "success",
    //                 "msg" => "Content Saved Successfully"
    //             ]
    //         ]);
    //     } catch (Exception $exception) {
    //         DB::rollBack();
    
    //         return redirect()->back()->with([
    //             "message" => [
    //                 "result" => "error",
    //                 "msg" => $exception->getMessage()
    //             ]
    //         ]);
    //     }
    // }
    



    // public function contentEdit($id)
    // {
    //     $content = Content::find($id);

    //     // Check if the content exists
    //     if (!$content) {
    //         return redirect()->route('admin.content')
    //             ->with([
    //                 "message" => [
    //                     "result" => "error",
    //                     "msg" => "Content Not Found."
    //                 ]
    //             ]);
    //     }

    //     $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();

    //     $dataArr = [
    //         'content' => $content,
    //         "parentMenuArr" => $parentMenuArr
    //     ];
    //     return view('pages.admin.content.edit_content', compact('dataArr'));
    // }

    

    // public function updateContent(Request $request, $contentId)
    // {
        
    //     // Validate the form data
    //     $request->validate([
    //         'template' => 'required',
    //         'menu_id' => 'nullable',
    //         'page_name.*' => 'required',
    //         'page_url.*' => 'required',
    //         'meta_title.*' => 'required',
    //         'meta_revisit_after.*' => 'required',
    //         'meta_Robots.*' => 'required',
    //         'meta_canonical.*' => 'required',
    //         'meta_description.*' => 'required',
    //     ]);
    
    //     try {
    //         DB::beginTransaction();
    
    //         // Process the form data
    //         $pageNames = $request->input('page_name');
    //         $pageUrls = $request->input('page_url');
    //         $metaTitles = $request->input('meta_title');
    //         $metaRevisitAfter = $request->input('meta_revisit_after');
    //         $metaRobots = $request->input('meta_Robots');
    //         $metaCanonical = $request->input('meta_canonical');
    //         $metaDescriptions = $request->input('meta_description');
    
    //         $content = Content::find($contentId);
    
    //         if (!$content) {
    //             return redirect()->route('admin.content')
    //                 ->with([
    //                     "message" => [
    //                         "result" => "error",
    //                         "msg" => "Content Not Found."
    //                     ]
    //                 ]);
    //         }
    
    //         foreach ($pageNames as $key => $pageName) {
    //             $content->content_title = $pageName;
    //             $content->template = $request->input('template');
    //             $content->menu_id = $request->input('menu_id');
    //             $content->content_type = 'menu';
    //             $content->save();
    
    //             // Check if the page URL already exists in the database
    //             $existingPage = Page::where('page_url', $pageUrls[$key])
    //                 ->where('id', '!=', $key)
    //                 ->first();
    
    //             if ($existingPage) {
    //                 DB::rollBack();
    //                 return redirect()->back()
    //                     ->with([
    //                         "message" => [
    //                             "result" => "error",
    //                             "msg" => "Page URL already exists. Please choose a different one."
    //                         ]
    //                     ]);
    //             }
    
    //             $page = Page::find($key);
    //             $page->page_name = $pageName;
    //             $page->page_url = $pageUrls[$key];
    //             $page->meta_title = $metaTitles[$key];
    //             $page->meta_revisit_after = $metaRevisitAfter[$key];
    //             $page->meta_Robots = $metaRobots[$key];
    //             $page->meta_canonical = $metaCanonical[$key];
    //             $page->meta_description = $metaDescriptions[$key];
    //             $page->save();
    //         }
    
    //         DB::commit();
    
    //         return redirect()->route('admin.banner-content.update', $contentId)
    //             ->with([
    //                 "message" => [
    //                     "result" => "success",
    //                     "msg" => "Content Saved Successfully"
    //                 ]
    //             ]);
    //     } catch (Exception $exception) {
    //         DB::rollBack();
    
    //         return redirect()->back()
    //             ->with([
    //                 "message" => [
    //                     "result" => "error",
    //                     "msg" => $exception->getMessage()
    //                 ]
    //             ]);
    //     }
    // }










    public function contentindex()
    {
        $contentArr = Content::where('content_type', 'menu')
        ->orderBy('id', 'desc')
        ->get()
        ->map(function ($content) {
            // Check if the menu ID is null and content type is menu
            if ($content->menu_id === null && $content->content_type === 'menu') {
                // Get the page associated with the content
                $page = $content->pages()->first(); // Assuming pages() is the relationship defined in the Content model
                // If a page is found, get the associated menu using the page ID
                if ($page) {
                    $menu = Menu::where('page_id', $page->id)->first(); // Assuming page_id is the field in the Menu model
                    // If a menu is found, set its name as the menu_name for the content
                    if ($menu) {
                        $content->menu_name = $menu->menu_name;
                        $content->menu_id = $menu->id; // Set the menu ID for the content
                    }
                }
            }
            return $content;
        });
    
    
    

        $dataArr = [
            "page_title" => "Content",
            "contentArr" => $contentArr,
            
        ];
  

        return view('pages.admin.content.index')->with('dataArr', $dataArr);
    }


    public function contentAdd()
    {
        $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
        $dataArr = [
            "page_title" => "Add Content",
            "parentMenuArr" => $parentMenuArr
        ];

        return view('pages.admin.content.add_content')->with('dataArr', $dataArr);
    }

  
    public function saveContent(Request $request)
    {

        // dd($request->all());
       
        // Validate the form data
        $request->validate([
            'template' => 'required',
            'menu_id' => 'nullable',
            'page_name.*' => 'required',
            'page_url.*' => 'required',
            'meta_title.*' => 'required',
            'meta_revisit_after.*' => 'required',
            'meta_Robots.*' => 'required',
            'meta_canonical.*' => 'required',
            'meta_description.*' => 'required',
        ]);
    
        try {
            DB::beginTransaction();
    
            $pageName = $request->input('page_name');
            $pageUrls = $request->input('page_url');
            $metaTitles = $request->input('meta_title');
            $metaRevisitAfter = $request->input('meta_revisit_after');
            $metaRobots = $request->input('meta_Robots');
            $metaCanonical = $request->input('meta_canonical');
            $metaDescriptions = $request->input('meta_description'); 
    
            // Check if page URLs already exist
            foreach ($pageUrls as $pageUrl) {
                $existingPage = Page::where('page_url', $pageUrl)->first();
                if ($existingPage) {
                    // Page URL already exists, show a message and handle accordingly
                    DB::rollBack();
                    return redirect()->back()->with([
                        "message" => [
                            "result" => "error",
                            "msg" => "Page URL '$pageUrl' already exists."
                        ]
                    ]);
                }
            }
    
            // Continue storing the content and pages if all page URLs are unique
            $content = new Content();
            $content->content_title = $pageName[0];
            $content->content_type = 'menu';
            $content->template = $request->input('template');
            $content->menu_id = $request->input('menu_id');
            $content->save();
    
            foreach ($pageUrls as $key => $pageUrl) {
                $page = new Page();
                $page->content_id = $content->id;
                $page->page_name = $pageName[$key];
                $page->page_url = $pageUrl;
                $page->meta_title = $metaTitles[$key];
                $page->meta_revisit_after = $metaRevisitAfter[$key];
                $page->meta_Robots = $metaRobots[$key];
                $page->meta_canonical = $metaCanonical[$key];
                $page->meta_description = $metaDescriptions[$key];
                $page->save();
            }
           // Retrieve the id of the saved page
            $pageId = $page->id;

           // Check if the selected menu is a root menu before saving it
            if ($request->input('menu_id') === null) {
                $menu = new Menu();
                $menu->menu_name = $pageName[$key]; // Assuming this is the name to be stored in Menu
                $menu->page_url = $pageUrl;
                $menu->page_id = $pageId; // Assign the id of the page to the menu's page_id field
                $menu->page_type = 'root_main_menu';
                // Populate other fields of Menu as needed
                $menu->save();
            }


    
            DB::commit();
    
            return redirect()->route('admin.content.step.two.update', $content->id)->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Content Saved Successfully"
                ]
            ]);
        } catch (Exception $exception) {
            DB::rollBack();
    
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => $exception->getMessage()
                ]
            ]);
        }
    }
    



    
    public function contentEdit($id)
    {
        // Retrieve the content by its ID
        $content = Content::find($id);
        
        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.content')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }
        
        // Retrieve the associated page for the content
        $page = $content->pages()->first();
        
        // Get the page ID if a page is associated, otherwise, set it to null
        $pageId = $page ? $page->id : null;
        
        // Initialize variable to hold menu information
        $isroot_main_menu = [];
        
        // Check if the content type is 'menu'
        if ($content->content_type === 'menu') {
            // Get the associated menu using the page ID
            $menu = Menu::where('page_id', $pageId)->first();
          
            $isroot_main_menu  = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
            // Check if the menu's page type is 'root_main_menu'
            if ($menu && $menu->page_type === 'root_main_menu') {
                // If it's 'root_main_menu', set the specific menu
                $isroot_main_menu = Menu::where('id', $menu->id)->get();
            }
        } 
        
        // Prepare data to pass to the view
        $dataArr = [
            'content' => $content,
            "parentMenuArr" => $isroot_main_menu,
            "pageId" => $pageId,
        ];
        //  dd($dataArr);
        
        // Pass data to the view and render it
        return view('pages.admin.content.edit_content', compact('dataArr'));
    }
    
    
    public function updateContent(Request $request, $contentId)
{
    // Validate the form data
    $request->validate([
        'template' => 'required',
        'menu_id' => 'nullable',
        'page_name.*' => 'required',
        'page_url.*' => 'required',
        'meta_title.*' => 'required',
        'meta_revisit_after.*' => 'required',
        'meta_Robots.*' => 'required',
        'meta_canonical.*' => 'required',
        'meta_description.*' => 'required',
    ]);

    try {
        DB::beginTransaction();

        // Process the form data
        $pageNames = $request->input('page_name');
        $pageUrls = $request->input('page_url');
        $metaTitles = $request->input('meta_title');
        $metaRevisitAfter = $request->input('meta_revisit_after');
        $metaRobots = $request->input('meta_Robots');
        $metaCanonical = $request->input('meta_canonical');
        $metaDescriptions = $request->input('meta_description');

        $content = Content::find($contentId);
        if (!$content) {
            return redirect()->route('admin.content')
                .with(["message" => ["result" => "error", "msg" => "Content Not Found."]]);
        }

        foreach ($pageNames as $key => $pageName) {
            $content->content_title = $pageName;
            $content->template = $request->input('template');
            $content->content_type = 'menu';

            $page = $content->pages()->where('id', $key)->first(); // Assuming `$key` is the page ID
            $pageId = $page ? $page->id : null;

            $menu = Menu::find($request->input('menu_id'));
            if ($menu && $menu->page_type === 'root_main_menu') {
                if ($menu->page_id == $pageId) {  // Ensure both IDs are of the same type (int vs string could cause issues)
                    $content->menu_id = null;
                } else {
                    $content->menu_id = $request->input('menu_id');
                }
            } else {
                $content->menu_id = $request->input('menu_id');
            }

            $content->save();  // Save updates to content

            // Proceed with page-specific updates
            $page = Page::find($key);
            $page->page_name = $pageName;
            $page->page_url = $pageUrls[$key];
            $page->meta_title = $metaTitles[$key];
            $page->meta_revisit_after = $metaRevisitAfter[$key];
            $page->meta_Robots = $metaRobots[$key];
            $page->meta_canonical = $metaCanonical[$key];
            $page->meta_description = $metaDescriptions[$key];
            $page->save();
        }
        
                            // Update Menu model
            $menu = Menu::where('page_id', $page->id)->first();
            if ($menu) {
                $menu->menu_name = $pageName;
                $menu->page_url = $pageUrls[$key];
                $menu->save();
            }


        DB::commit();
       return redirect()->route('admin.content.step.two.update', $contentId)
                ->with([
                    "message" => [
                        "result" => "success",
                        "msg" => "Content Saved Successfully"
                    ]
                ]);
        } catch (Exception $exception) {
            DB::rollBack();
    
            return redirect()->back()
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => $exception->getMessage()
                    ]
                ]);
        }
    }

//============================================================================

  




//=============================================================================


    public function contentStepTwoUpdate($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            abort(404);
        }

        $dataArr = [
            'content' => $content,
        ];

        return view('pages.admin.content.add_content_step_two', compact('dataArr'));
    }

    public function contentStepTwoSave(Request $request, $contentId)
    {
        // Validate the form data
        $request->validate([
            'section_one.*' => 'required'
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->section_one as $key => $value) {
                $page = Page::find($key);

                $page->section_one = $value;
                $page->save();
            }
           

            DB::commit();

            return redirect()->route('admin.content.step.three.update', $contentId)
            ->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Content Saved Successfully"
                ]
            ]);
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => $exception->getMessage()
                    ]
                ]);
        }
    }
    // ============================================= section two =============================================
    public function contentStepThreeUpdate($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            abort(404);
        }

        $dataArr = [
            'content' => $content,
        ];

        return view('pages.admin.content.add_content_step_three', compact('dataArr'));
    }

    public function contentStepThreeSave(Request $request, $contentId)
    {
        // Validate the form data
        $request->validate([
            'section_two.*' => 'required'
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->section_two as $key => $value) {
                $page = Page::find($key);

                $page->section_two = $value;
                $page->save();
            }

            DB::commit();

            return redirect()->route('admin.content.step.four.update', $contentId)
                ->with([
                    "message" => [
                        "result" => "success",
                        "msg" => "Content Saved Successfully"
                    ]
                ]);
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => $exception->getMessage()
                    ]
                ]);
        }
    }


    // ======================================================== section two end =============================================

      // ============================================= section three =============================================
      public function contentStepFourUpdate($id)
      {
          $content = Content::find($id);
  
          // Check if the content exists
          if (!$content) {
              abort(404);
          }
  
          $dataArr = [
              'content' => $content,
          ];
  
          return view('pages.admin.content.add_content_step_four', compact('dataArr'));
      }
  
      public function contentStepFourSave(Request $request, $contentId)
      {
          // Validate the form data
          $request->validate([
              'section_three.*' => 'required'
          ]);
  
          try {
              DB::beginTransaction();
  
              foreach ($request->section_three as $key => $value) {
                  $page = Page::find($key);
  
                  $page->section_three = $value;
                  $page->save();
              }
  
              DB::commit();
  
              return redirect()->route('admin.content.step.five.update', $contentId)
                  ->with([
                      "message" => [
                          "result" => "success",
                          "msg" => "Content Saved Successfully"
                      ]
                  ]);
          } catch (Exception $exception) {
              DB::rollBack();
  
              return redirect()->back()
                  ->with([
                      "message" => [
                          "result" => "error",
                          "msg" => $exception->getMessage()
                      ]
                  ]);
          }
      }
  
  
// ======================================================== section three end =============================================  

// ============================================= section four =============================================
            public function contentStepFiveUpdate($id)
            {
                $content = Content::find($id);
        
                // Check if the content exists
                if (!$content) {
                    abort(404);
                }
        
                $dataArr = [
                    'content' => $content,
                ];
                if ($content->template === "one") {
                    return view('pages.admin.content.add_content_step_five_template_one', compact('dataArr'));
                } else {
                    return view('pages.admin.content.add_content_step_five_template_two', compact('dataArr'));
                }
        
                
            }
        
            public function contentStepFiveoneSave(Request $request, $contentId)
            {
                // Validate the form data
                $request->validate([
                    'section_four.*' => 'required'
                ]);
        
                try {
                    DB::beginTransaction();
        
                    foreach ($request->section_four as $key => $value) {
                        $page = Page::find($key);
        
                        $page->section_four = $value;
                        $page->save();
                    }
                    $content = Content::find($contentId);

                    if (!$content->is_completed) {
        
                        $content->update(['is_completed' => true]);
                    }
        
                    DB::commit();

                   
        
                    return redirect()->route('admin.content')
                        ->with([
                            "message" => [
                                "result" => "success",
                                "msg" => "Content Saved Successfully"
                            ]
                        ]);
                } catch (Exception $exception) {
                    DB::rollBack();
        
                    return redirect()->back()
                        ->with([
                            "message" => [
                                "result" => "error",
                                "msg" => $exception->getMessage()
                            ]
                        ]);
                }
            }



            public function contentStepFivetwoSave(Request $request, $contentId)
            {
                // Validate the form data
                $request->validate([
                    'section_four.*' => 'required'
                ]);
        
                try {
                    DB::beginTransaction();
        
                    foreach ($request->section_four as $key => $value) {
                        $page = Page::find($key);
        
                        $page->section_four = $value;
                        $page->save();
                    }
                    $content = Content::find($contentId);

                   
        
                    DB::commit();

                   
        
                    return redirect()->route('admin.content.step.six.update', $contentId)
                        ->with([
                            "message" => [
                                "result" => "success",
                                "msg" => "Content Saved Successfully"
                            ]
                        ]);
                } catch (Exception $exception) {
                    DB::rollBack();
        
                    return redirect()->back()
                        ->with([
                            "message" => [
                                "result" => "error",
                                "msg" => $exception->getMessage()
                            ]
                        ]);
                }
            }
        
        
// ======================================================== section four end ============================================= 

        public function contentStepSixUpdate($id)
        {
            $content = Content::find($id);

            // Check if the content exists
            if (!$content) {
                abort(404);
            }

            $dataArr = [
                'content' => $content,
            ];

            return view('pages.admin.content.add_content_step_six', compact('dataArr'));
        }

        public function contentStepSixSave(Request $request, $contentId)
        {
            // Validate the form data
            $request->validate([
                'section_five.*' => 'required'
            ]);

            try {
                DB::beginTransaction();

                foreach ($request->section_five as $key => $value) {
                    $page = Page::find($key);

                    $page->section_five = $value;
                    $page->save();
                }
                $content = Content::find($contentId);

                if (!$content->is_completed) {

                    $content->update(['is_completed' => true]);
                }

                DB::commit();

            

                return redirect()->route('admin.content')
                    ->with([
                        "message" => [
                            "result" => "success",
                            "msg" => "Content Saved Successfully"
                        ]
                    ]);
            } catch (Exception $exception) {
                DB::rollBack();

                return redirect()->back()
                    ->with([
                        "message" => [
                            "result" => "error",
                            "msg" => $exception->getMessage()
                        ]
                    ]);
            }
        }

        public function contentRemove($id)
        {
            $content = Content::find($id);
        
            // Check if the content exists
            if (!$content) {
                return redirect()->route('admin.content')
                    ->with([
                        "message" => [
                            "result" => "error",
                            "msg" => "Content Not Found."
                        ]
                    ]);
            }
        
            // Retrieve the page IDs associated with the content
            $pageIds = Page::where("content_id", $id)->pluck('id')->toArray();
        
            // Delete pages associated with the content
            Page::where("content_id", $id)->delete();
        
            // Delete associated menus based on page_id
            Menu::whereIn('page_id', $pageIds)->delete();
        
            // Delete the content
            $content->delete();
        
            return redirect()->route('admin.content')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Content deleted successfully."
                ]
            ]);
        }

    public function uploadCkEditorImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('/assets/cmsImages'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/assets/cmsImages/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
