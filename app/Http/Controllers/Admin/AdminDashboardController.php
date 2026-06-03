<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
     public function index()
    {
          $stats = [
            'services' => Service::count(),
            'projects' => Project::count(),
            'blogPosts' => BlogPost::count(),
            'messages' => ContactMessage::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
