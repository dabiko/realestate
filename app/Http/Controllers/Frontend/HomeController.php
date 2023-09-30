<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\State;
use App\Models\Testimonial;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    use EncryptDecrypt;

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

        $hot_property = Property::where('is_approved', 1)
            ->where('tag', 'hot')
            ->limit(3)
            ->orderBy('id', 'ASC')
            ->get();

        $property_agents = User::where('role', 'agent')
            ->where('status', 'active')
            ->limit(5)
            ->orderBy('id', 'ASC')
            ->get();

        $states = State::where('status', 1)
            ->paginate(6);

        $all_states = State::where('status', 1)->get();
        $all_categories = Category::where('status', 1)->get();

        $testimonials = Testimonial::where('status', 1)
            ->orderBy('id', 'DESC')
            ->get();


        return view('frontend.index',
            [
                'categories' => $categories,
                'featured_property' => $featured_property,
                'hot_property' => $hot_property,
                'property_agents' => $property_agents,
                'states' => $states,
                'all_states' => $all_states,
                'all_categories' => $all_categories,
                'testimonials' => $testimonials
            ]
        );
    }


    public function searchProperty(Request $request): View
    {
       $request->validate(['search' => 'required']);
       $keyword = $request->search;
       $state_id =  $this->decryptId($request->state_id);
       $category_id = $this->decryptId($request->category_id);
       $purpose = $request->purpose;

       $state = State::findOrFail($state_id);
       $state_name = $state->name;

       $category = Category::findOrFail($category_id);
       $category_name = $category->name;

       $properties = Property::with(['state', 'category'])
           ->where('is_approved', 1)
           ->where('purpose', $purpose)
           ->where('name', 'like', '%'.$keyword.'%')
           ->whereHas('state', function ($query) use ($state_name){
               $query->where('name', 'like', '%'.$state_name.'%');
           })
           ->whereHas('category', function ($query) use ($category_name){
               $query->where('name', 'like', '%'.$category_name.'%');
           })
           ->paginate(4);

       return View('frontend.pages.property-search',
           [
               'keyword' => $keyword,
               'state_name' => $state_name,
               'category_name' => $category_name,
               'purpose' => $purpose,
               'properties' => $properties
           ]
       );
    }


}
