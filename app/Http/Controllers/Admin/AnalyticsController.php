<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Analytics;

class AnalyticsController extends Controller
{
    public function GoogleAnalyticsindex()
    {
        $analyticsData = Analytics::all();
        return view('pages.admin.analytics.index', compact('analyticsData'));
    }

   

    public function GoogleAnalyticsEdit($id)
    {
        $analytics = Analytics::findOrFail($id);
        return view('pages.admin.analytics.edit', compact('analytics'));
    }

    public function GoogleAnalyticsUpdate(Request $request, $id)
    {
        $request->validate([
            'tracking_code' => 'required',
        ]);

        $analytics = Analytics::findOrFail($id);
        $analytics->update([
            'tracking_code' => $request->tracking_code,
        ]);

        return redirect()->route('admin.analytics')->with('success', 'Google Analytics tracking code updated successfully.');
    }

   


}
