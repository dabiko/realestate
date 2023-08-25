<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Models\User;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    use ImageUploadTraits;
    public function index(): View
    {
        return view('frontend.index');
    }

    public function dashboard(): View
    {
        $user = User::findOrFail(Auth::id());

        return view('frontend.profile.dashboard',
            [
                'user' => $user,
            ]

        );
    }


    public function updateProfile(UpdateUserProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::findOrFail(Auth::id());

        if($request->hasFile('image')){

            if(File::exists(public_path($user->photo))){
                File::delete(public_path($user->photo));
            }

            $imagePath = $this->updateUserImage($request, 'image', 'upload/user', $user->photo);

            $user->photo = $imagePath;
            $user->save();
        }

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();

        return Redirect::route('user.profile.edit')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'Profile Updated Successfully!!'
                ]
            );
    }



    /**
     * Update the user's password.
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('user.password.update')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'Password Updated Successfully!!'
                ]
            );
    }





}
