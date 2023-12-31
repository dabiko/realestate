<?php

namespace App\Traits;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Http\Requests\Backend\BlogPostUpdateRequest;
use App\Http\Requests\Backend\PropertyPlanCreateRequest;
use App\Http\Requests\Backend\PropertyPlanUpdateRequest;
use App\Http\Requests\Backend\PropertyUpdateRequest;
use App\Http\Requests\Backend\StateUpdateRequest;
use App\Http\Requests\Backend\TestimonialUpdateRequest;
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

    public function uploadPlanImage(PropertyPlanCreateRequest $request, $input, $path): string
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

    public function updatePlanImage(PropertyPlanUpdateRequest $request, $input, $path, $oldPath=null): string
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

    public function updateImage(Request $request, $input, $path, $oldPath=null): string
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



    public function updateStateImage(StateUpdateRequest $request, $input, $path, $oldPath=null): string
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

    public function updateTestimonialImage(TestimonialUpdateRequest $request, $input, $path, $oldPath=null): string
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

    public function updateBlogPostImage(BlogPostUpdateRequest $request, $input, $path, $oldPath=null): string
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
