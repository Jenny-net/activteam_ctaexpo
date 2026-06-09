<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NoscriptAnalytics;

class NoscriptAnalyticsController extends Controller
{
     public function NoscriptGoogleAnalyticsindex()
    {
        $analyticsData = NoscriptAnalytics::all();
        return view('pages.admin.noscript_analytics.index', compact('analyticsData'));
    }

   

    public function NoscriptGoogleAnalyticsEdit($id)
    {
        $analytics = NoscriptAnalytics::findOrFail($id);
        return view('pages.admin.noscript_analytics.edit', compact('analytics'));
    }

    public function NoscriptGoogleAnalyticsUpdate(Request $request, $id)
    {
        $request->validate([
            'tracking_code' => 'required',
        ]);

        $analytics = NoscriptAnalytics::findOrFail($id);
        $analytics->update([
            'tracking_code' => $request->tracking_code,
        ]);

        return redirect()->route('admin.noscriptanalytics')->with('success', 'Google Analytics tracking code updated successfully.');
    }
}
