<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicePageController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('public.services.index', compact('services'));
    }

     public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedServices = Service::where('id', '!=', $service->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        return view('public.services.show', compact(
            'service',
            'relatedServices'
        ));
    }
}
