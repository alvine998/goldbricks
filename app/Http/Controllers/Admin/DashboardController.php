<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'featured'       => Project::where('featured', true)->count(),
            'gallery'        => Gallery::count(),
            'available'      => Project::where('status', 'available')->count(),
        ];
        $site_name = Setting::get('site_name', 'Midland Properti');
        return view('admin.dashboard', compact('stats', 'site_name'));
    }
}
