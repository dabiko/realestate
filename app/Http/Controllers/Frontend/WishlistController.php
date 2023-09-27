<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Wishlist;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishlistController extends Controller
{
    use EncryptDecrypt;
    public function addWishlist(Request $request, string $id): JsonResponse
    {
       $property_id =  $this->decryptId($id);
       $property =  Property::findOrFail($property_id);

       if (Auth::check()){

           $exist_list = Wishlist::where('user_id', Auth::id())
               ->where('property_id', $property_id)
               ->first();

           if (!$exist_list){
               Wishlist::create([
                   'user_id' => Auth::id(),
                   'agent_id' => $property->agent_id,
                   'property_id' => $property_id
               ]);

               return response()->json([
                   'status' => 'success',
                   'message' => 'property added successfully',
                   'property' => $property_id,
               ]);

           }else{

               return response()->json([
                   'status' => 'exist',
                   'message' => 'Existing in the list already',
               ]);
           }
       }else{
           return response()->json([
               'status' => 'login',
               'message' => 'please login to create a wishlist',
           ]);
       }

    }

    public function userWishList(): View
    {
        return View('frontend.profile.dashboard');
    }

    public function getUserWishList(): JsonResponse
    {
        $list = Wishlist::with(['property','agent'])->where('user_id', Auth::id())
            ->latest()
            ->get();

        $count = Wishlist::count();

        return Response()->json([
            'list'  => $list,
            'count' => $count,
        ]);

    }


    public function deleteUserWishList($id): JsonResponse
    {
        Wishlist::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();

        return Response()->json([
            'status'  => 'success',
            'message' => 'Removed successfully',
        ]);

    }
}
