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
         // Create individual variables that match your blade view 
        $totalServices = Service::count();
        $totalProjects = Project::count();
        $totalPosts    = BlogPost::count(); 
        $totalMessages = ContactMessage::count();
        $recentPosts = BlogPost::orderBy('created_at', 'desc')->take(5)->get();
        $unreadMessages = ContactMessage::unread()->count();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalServices', 
            'totalProjects', 
            'totalPosts', 
            'totalMessages',
            'recentPosts',
            'unreadMessages',
            'recentMessages'
        ));
        }
}
