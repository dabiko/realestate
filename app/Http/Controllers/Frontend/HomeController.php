<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('status', 1)
            ->limit(5)
            ->orderBy('id', 'ASC')
            ->get();

        $featured_property = Property::where('is_approved', 1)
            ->where('tag', 'featured')
            ->limit(3)
            ->orderBy('id', 'ASC')
            ->get();

        $property_agents = User::where('role', 'agent')
            ->where('status', 'active')
            ->limit(5)
            ->orderBy('id', 'ASC')
            ->get();

        return view('frontend.index',
            [
                'categories' => $categories,
                'featured_property' => $featured_property,
                'property_agents' => $property_agents,
            ]
        );
    }
}
