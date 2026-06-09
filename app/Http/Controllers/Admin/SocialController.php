<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialIcon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    
    public function Socialindex()
    {
        $socialArr = SocialIcon::where('type', 'social')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Social Icon",
            "socialArr" => $socialArr
        ];

        return view('pages.admin.social_managment.index')->with('dataArr', $dataArr);
    }

    public function SocialAdd()
    {
        return view('pages.admin.social_managment.add_social');
    }





    public function SocialSave(Request $request)
    {
        $request->validate([
            'social_icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_url' => 'required|url',
        ]);

        if ($request->hasFile('social_icon')) {
            $image = $request->file('social_icon');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'social_icons/' . $imageName;

            Storage::disk('public')->put($imagePath, file_get_contents($image));

            $socialIcon = new SocialIcon();
            $socialIcon->social_icon = $imagePath; 
            $socialIcon->url = $request->input('social_url');
            $socialIcon->type = 'social';
            $socialIcon->save();

            return redirect()->route('admin.social')->with('success', 'Social icon added successfully.');
        }

        return redirect()->route('admin.social.add')->with('error', 'Failed to add social icon.');
    }

    public function SocialEdit($id)
    {
        $social = SocialIcon::find($id);
        $dataArr = [
            'page_title' => 'Edit Social Media Icon',
            'social' => $social,
        ];
    
        return view('pages.admin.social_managment.edit_social')->with('dataArr', $dataArr);
    }



    public function SocialUpdate(Request $request, $id)
    {
        $request->validate([
            'social_icon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_url' => 'required|url',
        ]);

        $socialIcon = SocialIcon::findOrFail($id);

        if ($request->hasFile('social_icon')) {
            
            Storage::disk('public')->delete($socialIcon->social_icon);

            
            $image = $request->file('social_icon');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'social_icons/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));

            $socialIcon->social_icon = $imagePath;
        }

        $socialIcon->url = $request->input('social_url');
        $socialIcon->save();

        return redirect()->route('admin.social')->with('success', 'Social icon updated successfully.');
    }
    public function SocialRemove($id)
    {

        $socialIcon = SocialIcon::find($id);
    
        if (!$socialIcon) {
            return redirect()->route('admin.social')->with('error', 'Slider not found.');
        }
        $socialIcon->delete();
        return redirect()->route('admin.social')->with('success', 'Slider deleted successfully.');
    }
    

}
