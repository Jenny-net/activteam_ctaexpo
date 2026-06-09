<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Content;
use App\Models\Page;
use App\Models\Menu;


class ReplicateMassContentController extends Controller
{
   
   
 public function replicateMasscontentindex()
{
    $data = Content::where('content_type', 'ReplicateMassContent')
        ->orderBy('id', 'desc')
        ->get();

    return view('pages.admin.replicate_masscontent.index')->with('dataArr', [
        "page_title" => "Replicate Mass Content",
        "data" => $data
    ]);
}

    
   
    public function replicateMassContentAdd()
    {
        $dataArr = [
            "page_title" => "Add Replicate MassContent",
        ];

        return view('pages.admin.replicate_masscontent.add_content')->with('dataArr', $dataArr);
    }

public function replicateMassContentSave(Request $request)
{
    $request->validate([
        'content_title' => 'required|string|max:255',
        'template' => 'required|in:1,2',
        'no_of_pages' => 'required|integer|min:1',
        'section_one' => 'required|string',
    ]);

    try {
        DB::beginTransaction();

        //  Create the main Content entry
        $content = Content::create([
            'content_title' => $request->input('content_title'),
            'template' => $request->input('template'),
            'content_type' => 'ReplicateMassContent',
        ]);

        $noOfPages = (int)$request->input('no_of_pages');
        $sectionContent = $request->input('section_one');

        // Create each Page based on number selected
        for ($i = 1; $i <= $noOfPages; $i++) {
            $page = new Page();
            $page->content_id = $content->id;
            $page->type = 'ReplicateMassContent';
            $page->section_one = $sectionContent;
            $page->save();
        }

        DB::commit();

        return redirect()->route('admin.replicatemasscontent')
                 ->with([
                     "message" => [
                         "result" => "success",
                         "msg" => "Replicate Mass Content Saved Successfully"
                     ]
                     ]);



    } catch (Exception $exception) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => $exception->getMessage(),
        ], 500);
    }
}
//-------------------------------------------------------

 public function replicateMassContentEdit($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.replicatemasscontent')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Replicate Mass Content Not Found."
                    ]
                ]);
        }

        $pages = $content->pages;


        // dd($pages);

        $dataArr = [
            "page_title" => "Edit Replicate MassContent",
            "content" => $content,
            "pages" => $pages
        ];

        return view('pages.admin.replicate_masscontent.edit_content')->with('dataArr', $dataArr);
    }





  public function replicateMassUpdateContent(Request $request, $id)
    {
        // AJAX VALIDATION
        $validator = Validator::make($request->all(), [
        'content_title'        => 'required',
        'template'             => 'required',
        'page_name.*'          => 'required',
        'page_url.*'           => 'required',
        'meta_title.*'         => 'required',
        'meta_revisit_after.*' => 'required',
        'meta_Robots.*'        => 'required',
        'meta_canonical.*'     => 'required',
        'meta_description.*'   => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }


        try {
            DB::beginTransaction();

            $content = Content::find($id);
            if (!$content) {
                return response()->json([
                    "status" => "error",
                    "message" => "Content not found"
                ], 404);
            }

            // Update content
            $content->update([
                'content_title' => $request->content_title,
                'template' => $request->template,
                'content_type' => 'ReplicateMassContent',
            ]);

            $pageNames = $request->page_name;
            $pageUrls  = $request->page_url;
            $metaTitles = $request->meta_title;
            $metaRevisit = $request->meta_revisit_after;
            $metaRobots = $request->meta_Robots;
            $metaCanonical = $request->meta_canonical;
            $metaDesc = $request->meta_description;

            $baseUrl = env('APP_URL');

            foreach ($pageNames as $pageId => $pageName) {

                $page = Page::find($pageId);
                if (!$page) continue;

                $oldSlug = $page->page_url;
                $newSlug = str_replace($baseUrl, '', trim($pageUrls[$pageId]));

                // CHECK DUPLICATE URL
                $exists = Page::where('page_url', $newSlug)
                    ->where('id', '!=', $page->id)
                    ->first();

                if ($exists) {
                    return response()->json([
                        "status" => "duplicate_url",
                        "page_id" => $pageId,
                        "message" => "Page URL '{$newSlug}' already exists."
                    ], 409);
                }

                // Update page
                $page->update([
                    "page_name" => $pageName,
                    "page_url" => $newSlug,
                    "meta_title" => $metaTitles[$pageId],
                    "meta_revisit_after" => $metaRevisit[$pageId],
                    "meta_Robots" => $metaRobots[$pageId],
                    "meta_canonical" => $metaCanonical[$pageId],
                    "meta_description" => $metaDesc[$pageId],
                ]);

                // If URL changed → update references
                if ($oldSlug !== $newSlug) {

                    $oldFull = $baseUrl . $oldSlug;
                    $newFull = $baseUrl . $newSlug;

                    $sections = [
                        'section_one','section_two','section_three','section_four',
                        'section_five','section_six','section_seven','section_eight',
                        'section_nine','section_ten'
                    ];

                    Page::where(function ($q) use ($sections, $oldFull) {
                        foreach ($sections as $s) {
                            $q->orWhere($s, 'LIKE', '%'.$oldFull.'%');
                        }
                    })->get()->each(function ($p) use ($oldFull, $newFull, $sections) {
                        foreach ($sections as $s) {
                            $p->$s = preg_replace(
                                '#href="' . preg_quote($oldFull, '#') . '"#',
                                'href="' . $newFull . '"',
                                $p->$s
                            );
                        }
                        $p->save();
                    });

                    // Update menus
                    Menu::where('page_url', $oldFull)->update(['page_url' => $newFull]);
                }
            }

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Mass content updated successfully",
                "redirect" => route('admin.replicatemasscontent.step.one.update', $id)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], 500);
        }
    }



