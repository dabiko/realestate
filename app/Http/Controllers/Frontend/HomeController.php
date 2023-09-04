<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
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

        return view('frontend.index',
            [
                'categories' => $categories,
                'featured_property' => $featured_property,
            ]
        );
    }
}
