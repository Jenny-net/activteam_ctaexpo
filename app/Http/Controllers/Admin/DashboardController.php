<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $dataArr = [
            "page_title" => "Dashboard",
        ];

        return view('pages.admin.dashboard.index')->with('dataArr', $dataArr);
    }
}
