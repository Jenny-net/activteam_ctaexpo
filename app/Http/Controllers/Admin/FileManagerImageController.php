<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FileManagerImage;
use App\Models\PageImage;
use App\Models\BoothImage;
use App\Models\Menu;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\DB;

class FileManagerImageController extends Controller
{
    public function filemanagerindex()
    {
        $folders = FileManagerImage::get()->groupBy('image_folder');

        return view('pages.admin.filemanager.index', compact('folders'));
    }

    public function filemanagerImageAdd()
    {

        $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
        $dataArr = [
            "page_title" => "Add Images",
            "parentMenuArr" => $parentMenuArr
        ];

        return view('pages.admin.filemanager.add_images')->with('dataArr', $dataArr);
    }


    // public function filemanagerImageSave(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'image_folder' => 'required',
    //         'original_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);


    //     try {
    //         DB::beginTransaction();
    //         // Store the uploaded images and save their details in the database
    //         $folder = str_replace(" ", "_", strtolower($request->input('image_folder')));
    //         if ($request->hasFile('original_image')) {
    //             foreach ($request->file('original_image') as $file) {

    //                 //image upload
    //                 $uploadedFile = $file;
    //                 $filename = rand('111111', '999999') . time() . "." . $uploadedFile->getClientOriginalExtension();

    //                 if (!Storage::makeDirectory('public/file_manager/original_image/' . $folder)) {
    //                     throw new \Exception('Could not create the directory');
    //                 }

    //                 Storage::disk('original_image')->putFileAs(
    //                     $folder,
    //                     $uploadedFile,
    //                     $filename
    //                 );


    //                 // Resize the image to the desired dimensions
    //                 $image = Image::make($uploadedFile)->resize(300, 200); // Adjust the dimensions as per your requirement

    //                 if (!Storage::makeDirectory('public/file_manager/thumbnail_image/' . $folder)) {
    //                     throw new \Exception('Could not create the directory');
    //                 }

    //                 Storage::disk('thumbnail_image')->put($folder . '/' . $filename, $image->stream());

    //                 FileManagerImage::create([
    //                     'image_folder' => $folder,
    //                     'thumbnail_image' => $filename,
    //                     'original_image' => $filename
    //                 ]);
    //             }
    //         }
    //         DB::commit();

