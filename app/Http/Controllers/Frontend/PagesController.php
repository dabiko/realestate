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

            return view('frontend.pages.categories',
                [
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
}
