<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Project;
use App\Models\BlogPost;
use Carbon\Carbon;
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

        $weeklyViews = [];
        for ($i = 6; $i >= 0; $i--) {
            $dayName = Carbon::now()->subDays($i)->format('D'); // Get day name like 'Mon', 'Tue', etc.
            $weeklyViews[$dayName] = 0; // Initialize with 0 views for each day of the week
        }

        $postsTraffic = BlogPost::where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay()) // Get posts created in the last 7 days
            ->get()
            ->groupBy(function ($post) {
                return $post->created_at->format('D');
            });

        foreach ($postsTraffic as $day => $posts) { // Loop through each day and its associated posts
            if (isset($weeklyViews[$day])) {
                // Sum up all the views accumulated by posts created on that day
                $weeklyViews[$day] = $posts->sum('views'); 
            }
        }

        return view('admin.dashboard', compact(
            'totalServices', 
            'totalProjects', 
            'totalPosts', 
            'totalMessages',
            'recentPosts',
            'unreadMessages',
            'recentMessages',
            'weeklyViews',
        ));
        }
}
