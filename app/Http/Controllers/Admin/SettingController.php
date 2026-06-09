<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
   
    public function Settingsindex()
    {
        $settingArr = Setting::where('type', 'setting')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Settings Menu",
            "settingArr" => $settingArr
        ];

        return view('pages.admin.setting.index')->with('dataArr', $dataArr);
    }
    public function SettingsEdit($id)
    {
        $settingArr = Setting::findOrFail($id);
    
        $dataArr = [
            "page_title" => "Settings Menu",
            "settingArr" => $settingArr
        ];
       
        return view('pages.admin.setting.edit_setting', compact('dataArr'));
    }


    public function SettingsUpdate(Request $request, $id)
    {
        try {
            DB::beginTransaction();
    
            $setting = Setting::findOrFail($id);
        
            $setting->name = 'setting';

            // 
            $setting->contact_us_heading       = $request->input('contact_us_heading');
            $setting->country_name_one_label   = $request->input('country_name_one_label');
            $setting->phone_number_one         = $request->input('phone_number_one');
            $setting->country_name_two_label   = $request->input('country_name_two_label');
            $setting->phone_number_two         = $request->input('phone_number_two');
            $setting->country_name_three_label = $request->input('country_name_three_label');
            $setting->phone_number_three       = $request->input('phone_number_three');
            $setting->email_label              = $request->input('email_label');
            $setting->email_address            = $request->input('email_address');
            $setting->email_link               = $request->input('email_link');
            $setting->whatsapp_url             = $request->input('whatsapp_url');
            $setting->teams_url                = $request->input('teams_url');
            $setting->contact_our_project      = $request->input('contact_our_project');
            $setting->copy_right               = $request->input('copy_right');
            $setting->contact_notes_area       = $request->input('contact_notes_area');

            // 
            $setting->whatsapp_link = $request->input('whatsapp_link');
            $setting->phone         = $request->input('phone_number');
            $setting->skype_label   = $request->input('skype_label');
            $setting->skype_url     = $request->input('skype_url');
            $setting->site_titel    = $request->input('site_titel');
            
            $request->validate([
                'icon' => 'image|mimes:jpeg,png,webp|max:2048',
                'fav_icon' => 'image|mimes:jpeg,png,webp|max:2048',
               
            ]);

            if ($request->hasFile('icon')) {
                $originalFilename = $request->file('icon')->getClientOriginalName();
                $iconExtension = $request->file('icon')->getClientOriginalExtension();
            
                do {
                    $randomNumber = '_' . time() . '_' . Str::random(10);
                    $iconFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . $randomNumber . '.' . $iconExtension;
                } while (Storage::disk('public')->exists('icon/' . $iconFilename));
            
                $iconPath = $request->file('icon')->storeAs('icon', $iconFilename, 'public');
                $setting->icon = $iconPath;
            }
            
            
            if ($request->hasFile('fav_icon')) {
                $originalFilename = $request->file('fav_icon')->getClientOriginalName();
                $favIconExtension = $request->file('fav_icon')->getClientOriginalExtension();
            
                do {
                    $randomNumber = '_' . time() . '_' . Str::random(10);
                    $favIconFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . $randomNumber . '.' . $favIconExtension;
                } while (Storage::disk('public')->exists('favicon/' . $favIconFilename));
            
                $favIconPath = $request->file('fav_icon')->storeAs('favicon', $favIconFilename, 'public');
                $setting->fav_icon = $favIconPath;
            }
            
           
    
           
         
            $setting->save();
    
            DB::commit();
    
            return redirect()->route('admin.setting')
                             ->with([
            "message" => [
                "result" => "success",
                "msg" => "Settings Update successfully."
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
    
    
}