//------------------------------------------------------


public function replicateMassContentStepOneUpdate($id)
        {
            $content = Content::find($id);

            if (!$content) {
                abort(404);
            }

            $dataArr = [
                'content' => $content,
            ];

            return view('pages.admin.replicate_masscontent.add_section_content', compact('dataArr'));
        }

 public function replicatemassContentStepOneSave(Request $request, $contentId)
{
    $request->validate([
        'section_one.*' => 'required',
        'save_action' => 'required'
    ]);

    try {
        DB::beginTransaction();

        // Update all related pages
        foreach ($request->section_one as $key => $value) {
            $page = Page::find($key);

            if ($page) {
                $page->section_one = $value;
                $page->is_page_content_completed = true;
                $page->page_visibility_status = $request->save_action;
                $page->save();
            }
        }

        // Update content with save_action 
        $content = Content::find($contentId);

        if ($content) {
            $updateData = [
                'content_visibility_status' => $request->save_action
            ];

            if (!$content->is_completed) {
                $updateData['is_completed'] = true;
            }

            $content->update($updateData);
        }

        DB::commit();

        return redirect()->route('admin.replicatemasscontent')
            ->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Replicate Mass Content Saved Successfully"
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


//=====================================================


public function checkPageUrl(Request $request)
{
    $baseUrl = env('APP_URL');

    $pageId = $request->page_id;
    $pageUrl = str_replace($baseUrl, '', trim($request->page_url));

    $exists = Page::where('page_url', $pageUrl)
        ->when($pageId, function ($q) use ($pageId) {
            $q->where('id', '!=', $pageId);
        })
        ->exists();

    return response()->json([
        'exists' => $exists
    ]);
}

//content visibility
        public function updateContentVisibility(Request $request, $contentId)
        {
            $content = Content::findOrFail($contentId);

            $content->content_visibility_status =
                $request->content_visibility_status == 'on' ? 'public' : 'private';

            $content->save();

            return back()->with('success', 'Content visibility updated successfully');
        }

 
//-------------------------------------------------------
  public function replicateMassContentRemove($id)
    {
        $content = Content::find($id);

        // Check if the content exists
        if (!$content) {
            return redirect()->route('admin.replicatemasscontent')
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Mass Content Not Found."
                    ]
                ]);
        }

        // Delete the associated pages
        Page::where("content_id", $id)->delete();

        // Delete the content
        $content->delete();

        return redirect()->route('admin.replicatemasscontent')->with([
            "message" => [
                "result" => "success",
                "msg" => "Mass Content deleted successfully."
            ]
        ]);
    }
//--------------------------------------

     public function replicateMassContentPagedelete($id)
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
