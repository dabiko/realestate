<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TestimonialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TestimonialCreateRequest;
use App\Http\Requests\Backend\TestimonialUpdateRequest;
use App\Models\Testimonial;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use  EncryptDecrypt;
    use ImageUploadTraits;

    /**
     * Display a listing of the resource.
     */
    public function index(TestimonialDataTable $dataTable)
    {
        $testimonials = Testimonial::all();

        return $dataTable->render('admin.testimonial.index',
            [
                'testimonials' => $testimonials
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialCreateRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $imagePath = $this->uploadImage($request, 'image', 'upload/testimonial/users');

        Testimonial::create([
            'image' => $imagePath,
            'position' => $validate['position'],
            'name' => $validate['name'],
            'message' => $validate['message'],
            'status' => $validate['status'],
        ]);

        return Redirect::route('admin.testimonials.index')
            ->with([
                'status' => 'success',
                'message' => 'Testimonial created Successfully'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $decrypted_id =  $this->decryptId($id);

        $testimonial = Testimonial::findOrFail($decrypted_id);

        return view('admin.testimonial.edit',
            [
                'testimonial' => $testimonial
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialUpdateRequest $request, string $id): RedirectResponse
    {
        $validate = $request->validated();

        $decrypted_id =  $this->decryptId($id);
        $testimonial = Testimonial::findOrFail($decrypted_id);

        $imagePath = $this->updateTestimonialImage($request, 'image', 'upload/testimonial/users', $testimonial->image);
        $updatePath =  empty(!$request->image) ? $imagePath : $testimonial->image;

        Testimonial::findOrFail($decrypted_id)->update([
            'image' => $updatePath,
            'position' => $validate['position'],
            'name' => $validate['name'],
            'message' => $validate['message'],
            'status' => $validate['status'],
        ]);


        return Redirect::route('admin.testimonials.index')
            ->with([
                'status' => 'success',
                'message' => $validate['name']. ' Updated Successfully'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $testimonial = Testimonial::findOrFail($decrypted_id);

        if ($testimonial->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$testimonial->name,
                'message' => 'This testimonial is still active. Deactivate before deleting',
            ]);
        }
        $this->deleteImage($testimonial->image);
        $testimonial->delete();
        return response([
            'status' => 'success',
            'message' => 'testimonial Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateTestimonial(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $testimonial = Testimonial::findOrFail($decrypted_id);

        $testimonial->status = $request->status === 'true' ? 1 : 0;
        $testimonial->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Status Activated Successfully !!' : 'Status Deactivated Successfully !!',
        ]);
    }
}
