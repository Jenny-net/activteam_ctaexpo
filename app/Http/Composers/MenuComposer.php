<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Analytics;
use App\Models\Setting;
use App\Models\SocialIcon;
use App\Models\Contact;
use App\Models\NoscriptAnalytics;

class MenuComposer
{
    public function compose(View $view)
    {
        $view->with('headerMenu', Menu::where(['parent_id' => '0', 'type' => 'header'])->orderBy('order_by')->get());
        $view->with('footerMenu', Menu::where(['type' => 'footer'])->orderBy('order_by')->get());
        $view->with('SettingMenu', Setting::where(['type' => 'setting'])->get());
        $view->with('socialIcon', SocialIcon::where(['type' => 'social'])->get());
        
       

        $analyticsData = Analytics::all();
        $view->with('analyticsData', $analyticsData);
        
         $noscriptanalyticsData = NoscriptAnalytics::all();
        $view->with('noscriptanalyticsData', $noscriptanalyticsData);
    }
}
