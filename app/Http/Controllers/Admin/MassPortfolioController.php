<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Menu;
use App\Models\Content;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\MassPortfolioGallery;

class MassPortfolioController extends Controller
{
    public function massportfolioGalleryIndex()
    {
        $data = Content::where('contents.template', 'massportfolio')
            ->orderBy('id', 'desc')
            ->get();

        $dataArr = [
            "page_title" => "Mass Gallery",
            "data" => $data
        ];

        return view('pages.admin.mass_portfolio.index')->with('dataArr', $dataArr);
    }
   

    public function massportfolioGalleryAdd()
    {


        return view('pages.admin.mass_portfolio.add_portfolio_gallery');
    }


    public function massportfolioGallerySave(Request $request)
    {
        $request->validate([
            'content_title' => 'required',
            
            
            'page_name.*' => 'required',
            'page_url.*' => 'required',
            'meta_title.*' => 'required',
            'meta_revisit_after.*' => 'required',
            'meta_Robots.*' => 'required',
            'meta_description.*' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $content = Content::create([
                'content_title' => $request->input('content_title'),
                'template' => 'massportfolio',
                'content_type' => 'massportfolio',
               
            ]);

            $noOfPages = '1';

            for ($i = 0; $i < $noOfPages; $i++) {
                // Check if the page URL already exists
                $pageUrl = $request->input('page_url')[$i];
                $existingPage = Page::where('page_url', $pageUrl)->first();

                if ($existingPage) {
                    DB::rollBack();
                    return redirect()->back()->with([
                        "message" => [
                            "result" => "error",
                            "msg" => "Page URL '$pageUrl' already exists."
                        ]
                    ]);
                }

                Page::create([
                    'content_id' => $content->id,
                    'type' => 'massportfolio',
                    'page_name' => $request->input('page_name')[$i],
                    'page_url' => str_replace(env('APP_URL'), '', $pageUrl),
                    'meta_title' => $request->input('meta_title')[$i],
                    'meta_revisit_after' => $request->input('meta_revisit_after')[$i],
                    'meta_Robots' => $request->input('meta_Robots')[$i],
                    'meta_description' => $request->input('meta_description')[$i],
                ]);
            }
          
            DB::commit();

            return redirect()->route('admin.massportfoliogallery.step.one.add.images', $content->id)->with('success', 'Content created successfully.');
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
   


    public function massportfolioGalleryEdit($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.massportfoliogallery')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }

        $dataArr = [
            "page_title" => "Edit MassPortfolio",
            "content" => $content
        ];

        return view('pages.admin.mass_portfolio.edit_portfolio')->with('dataArr', $dataArr);
    }

    public function massportfolioGalleryUpdate(Request $request, $id)
       
        {

            // Validate the form data
            $request->validate([
                'content_title' => 'required',
                'template' => 'required',
                'page_name.*' => 'required',
                'page_url.*' => 'required',
                'meta_title.*' => 'required',
                'meta_revisit_after.*' => 'required',
                'meta_Robots.*' => 'required',
                'meta_description.*' => 'required',
            ]);

            try {
                DB::beginTransaction();

                $content = Content::find($id);

                if (!$content) {
                    return redirect()->route('admin.massportfoliogallery.update', $id)
                        ->with('error', 'Content not found.');
                }

                $content->content_title = $request->input('content_title');
                $content->template = $request->input('template');
                $content->content_type = 'massportfolio';
                $content->save();

                // Process the form data
                $pageNames = $request->input('page_name');
                $pageUrls = $request->input('page_url');
                $metaTitles = $request->input('meta_title');
                $metaRevisitAfter = $request->input('meta_revisit_after');
                $metaRobots = $request->input('meta_Robots');
                $metaDescriptions = $request->input('meta_description');
                

                // Update each page of the content
                foreach ($pageNames as $key => $pageName) {
                    $page = Page::find($key);

                    if (!$page) {
                        continue;
                    }
                    // Save old and new urls
                    $oldUrl = env('APP_URL') . $page->page_url;
                    $newUrl = $pageUrls[$key];

                    $page->page_name = $pageName;
                    $page->page_url = str_replace(env('APP_URL'), '', $pageUrls[$key]);
                    $page->meta_title = $metaTitles[$key];
                    $page->meta_revisit_after = $metaRevisitAfter[$key];
                    $page->meta_Robots = $metaRobots[$key];
                    $page->meta_description = $metaDescriptions[$key];
                    $page->save();

                    // Update page url to all contents if it's updated
                    if ($page->page_url != $newUrl) {
                        $sectionsToUpdate = ['section_one', 'section_two', 'section_three', 'section_four', 'section_five', 'section_six', 'section_seven', 'section_eight', 'section_nine', 'section_ten'];

                        Page::where(function ($query) use ($sectionsToUpdate, $oldUrl) {
                            foreach ($sectionsToUpdate as $section) {
                                $query->orWhere($section, 'LIKE', '%' . $oldUrl . '%');
                            }
                        })->get()->each(function ($existPage) use ($oldUrl, $newUrl, $sectionsToUpdate) {
                            foreach ($sectionsToUpdate as $section) {
                                $existPage->$section = str_replace($oldUrl, $newUrl, $existPage->$section);
                            }
                            $existPage->save();
                        });

                        //menu table check 
                        Menu::where('page_url', 'LIKE', '%' . $oldUrl . '%')->get()->each(function ($menu) use ($oldUrl, $newUrl) {
                            $menu->page_url = str_replace($oldUrl, $newUrl, $menu->page_url);
                            $menu->save();
                        });
                    }
                }

                DB::commit();

                return redirect()->route('admin.massportfoliogallery.step.one.add.images', $id)
                    ->with('success', 'Content updated successfully.');
            } catch (Exception $exception) {
                DB::rollBack();

                return redirect()->back()
                    ->with('error', $exception->getMessage());
            }
        }

   

    public function massportfolioGallerySteponeImagesAdd($contentId)
    {

        $content = Content::find($contentId);

        if (!$content) {
            abort(404);
        }

        $massportfolioGalleries = MassPortfolioGallery::where('page_id', $contentId)->get();
        $dataArr = [
            'content' => $content,
            'massportfolioGalleries' => $massportfolioGalleries,
            'pageId' => $contentId, // Pass the page_id to the view
        ];


      

        return view('pages.admin.mass_portfolio.add_portfolio_step_one_gallery_images', compact('dataArr'));
    }

    public function massportfoliogalleryInsert(Request $request, $contentId)
    {
        $request->validate([
            'gallery_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           
            
        ]);
    
        try {
            DB::beginTransaction();
    
            $image = $request->file('gallery_image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->extension();
            $image->storeAs('public/massgallery', $imageName);
    
            MassPortfolioGallery::create([
                'page_id' => $contentId,
                'mass_gallery' => $imageName, 
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


    

    

    //Removeor delete function

    public function removemassportfoliogalleryPortfolio($id)
    {
        $gallery = MassPortfolioGallery::find($id);
    
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
        Storage::delete('public/massgallery/' . $gallery->mass_gallery);
    
        // Delete the gallery record from the database
        $gallery->delete();
    
        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Gallery and associated images deleted successfully."
            ]
        ]);
    }


    public function massportfoliogalleryContentRemove($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.massportfoliogallery')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }

        Page::where("content_id", $id)->delete();
        MassPortfolioGallery::where("page_id", $id)->delete();
        $content->delete();

        return redirect()->route('admin.massportfoliogallery')->with([
            "message" => [
                "result" => "success",
                "msg" => "content deleted successfully."
            ]
        ]);
    }


    public function massportfolioStatusUpdate(Request $request, $contentId)
    {
        // Find the content based on the contentId
        $content = Content::find($contentId);
    
        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.massportfoliogallery')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }
    
        // Update the is_completed field
        $content->update([
            'is_completed' => true, 
        ]);
    
        return redirect()->route('admin.massportfoliogallery')->with('success', 'Content updated successfully.');
    }
    
    
}

