<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{

    public function categories(): View
    {
        $categories = Category::where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();

            return view('frontend.pages.categories',
                [
                    'categories' => $categories,

                ]
            );

    }
}
