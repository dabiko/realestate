<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\PropertyDetail;
use App\Models\PropertyFacility;
use App\Models\PropertyGallery;
use App\Models\PropertyLocation;
use App\Models\PropertyMap;
use App\Models\PropertyPlan;
use App\Models\PropertyStats;
use App\Models\State;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    use EncryptDecrypt;

    public function categories(): View
    {
        $categories = Category::where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();

        $recent_properties = Property::with(['category'])->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(3);

            return view('frontend.pages.categories',
                [
                    'categories' => $categories,
                    'recent_properties' => $recent_properties,

                ]
            );

    }


    public function propertyCategory(): View
    {
        $category_id = $this->decryptId(request()->category);

        $properties = Property::with(['category'])->where('status', 1)
            ->where('category_id',$category_id)
            ->orderBy('id', 'ASC')
            ->get();

        $count = Property::with(['category'])->where('status', 1)
            ->where('category_id',$category_id)
            ->count();

        $categories = Category::where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();


        $category = Category::findOrFail($category_id);

        return view('frontend.pages.property-category',
            [
                'count' => $count,
                'category' => $category,
                'properties' => $properties,
                'categories' => $categories,

            ]
        );

    }


    public function property(string $id): View
    {
        $decrypted_id = $this->decryptId($id);
       //dd($request);
        $property = Property::findOrFail($decrypted_id);

        //dd($amenity_id);

        $sliders = PropertyGallery::where('property_id',$property->id)->get();

        $details = PropertyDetail::where('property_id',$property->id)
            ->where('status', 1)
            ->get();

        $amenities = PropertyAmenity::where('property_id',$property->id)
            ->where('status', 1)
            ->get();

        $plansActive = PropertyPlan::where('property_id',$property->id)
            ->where('status', 1)
            ->where('is_default', 1)
            ->first();

        $plans = PropertyPlan::where('property_id',$property->id)
            ->where('status', 1)
            ->where('is_default', 0)
            ->get();

        $locations = PropertyLocation::where('property_id',$property->id)
            ->where('status', 1)
            ->get();

        $facilities = PropertyFacility::where('property_id',$property->id)
            ->where('status', 1)
            ->get();

        $maps = PropertyMap::where('property_id',$property->id)
            ->first();

        $stats = PropertyStats::where('property_id',$property->id)->get();

        $similar_property = Property::where('id', '!=', $property->id)
            ->limit(3)
            ->orderBy('id', 'ASC')
            ->get();

        return view('frontend.pages.property',
            [
                'property'  => $property,
                'sliders'  => $sliders,
                'details'  => $details,
                'amenities'  => $amenities,
                'plansActive'  => $plansActive,
                'plans'  => $plans,
                'locations' => $locations,
                'facilities' => $facilities,
                'stats' => $stats,
                'maps' => $maps,
                'similar_property' => $similar_property

            ]
        );

    }


    public function agentDetails(string $id): View
    {
        $decrypted_id = $this->decryptId($id);

        $agent = User::findOrFail($decrypted_id);

        $agent_properties = Property::with(['category'])->where('user_id',$decrypted_id)->get();

        $count = Property::with(['category'])->where('user_id',$decrypted_id)->count();

        $sale = Property::where('user_id',$decrypted_id)
            ->where('purpose', 'sale')
            ->count();

        $buy = Property::where('user_id',$decrypted_id)
            ->where('purpose', 'buy')
            ->count();

        $rent = Property::where('user_id',$decrypted_id)
            ->where('purpose', 'rent')
            ->count();


        $featured_properties = Property::where('user_id', '!=', $agent->id)
            ->where('tag', 'featured')
            ->limit(3)
            ->orderBy('id', 'ASC')
            ->get();


        return view('frontend.pages.agent',
            [
                'agent'  => $agent,
                'count'  => $count,
                'sale'   => $sale,
                'buy'    => $buy,
                'rent'   => $rent,
                'agent_properties'  => $agent_properties,
                'featured_properties'  => $featured_properties,
            ]
        );

    }

    public function agentListing(): View
    {
        $purpose = request()->purpose;
        $agent = $this->decryptId(request()->agent);

        $properties = Property::with(['agent'])->where('user_id',$agent)
            ->where('purpose',$purpose )
            ->paginate(4);

        $property_agent = User::findOrFail($agent);

        $sale = Property::where('user_id',$agent)
            ->where('purpose', 'sale')
            ->count();

        $buy = Property::where('user_id',$agent)
            ->where('purpose', 'buy')
            ->count();

        $rent = Property::where('user_id',$agent)
            ->where('purpose', 'rent')
            ->count();

        return View('frontend.pages.agent-listing',
            [
                'property_agent' => $property_agent,
                'properties' => $properties,
                'sale'   => $sale,
                'buy'    => $buy,
                'rent'   => $rent,
            ]
        );

    }

    public function stateListing(): View
    {


        $states = State::where('status', 1)->get();


        return View('frontend.pages.state-listing',
            [
                'states'   => $states,
            ]
        );

    }


    public function properties(): View
    {

        $properties = Property::with(['agent'])->paginate(4);

        $sale = Property::where('purpose', 'sale')->count();

        $buy = Property::where('purpose', 'buy')->count();

        $rent = Property::where('purpose', 'rent')->count();

        return View('frontend.pages.properties',
            [
                'properties' => $properties,
                'sale'   => $sale,
                'buy'    => $buy,
                'rent'   => $rent,
            ]
        );

    }


    public function propertyListing(): View
    {
        $purpose = request()->purpose;

        $properties = Property::with(['agent'])
            ->where('purpose', $purpose)
            ->paginate(4);



        $sale = Property::where('purpose', 'sale')->count();

        $buy = Property::where('purpose', 'buy')->count();

        $rent = Property::where('purpose', 'rent')->count();

        return View('frontend.pages.property-listing',
            [
                'properties' => $properties,
                'sale'   => $sale,
                'buy'    => $buy,
                'rent'   => $rent,
            ]
        );

    }

    public function propertyStates(): View
    {
        $decrypted_id = $this->decryptId(request()->property);

        $state = State::findOrFail($decrypted_id);

        $properties = Property::with(['state','agent'])->where('state_id',$decrypted_id)
            ->paginate(4);

        $sale = Property::where('state_id',$decrypted_id)
            ->where('purpose', 'sale')
            ->count();

        $buy = Property::where('state_id',$decrypted_id)
            ->where('purpose', 'buy')
            ->count();

        $rent = Property::where('state_id',$decrypted_id)
            ->where('purpose', 'rent')
            ->count();




        return view('frontend.pages.state-property',
            [
                'sale'   => $sale,
                'buy'    => $buy,
                'rent'   => $rent,
                'properties'  => $properties,
            ]
        );

    }
}
