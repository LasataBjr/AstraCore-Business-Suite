<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        
        $teamMembers = TeamMember::where('status', true)
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::where('status', true)
            ->latest()
            ->take(6)
            ->get();

        return view('public.about', compact(
            
            'teamMembers',
            'testimonials'
        ));
    }
}
