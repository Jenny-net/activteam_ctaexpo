<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Slider;
class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::orderBy('order_by')->get();
        return view('pages.admin.slider.index_slider', compact('sliders'));
        
    }
    
    public function sliderAdd()
    {
        return view('pages.admin.slider.add_slider');  
    }
  

    public function sliderInsert(Request $request)
        {
            $request->validate([
                'slider_file' => 'required|file|mimes:jpeg,png,jpg,gif,webp,mp4|max:2048000',
                
                'heading_section' => 'required',
                'content_section' => 'required',
                'readmore_label' => 'required',
                'page_url' => 'nullable', 
                
            ]);
 
            if ($request->hasFile('slider_file') ) {
                $sliderFile = $request->file('slider_file');
               

                // Determine the file type based on the extension
                $sliderFileType = $sliderFile->getClientOriginalExtension();
               

                $sliderFileName = time() . '.' . $sliderFileType;
               

                $sliderFilePath = 'slider_files/' . $sliderFileName;
               

                // Store the slider file
                Storage::disk('public')->put($sliderFilePath, file_get_contents($sliderFile));

                // Store the play button icon
              

                // Determine the type based on the slider file's extension
                $type = in_array($sliderFileType, ['mp4']) ? 'video' : 'image';

                $sliderContent = new Slider();
                $sliderContent->slider_file = $sliderFilePath;
                $sliderContent->type = $type; // Store the type here
                $sliderContent->heading = $request->input('heading_section');
                $sliderContent->content = $request->input('content_section');
                $sliderContent->readmore_label = $request->input('readmore_label');
                $sliderContent->page_url = $request->input('page_url'); 
                $sliderContent->playbtn_url = $request->input('playbtn_url'); 
                $sliderContent->save();

                return redirect()->route('admin.slider.index')->with('success', 'Slider content added successfully.');
            }

            return redirect()->route('admin.slider.index')->with('error', 'Failed to add slider content.');
        }


    public function sliderEdit($id)
    {
        $slider = Slider::find($id);
        $dataArr = [
            'page_title' => 'Edit Slider ',
            'slider' => $slider,
        ];
    
        return view('pages.admin.slider.edit_slider')->with('dataArr', $dataArr);
    }

   
   

    public function sliderUpdate(Request $request, $id)
        {
            $request->validate([
                'slider_file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4|max:2048000',           
                'heading_section' => 'required',
                'content_section' => 'required',
                'readmore_label' => 'required',
                'page_url' => 'nullable',
            ]);

            // Find the slider by ID
            $slider = Slider::findOrFail($id);

            // Update the slider content
            $slider->heading = $request->input('heading_section');
            $slider->content = $request->input('content_section');
            $slider->readmore_label = $request->input('readmore_label');
            $slider->page_url = $request->input('page_url');
          

            if ($request->hasFile('slider_file')) {
                // Delete the old slider file if it exists
                Storage::disk('public')->delete($slider->slider_file);

                // Store the new slider file
                $sliderFile = $request->file('slider_file');
                $sliderFileType = $sliderFile->getClientOriginalExtension();
                $sliderFileName = time() . '.' . $sliderFileType;
                $sliderFilePath = 'slider_files/' . $sliderFileName;
                Storage::disk('public')->put($sliderFilePath, file_get_contents($sliderFile));

                // Update the slider file path
                $slider->slider_file = $sliderFilePath;

                // Determine the type based on the slider file's extension
                $type = in_array($sliderFileType, ['mp4']) ? 'video' : 'image';

                // Update the type field
                $slider->type = $type;
            }

          

            // Save the updated slider content
            $slider->save();

            return redirect()->route('admin.slider.index')->with('success', 'Slider updated successfully.');
        }

    

    public function updateStatus(Request $request)
    {
        $sliderId = $request->input('sliderId');
        $sliderStatus = $request->input('sliderStatus');

        
        $slider = Slider::find($sliderId);
        if ($slider) {
            $slider->status = $sliderStatus;
            $slider->save();
            return response()->json([
                'message' => 'Slider status updated successfully',
                'status' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'Slider not found',
            'status' => 'error', 
        ], 404);
    }

    public function sliderRemove($id)
    {
        $slider = Slider::find($id);
    
        if (!$slider) {
            return redirect()->route('admin.slider.index')->with('error', 'Slider not found.');
        }
    
       
        Storage::disk('public')->delete($slider->slider_file);
        Storage::disk('public')->delete($slider->playbtn_icon);
        $slider->delete();
    
        return redirect()->route('admin.slider.index')->with('success', 'Slider deleted successfully.');
    }
    


}
