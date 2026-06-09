<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Menu;
use App\Models\Content;
use App\Models\PortfolioGallery;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class PortfolioGalleryController extends Controller
{
    
    public function PortfolioIndex()
    {
        $contentArr = Content::join('menus', 'contents.menu_id', '=', 'menus.id')
            ->where('contents.template', 'portfolio')
            ->orderBy('contents.created_at', 'DESC')
            ->select('contents.*', 'menu_name as menu_name')
            ->get();

        $dataArr = [
            "page_title" => "Portfolio Content",
            "contentArr" => $contentArr
        ];
        

        return view('pages.admin.portfolio.index')->with('dataArr', $dataArr);
    }

    public function PortfolioAdd()
    {
        $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
        $dataArr = [
            "page_title" => "Portfolio Content",
            "parentMenuArr" => $parentMenuArr
        ];

        return view('pages.admin.portfolio.add_portfolio')->with('dataArr', $dataArr);
    }

    public function savePortfolio(Request $request)
    {
        // Validate the form data
        $request->validate([
           
            'menu_id' => 'nullable',
            'page_name.*' => 'required',
            'page_url.*' => 'required',
            'meta_title.*' => 'required',
            'meta_revisit_after.*' => 'required',
            'meta_Robots.*' => 'required',
            'meta_description.*' => 'required',
        ]);
    
        try {
            DB::beginTransaction();
    
            $pageName = $request->input('page_name');
            $pageUrls = $request->input('page_url');
            $metaTitles = $request->input('meta_title');
            $metaRevisitAfter = $request->input('meta_revisit_after');
            $metaRobots = $request->input('meta_Robots');
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
            $content->template = 'portfolio';
            $content->content_type = 'portfolio';
            $content->menu_id = $request->input('menu_id');
            $content->save();
    
            foreach ($pageUrls as $key => $pageUrl) {
                $page = new Page();
                $page->type = 'portfolio';
                $page->content_id = $content->id;
                $page->page_name = $pageName[$key];
                $page->page_url = $pageUrl;
                $page->meta_title = $metaTitles[$key];
                $page->meta_revisit_after = $metaRevisitAfter[$key];
                $page->meta_Robots = $metaRobots[$key];
                $page->meta_description = $metaDescriptions[$key];
                $page->save();
            }
    
            DB::commit();
    
            return redirect()->route('admin.Portfolio.gallery.add', $content->id)
            ->with([
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

    public function PortfolioContentEdit($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.Portfolio')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }

        $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            'content' => $content,
            "parentMenuArr" => $parentMenuArr
        ];
        return view('pages.admin.portfolio.edit_portfolio', compact('dataArr'));
    }

    public function PortfolioUpdateContent(Request $request, $contentId)
    {
        // Validate the form data
        $request->validate([
            
            'menu_id' => 'nullable',
            'page_name.*' => 'required',
            'page_url.*' => 'required',
            'meta_title.*' => 'required',
            'meta_revisit_after.*' => 'required',
            'meta_Robots.*' => 'required',
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
            $metaDescriptions = $request->input('meta_description');
    
            $content = Content::find($contentId);
    
            if (!$content) {
                return redirect()->route('admin.Portfolio')
                    ->with([
                        "message" => [
                            "result" => "error",
                            "msg" => "Content Not Found."
                        ]
                    ]);
            }
    
            foreach ($pageNames as $key => $pageName) {
                $content->content_title = $pageName;
                $content->template = 'portfolio';
                $content->content_type = 'portfolio';
                $content->menu_id = $request->input('menu_id');
                $content->save();
    
               
                $existingPage = Page::where('page_url', $pageUrls[$key])
                    ->where('id', '!=', $key)
                    ->first();
    
                if ($existingPage) {
                    DB::rollBack();
                    return redirect()->back()
                        ->with([
                            "message" => [
                                "result" => "error",
                                "msg" => "Page URL already exists. Please choose a different one."
                            ]
                        ]);
                }
    
                $page = Page::find($key);
                $page->page_name = $pageName;
                $page->page_url = $pageUrls[$key];
                $page->meta_title = $metaTitles[$key];
                $page->meta_revisit_after = $metaRevisitAfter[$key];
                $page->meta_Robots = $metaRobots[$key];
                $page->meta_description = $metaDescriptions[$key];
                $page->save();
            }
    
            DB::commit();
    
            return redirect()->route('admin.Portfolio.gallery.add', $contentId)
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

    //   public function galleryAdd($contentId)
    //     {
    //         $content = Content::find($contentId);

           
    //         if (!$content) {
    //             abort(404);
    //         }
            
    //         $portfolioGalleries = PortfolioGallery::where('page_id', $contentId)->get();
    //         $dataArr = [
    //                    'content' => $content,
    //                    'portfolioGalleries' => $portfolioGalleries,
    //                 ];


    //         return view('pages.admin.portfolio.add_portfolio_step_one_gallery', compact('dataArr'));
    //     }

    public function galleryAdd($contentId)
        {
            $content = Content::find($contentId);

            if (!$content) {
                abort(404);
            }

            $portfolioGalleries = PortfolioGallery::where('page_id', $contentId)->get();
            $dataArr = [
                'content' => $content,
                'portfolioGalleries' => $portfolioGalleries,
                'pageId' => $contentId, // Pass the page_id to the view
            ];

            return view('pages.admin.portfolio.add_portfolio_step_one_gallery', compact('dataArr'));
        }


    
    public function galleryInsert(Request $request, $contentId)
    {
        $request->validate([
            'gallery_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           
            
        ]);
    
        try {
            DB::beginTransaction();
    
            $image = $request->file('gallery_image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->extension();
            $image->storeAs('public/gallery', $imageName);
    
            PortfolioGallery::create([
                'page_id' => $contentId,
                'gallery_image' => $imageName, 
            ]);
            
    
            DB::commit();
    
            // Redirect or return a response
            return redirect()->back()->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Files Uploaded & Saved Successfully"
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
    
    public function steponePortfolioMassContentPageUrlUpdate($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            abort(404);
        }

        $page = Page::where('content_id', $id)->first();

        $dataArr = [
            'content' => $content,
            'page' => $page, 
        ];

        return view('pages.admin.portfolio.add_massportfolio_page_url', compact('dataArr'));
    }

    public function steponePortfolioMassContentPageUrlSave(Request $request, $contentId)
    {
         // Validate the form data
         $request->validate([
            'section_one' => 'required'
        ]);

        try {
            DB::beginTransaction();

           
                $page = Page::where('content_id', $contentId)->first();
                
                if ($page) {
                    $page->section_one  = $request->section_one;
                    $page->save();
                }
          
            
            DB::commit();

            return redirect()->route('admin.portfolio.content.step.two.update', $contentId)
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

    public function stepTwoPortfolioContentUpdate($id)
        {
            $content = Content::find($id);

            // Check if the content exists
            if (!$content) {
                abort(404);
            }

            $page = Page::where('content_id', $id)->first();

            $dataArr = [
                'content' => $content,
                'page' => $page, 
            ];

            return view('pages.admin.portfolio.add_portfolio_step_two', compact('dataArr'));
        }



    public function stepTwoPortfolioContentSave(Request $request, $contentId)
        {
            // Validate the form data
            $request->validate([
                'section_two' => 'required'
            ]);

            try {
                DB::beginTransaction();

               
                    $page = Page::where('content_id', $contentId)->first();
                    
                    if ($page) {
                        $page->section_two = $request->section_two;
                        $page->save();
                    }
              
                
                DB::commit();

                return redirect()->route('admin.portfolio.content.step.three.update', $contentId)
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

        public function stepThreePortfolioContentUpdate($id)
        {
            $content = Content::find($id);

            // Check if the content exists
            if (!$content) {
                abort(404);
            }

            $page = Page::where('content_id', $id)->first();

            $dataArr = [
                'content' => $content,
                'page' => $page, 
            ];

            return view('pages.admin.portfolio.add_portfolio_step_three', compact('dataArr'));
        }


        public function stepThreePortfolioContentSave(Request $request, $contentId)
        {
            // Validate the form data
            $request->validate([
                'section_three' => 'required'
            ]);

            try {
                DB::beginTransaction();

               
                    $page = Page::where('content_id', $contentId)->first();
                    
                    if ($page) {
                        $page->section_three = $request->section_three;
                        $page->save();
                    }
              
                
                DB::commit();

                return redirect()->route('admin.portfolio.content.step.four.update', $contentId)
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


        public function stepFourPortfolioContentUpdate($id)
        {
            $content = Content::find($id);

            // Check if the content exists
            if (!$content) {
                abort(404);
            }

            $page = Page::where('content_id', $id)->first();

            $dataArr = [
                'content' => $content,
                'page' => $page, 
            ];

            return view('pages.admin.portfolio.add_portfolio_step_four', compact('dataArr'));
        }


        public function stepFourPortfolioContentSave(Request $request, $contentId)
        {
            // Validate the form data
            $request->validate([
                'section_four' => 'required'
            ]);

            try {
                DB::beginTransaction();

               
                    $page = Page::where('content_id', $contentId)->first();
                    
                    if ($page) {
                        $page->section_four = $request->section_four;
                        $page->save();
                    }
              
                
                DB::commit();

                return redirect()->route('admin.portfolio.content.step.five.update', $contentId)
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




        public function stepFiverPortfolioContentUpdate($id)
        {
            $content = Content::find($id);

            // Check if the content exists
            if (!$content) {
                abort(404);
            }

            $page = Page::where('content_id', $id)->first();

            $dataArr = [
                'content' => $content,
                'page' => $page, 
            ];

            return view('pages.admin.portfolio.add_portfolio_step_five', compact('dataArr'));
        }


        public function stepFivePortfolioContentSave(Request $request, $contentId)
        {
            // Validate the form data
            $request->validate([
                'section_five' => 'required'
            ]);

            try {
                DB::beginTransaction();

               
                    $page = Page::where('content_id', $contentId)->first();
                    
                    if ($page) {
                        $page->section_five = $request->section_five;
                        $page->save();
                    }
              
                    $content = Content::find($contentId);
                    if (!$content->is_completed) {
                        $content->update(['is_completed' => true]);
                    }
                DB::commit();

                return redirect()->route('admin.Portfolio')
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



















   
    public function removeGalleryPortfolio($id)
    {
        $gallery = PortfolioGallery::find($id);
    
        // Check if the gallery exists
        if (!$gallery) {
            return redirect()->route('admin.Portfolio')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Gallery Not Found."
                    ]
                ]);
        }
    
        // Delete the associated image file from storage
        Storage::delete('public/gallery/' . $gallery->gallery_image);
    
        // Delete the gallery record from the database
        $gallery->delete();
    
        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Gallery and associated images deleted successfully."
            ]
        ]);
    }


    public function portfolioContentRemove($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.Portfolio')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }

        Page::where("content_id", $id)->delete();
        $content->delete();

        return redirect()->route('admin.Portfolio')->with([
            "message" => [
                "result" => "success",
                "msg" => "content deleted successfully."
            ]
        ]);
    }
}
