<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\TeamMember;
use App\Models\SiteSetting;


class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $projects = Project::where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('status', true)
            ->latest()
            ->get();

        $teamMembers = TeamMember::where('status', true)
            ->orderBy('sort_order')
            ->get();

        $recentBlogs = BlogPost::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('public.home', compact(
            'services',
            'projects',
            'testimonials',
            'teamMembers',
            'recentBlogs'
        ));
    }
}
