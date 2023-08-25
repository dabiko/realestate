<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    use ImageUploadTraits;

    public function index(): View
    {

        $profile = User::findOrFail(Auth::id());

        return view('admin.profile.index',
            [
                'profile' => $profile,
            ]
        );
    }


    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = User::findOrFail(Auth::id());

        if($request->hasFile('image')){

            if(File::exists(public_path($user->photo))){
                File::delete(public_path($user->photo));
            }

            $imagePath = $this->updateAdminImage($request, 'image', 'upload/admin', $user->photo);

            $user->photo = $imagePath;
            $user->save();
        }

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->save();

        return Redirect::route('admin.profile')
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
    public function passwordUpdate(UpdatePasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('admin.password')
            ->with(
                [
                    'status' => 'success',
                    'message' => 'Password Updated Successfully!!'
                ]
            );
    }

}