    //         // Redirect or return a response
    //         return redirect()->route('admin.filemanager')
    //             ->with([
    //                 "message" => [
    //                     "result" => "success",
    //                     "msg" => "File Uploaded & Saved Successfully"
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
    public function filemanagerImageSave(Request $request)
    {
        // Validate the form data
        $request->validate([
            'image_folder' => 'required',
            'original_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            DB::beginTransaction();
            // Store the uploaded images and save their details in the database
            $folder = str_replace(" ", "_", strtolower($request->input('image_folder')));
            if ($request->hasFile('original_image')) {
                foreach ($request->file('original_image') as $file) {
        
                    // Image upload
                    $uploadedFile = $file;
                    $originalFilename = $uploadedFile->getClientOriginalName();
                    $extension = $uploadedFile->getClientOriginalExtension();
        
                    // Generate a unique identifier (timestamp in this case)
                    $uniqueIdentifier = time();
        
                    // Combine the original filename, unique identifier, and extension
                    $filenameWithoutExt = pathinfo($originalFilename, PATHINFO_FILENAME);
                    $newFilename = $filenameWithoutExt . '__-__' . $uniqueIdentifier;
        
                    if (!Storage::makeDirectory('public/file_manager/original_image/' . $folder)) {
                        throw new \Exception('Could not create the directory');
                    }
        
                    $newFilenameWithExt = $newFilename . '.' . $extension; // Add extension back
        
                    Storage::disk('original_image')->putFileAs(
                        $folder,
                        $uploadedFile,
                        $newFilenameWithExt // Use the new filename with extension
                    );
        
                    // Resize the image to the desired dimensions
                    $image = Image::make($uploadedFile)->resize(300, 200); // Adjust the dimensions as per your requirement
        
                    if (!Storage::makeDirectory('public/file_manager/thumbnail_image/' . $folder)) {
                        throw new \Exception('Could not create the directory');
                    }
        
                    Storage::disk('thumbnail_image')->put($folder . '/' . $newFilenameWithExt, $image->stream());
        
                    FileManagerImage::create([
                        'image_folder' => $folder,
                        'thumbnail_image' => $newFilenameWithExt, // Use the new filename with extension
                        'original_image' => $newFilenameWithExt // Use the new filename with extension
                    ]);
                }
            }
            DB::commit();
        
            // Redirect or return a response
                    return redirect()->route('admin.filemanager')
                        ->with([
                            "message" => [
                                "result" => "success",
                                "msg" => "File Uploaded & Saved Successfully"
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

    
    public function filemanagerImageUpdateFolder()
     {
       $parentMenuArr = Menu::where('parent_id', '0')->where('type', 'header')->orderBy('created_at', 'DESC')->get();
       $existingFolders = FileManagerImage::distinct('image_folder')->pluck('image_folder'); // Get existing folder names

            $dataArr = [
                "page_title" => "Add Images",
                "parentMenuArr" => $parentMenuArr,
                "existingFolders" => $existingFolders, // Pass the existing folder names to the view
            ];

            return view('pages.admin.filemanager.update_folder')->with('dataArr', $dataArr);
    }


        public function filemanagerImageUpdateFolderImageSave(Request $request)
        {
            // Validate the form data
            $request->validate([
                'image_folder' => 'required',
                'original_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        
            try {
                DB::beginTransaction();
        
                // Store the uploaded images and save their details in the database
                $folder = str_replace(" ", "_", strtolower($request->input('image_folder')));
        
                if ($request->hasFile('original_image')) {
                    foreach ($request->file('original_image') as $file) {
                        // Image upload
                        $uploadedFile = $file;
                        $originalFilename = $uploadedFile->getClientOriginalName();
                        $extension = $uploadedFile->getClientOriginalExtension();
        
                        // Generate a unique identifier (timestamp in this case)
                        $uniqueIdentifier = time();
        
                        // Combine the original filename, unique identifier, and extension
                        $filenameWithoutExt = pathinfo($originalFilename, PATHINFO_FILENAME);
                        $newFilename = $filenameWithoutExt . '__-__' . $uniqueIdentifier;
        
                        if (!Storage::makeDirectory('public/file_manager/original_image/' . $folder)) {
                            throw new Exception('Could not create the directory');
                        }
        
                        $newFilenameWithExt = $newFilename . '.' . $extension; // Add extension back
        
                        Storage::disk('original_image')->putFileAs(
                            $folder,
                            $uploadedFile,
                            $newFilenameWithExt // Use the new filename with extension
                        );
        
                        // Resize the image to the desired dimensions
                        $image = Image::make($uploadedFile)->resize(300, 200); // Adjust the dimensions as per your requirement
        
                        if (!Storage::makeDirectory('public/file_manager/thumbnail_image/' . $folder)) {
                            throw new Exception('Could not create the directory');
                        }
        
                        Storage::disk('thumbnail_image')->put($folder . '/' . $newFilenameWithExt, $image->stream());
        
                        FileManagerImage::create([
                            'image_folder' => $folder,
                            'thumbnail_image' => $newFilenameWithExt, // Use the new filename with extension
                            'original_image' => $newFilenameWithExt // Use the new filename with extension
                        ]);
                    }
                }
        
                DB::commit();
        
                // Redirect or return a response
                return redirect()->route('admin.filemanager')
                    ->with([
                        "message" => [
                            "result" => "success",
                            "msg" => "File Uploaded & Saved Successfully"
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
    

    // public function imgRemove($id)
    // {
    //     $pageImage = PageImage::whereImageId($id)->first();
    //     $pageName = $pageImage->page->page_name;
    //     // Check if the Page Image exists
    //     if ($pageImage) {
    //         return redirect()->back()
    //             ->with([
    //                 "message" => [
    //                     "result" => "error",
    //                     "msg" => "Can Not Delete. Image Is Used In Page: $pageName"
    //                 ]
    //             ]);
    //     }

    //     $fileManagerImage = FileManagerImage::find($id);
    //     $filePath = $fileManagerImage->image_folder . '/' . $fileManagerImage->image_name;

    //     if (!is_null($fileManagerImage)) {
    //         Storage::disk('original_image')->delete($filePath);
    //         Storage::disk('thumbnail_image')->delete($filePath);
    //     }
    //     $fileManagerImage->delete();

    //     // Redirect or return a response
    //     return redirect()->route('admin.filemanager')
    //         ->with([
    //             "message" => [
    //                 "result" => "success",
    //                 "msg" => "File Deleted Successfully"
    //             ]
    //         ]);
    // }

        public function imgRemove($id)
        {
            $pageImages = PageImage::whereImageId($id)->get();
            $pageNames = [];

            // Check if any Page Images exist
            if ($pageImages->isNotEmpty()) {
                foreach ($pageImages as $pageImage) {
                    $pageNames[] = $pageImage->page->page_name;
                }
                
                $pageNamesStr = implode(', ', $pageNames);
                
                return redirect()->back()
                    ->with([
                        "message" => [
                            "result" => "error",
                            "msg" => "Can Not Delete. Image Is Used In Pages: $pageNamesStr"
                        ]
                    ]);
            }

            $fileManagerImage = FileManagerImage::find($id);
            $filePath = $fileManagerImage->image_folder . '/' . $fileManagerImage->image_name;

            if (!is_null($fileManagerImage)) {
                Storage::disk('original_image')->delete($filePath);
                Storage::disk('thumbnail_image')->delete($filePath);
            }
            $fileManagerImage->delete();

            // Redirect or return a response
            return redirect()->route('admin.filemanager')
                ->with([
                    "message" => [
                        "result" => "success",
                        "msg" => "File Deleted Successfully"
                    ]
                ]);
        }


    public function getFolder($page_id)
    {
        $folders = FileManagerImage::groupBy('image_folder')->get();
        return view('pages.admin.filemanager.ajax_folders', compact('folders', 'page_id'));
    }

    public function getImage($file_id, $page_id)
    {
        $pageImages = PageImage::where('page_id', $page_id)->pluck('image_id');
        $folder = FileManagerImage::find($file_id);

        $images = FileManagerImage::where('image_folder', $folder->image_folder)
            ->whereNotIn('id', $pageImages)
            ->get();

        return view('pages.admin.filemanager.ajax_images', compact('images', 'page_id'));
    }


            // for paginate  //

    // public function getImage($file_id, $page_id)
    // {
    //     $pageImages = PageImage::where('page_id', $page_id)->pluck('image_id');
    //     $folder = FileManagerImage::find($file_id);

    //     $images = FileManagerImage::where('image_folder', $folder->image_folder)
    //         ->whereNotIn('id', $pageImages)
    //         ->paginate(10); 

    //     return view('pages.admin.filemanager.ajax_images', compact('images', 'page_id'));
    // }

    public function getImageForBoth($file_id, $page_id)
    {
        $pageImages = BoothImage::where('page_id', $page_id)->pluck('image_id');
        $folder = FileManagerImage::find($file_id);

        $images = FileManagerImage::where('image_folder', $folder->image_folder)
            ->whereNotIn('id', $pageImages)
            ->get();

        return view('pages.admin.filemanager.ajax_images_both', compact('images', 'page_id'));
    }
}
