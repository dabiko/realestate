<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PropertyBookTourDataTable;
use App\Http\Controllers\Controller;
use App\Models\PropertyBookTour;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AgentPropertyBookTourController extends Controller
{
    use EncryptDecrypt;
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyBookTourDataTable $dataTable)
    {
        $tour_messages = PropertyBookTour::with(['user','property'])->where('agent_id', Auth::id())->get();

        return $dataTable->render('agent.property.scheduled-tour.index',
            [
                'tour_messages' => $tour_messages
            ]
        );
    }


    public function propertySchedules():View
    {

        $tour_messages = PropertyBookTour::with(['user','property'])->where('agent_id', Auth::id())->get();

        return View('agent.property.scheduled-tour.inbox',
            [
                'tour_messages' => $tour_messages
            ]
        );
    }

    public function propertyScheduledDetails(string $id): View
    {
        $message_id = $this->decryptId($id);
        $tour_messages = PropertyBookTour::with(['user','property'])->where('agent_id', Auth::id())->get();


        $details = PropertyBookTour::findOrFail($message_id);


        return View('agent.property.scheduled-tour.inbox',
            [
                'tour_messages' => $tour_messages,
                'details' => $details,

            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $decrypted_id = $this->decryptId($id);

        $blog_comment = PropertyBookTour::findOrFail($decrypted_id);

        if ($blog_comment->status === 1){
            return response([
                'status' => 'error',
                'title' => 'Cant delete '.$blog_comment->subject,
                'message' => 'This Blog Post Comment is still active. Deactivate before deleting',
            ]);
        }

        $blog_comment->delete();
        return response([
            'status' => 'success',
            'message' => 'Comment Deleted successfully !!',
        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function checkIsApproved(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $tour_message = PropertyBookTour::findOrFail($decrypted_id);

        return response([
            'status' => 'success',
            'response' =>  $tour_message->status

        ]);
    }


    /**
     * Update the status resource in storage.
     */
    public function updateStatus(Request $request): Response
    {
        $decrypted_id = $this->decryptId($request->id);
        $tour_message = PropertyBookTour::findOrFail($decrypted_id);

        $tour_message->status = $request->status === 'true' ? 1 : 0;
        $tour_message->save();

        return response([
            'status' => 'success',
            'message' => $request->status === 'true' ? 'Schedule Confirmed' : 'Schedule Cancelled',
        ]);
    }
}
