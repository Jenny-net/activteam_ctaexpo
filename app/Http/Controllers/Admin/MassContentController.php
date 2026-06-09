<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Page;
use App\Models\Menu;
use App\Models\MassContentImage;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MassContentController extends Controller
{
    public function massContentIndex()
    {
        $data = Content::where('contents.content_type', 'mass')
            ->orderBy('id', 'desc')
            ->get();

        $dataArr = [
            "page_title" => "MassContent",
            "data" => $data
        ];

        return view('pages.admin.mass_content.index')->with('dataArr', $dataArr);
    }





    public function massContentAdd()
    {
        $dataArr = [
            "page_title" => "Add MassContent",
        ];

        return view('pages.admin.mass_content.add_content')->with('dataArr', $dataArr);
    }




    public function masssaveContent(Request $request)
    {
        $request->validate([
            'content_title' => 'required',
            'template' => 'required',
            'content_type'=> 'required',
            'no_of_pages' => 'required|integer|min:1',
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

            $content = Content::create([
                'content_title' => $request->input('content_title'),
                'template' => $request->input('template'),
                'content_type' => $request->input('content_type'),

            ]);

            $noOfPages = $request->input('no_of_pages');

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
                    'type' => 'mass',
                    'page_name' => $request->input('page_name')[$i],
                    'page_url' => str_replace(env('APP_URL'), '', $pageUrl),
                    'meta_title' => $request->input('meta_title')[$i],
                    'meta_revisit_after' => $request->input('meta_revisit_after')[$i],
                    'meta_Robots' => $request->input('meta_Robots')[$i],
                    'meta_canonical' => $request->input('meta_canonical')[$i],
                    'meta_description' => $request->input('meta_description')[$i],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.masscontent.step.two.update', $content->id)->with('success', 'Content created successfully.');
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


    public function massContentEdit($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.masscontent')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }

        $pages = $content->pages;


        // dd($pages);

        $dataArr = [
            "page_title" => "Edit MassContent",
            "content" => $content,
            "pages" => $pages
        ];

        return view('pages.admin.mass_content.edit_content')->with('dataArr', $dataArr);
    }


   


      public function massupdateContent(Request $request, $id)
       
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
                'meta_canonical.*' => 'required',
                'meta_description.*' => 'required',
                
            ]);
  
            try {
                DB::beginTransaction();

                $content = Content::find($id);

                if (!$content) {
                    return redirect()->route('admin.masscontent.step.two.update', $id)
                        ->with('error', 'Content not found.');
                }

                $content->content_title = $request->input('content_title');
                $content->template = $request->input('template');
                $content->content_type = 'mass';
                $content->save();

                // Process the form data
                $pageNames = $request->input('page_name');
                $pageUrls = $request->input('page_url');
                $metaTitles = $request->input('meta_title');
                $metaRevisitAfter = $request->input('meta_revisit_after');
                $metaRobots = $request->input('meta_Robots');
                $metaCanonical = $request->input('meta_canonical');
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
                    $page->meta_canonical = $metaCanonical[$key];
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

                return redirect()->route('admin.masscontent.step.two.update', $id)
                    ->with('success', 'Content updated successfully.');
            } catch (Exception $exception) {
                DB::rollBack();

                return redirect()->back()
                    ->with('error', $exception->getMessage());
            }
        }




    public function massContentStepTwoUpdate($id)
        {
            $content = Content::find($id);

            if (!$content) {
                abort(404);
            }

            $dataArr = [
                'content' => $content,
            ];

            // Use a switch case to load the same view for 'one', 'two', and 'three', and handle 'four' differently
            switch ($content->template) {
                case 'one':
                case 'two':
                case 'three':
                    return view('pages.admin.mass_content.add_content_step_two', compact('dataArr'));
                case 'four':
                    // Handle 'four' differently, for example, redirect to another page
                    return view('pages.admin.mass_content.add_content_free_creation_section_one', compact('dataArr'));
                default:
                    return redirect()->route('admin.masscontent');
            }
        }
        

  public function massContentStepTwoSave(Request $request, $contentId)
        { 
            $request->validate([
                'section_one.*' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);
           
            try {
                DB::beginTransaction();
        
                foreach ($request->section_one as $pageId => $value) {
                    $page = Page::find($pageId);
        
                    $page->section_one = $value;
                    $page->save();
        
                    if ($request->hasFile('images'.$pageId)) {
                        foreach ($request->file('images'.$pageId) as $image) {
                            // Generate a unique filename based on the original filename
                            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                            $extension = $image->getClientOriginalExtension();
                            $randomNumber = Str::random(10); // Generate a random string of length 10
                            $imageName = $originalName . '-' . $randomNumber . '.' . $extension;
                    
                            // Save the image to the public storage directory
                            $imagePath = $image->storeAs('public/mass_content_images', $imageName);
                    
                            // Extract the alt text from the original filename
                            $altText = $originalName;
                    
                            // Create a new MassContentImage record
                            $massContentImage = new MassContentImage();
                            $massContentImage->page_id = $pageId;
                            $massContentImage->mass_image = 'mass_content_images/' . $imageName; // Store the full path
                            $massContentImage->mass_image_alt = $altText;
                            $massContentImage->save();
                        }
                    }
                    
                    
                }
        
                DB::commit();
        
                return redirect()->route('admin.masscontent.step.three.update', $contentId)
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


    // public function massContentStepTwoSave(Request $request, $contentId)
    // {

    //     $request->validate([
    //         'section_one.*' => 'required'
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         foreach ($request->section_one as $key => $value) {
    //             $page = Page::find($key);

    //             $page->section_one = $value;
    //             $page->save();
    //         }

    //         DB::commit();

    //         return redirect()->route('admin.masscontent.step.three.update', $contentId)
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

    //free style section  two
  


    public function massContentStepTwoFreeStyleSave(Request $request, $contentId)
    {

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
            $content = Content::find($contentId);

            if (!$content->is_completed) {

                $content->update(['is_completed' => true]);
            }
            DB::commit();

            return redirect()->route('admin.masscontent')
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


    public function massContentStepThreeUpdate($id)
    {
        $content = Content::find($id);
        if (!$content) {
            abort(404);
        }

        $dataArr = [
            'content' => $content,
        ];

        return view('pages.admin.mass_content.add_content_step_three', compact('dataArr'));
    }
    public function massContentStepThreeSave(Request $request, $contentId)
    {
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

            return redirect()->route('admin.masscontent.step.four.update', $contentId)
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

    public function massContentStepFourUpdate($id)
    {
        $content = Content::find($id);
        if (!$content) {
            abort(404);
        }

        $dataArr = [
            'content' => $content,
        ];

        return view('pages.admin.mass_content.add_mass_content_step_four', compact('dataArr'));
    }

    public function massContentStepFourSave(Request $request, $contentId)
    {
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

            return redirect()->route('admin.masscontent.step.five.update', $contentId)
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

    public function massContentStepFiveUpdate($id)
    {
        $content = Content::find($id);
        if (!$content) {
            abort(404);
        }

        $dataArr = [
            'content' => $content,
        ];

        return view('pages.admin.mass_content.add_mass_content_step_five', compact('dataArr'));
    }

    public function massContentStepFiveSave(Request $request, $contentId)
    {
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

            return redirect()->route('admin.masscontent')
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

    public function massContentRemove($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.masscontent')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Content Not Found."
                    ]
                ]);
        }

        // Delete the associated pages
        Page::where("content_id", $id)->delete();

        // Delete the content
        $content->delete();

        return redirect()->route('admin.masscontent')->with([
            "message" => [
                "result" => "success",
                "msg" => "Content deleted successfully."
            ]
        ]);
    }
    
    
public function massContentGalleryImageRemove($id)
    {
        // Find the gallery image by ID
        $galleryImage = MassContentImage::findOrFail($id);

        // Delete the image from storage if necessary
        if (Storage::exists($galleryImage->image_path)) {
            Storage::delete($galleryImage->image_path);
        }

        // Delete the gallery image from database
        $galleryImage->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Gallery image removed successfully."
            ]
        ]);

        
    }

    public function massContentPagedelete($id)
    {
        $page = Page::findOrFail($id);
        $pageName = $page->page_name; 
        $page->delete();
        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => " '$pageName' deleted successfully."
            ]
        ]);
    }
}
