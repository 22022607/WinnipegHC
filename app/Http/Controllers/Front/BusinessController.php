<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $categories = [];
        $locations = [];

        $businesses = collect([
            [
                'id' => 1,
                'name' => 'ShantiLotus Healing Services',
                'category' => 'Energy Healing and Reiki',
                'location' => 'Downtown Winnipeg',
                'rating' => 4.9,
                'reviews' => 42,
                'phone' => '(204) 555-0123',
                'website' => 'shantilotus.ca',
                'hours' => 'Mon-Fri 9AM-6PM',
                'description' => 'Holistic healing center offering Reiki, crystal therapy, and meditation sessions.',
                'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?...',
                'featured' => true,
            ],
            // ... other businesses
        ]);

        // Apply filters
        $filtered = $businesses->filter(function($biz) use ($request) {
            $matchesSearch = !$request->search || str_contains(strtolower($biz['name']), strtolower($request->search)) 
                || str_contains(strtolower($biz['description']), strtolower($request->search));

            $matchesCategory = $request->category === 'all' || $biz['category'] === $request->category;
            $matchesLocation = $request->location === 'all' || $biz['location'] === $request->location;

            return $matchesSearch && $matchesCategory && $matchesLocation;
        });

        return view('front.business.index', [
            'businesses' => $filtered,
            'categories' => $categories,
            'locations' => $locations,
        ]);
    }

    public function show($id)
    {
        // show single business profile
    }
}

   

