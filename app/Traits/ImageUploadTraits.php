<?php

namespace App\Traits;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Http\Requests\Backend\PropertyUpdateRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTraits
{


    public function uploadImage(Request $request, $input, $path): string
    {
        if($request->hasFile($input)){
            $image = $request->{$input};
            $extension = $image->getClientOriginalExtension();
            $imgName = 'media_'.uniqid().'.'.$extension;

            $image->move(public_path($path), $imgName);
            return  $path.'/'.$imgName;
        }
        return '';
    }

    public function updateAdminImage(UpdateProfileRequest $request, $input, $path, $oldPath=null): string
    {
        if($request->hasFile($input)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $image = $request->{$input};
            $extension = $image->getClientOriginalExtension();
            $imgName = 'media_'.uniqid().'.'.$extension;

            $image->move(public_path($path), $imgName);
            return  $path.'/'.$imgName;

        }else{

            return 'No image provided';
        }

    }

    public function updateUserImage(UpdateUserProfileRequest $request, $input, $path, $oldPath=null): string
    {
        if($request->hasFile($input)){

            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $image = $request->{$input};
            $extension = $image->getClientOriginalExtension();
            $imgName = 'media_'.uniqid().'.'.$extension;

            $image->move(public_path($path), $imgName);
            return  $path.'/'.$imgName;

        }else{

            return 'No image provided';
        }

    }

    public function updatePropertyImage(PropertyUpdateRequest $request, $input, $path, $oldPath=null): string
    {
        if($request->hasFile($input)){

            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $image = $request->{$input};
            $extension = $image->getClientOriginalExtension();
            $imgName = 'media_'.uniqid().'.'.$extension;

            $image->move(public_path($path), $imgName);
            return  $path.'/'.$imgName;

        }else{

            return 'No image provided';
        }

    }

    public function deleteImage(string $path): void
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }

    public function uploadMultiImage(Request $request, $input, $path): array
    {
        $imagePaths = [];

        if($request->hasFile($input)){

            $images = $request->{$input};

            foreach ($images as $image){
                $extension = $image->getClientOriginalExtension();
                $imgName = 'media_'.uniqid().'.'.$extension;

                $image->move(public_path($path), $imgName);

                $imagePaths[] = $path.'/'.$imgName;
            }

            return $imagePaths;
        }
        return $imagePaths;
    }

}
