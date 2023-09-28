<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PropertyMessageRequest;
use App\Models\PropertyMessage;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PropertyMessageController extends Controller
{
    use EncryptDecrypt;

    public function propertyMessage(PropertyMessageRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        $property_id = $this->decryptId($validate['property_id']);
        $agent_id = $this->decryptId($validate['agent_id']);

        if (Auth::check()){

            PropertyMessage::create([
                'user_id' => Auth::id(),
                'agent_id' => $agent_id,
                'property_id' => $property_id,
                'message' => $validate['message'],
            ]);



            return Redirect::back()->with([
                'status' => 'success',
                'message' => 'Message sent successfully'
            ]);

        }else{

            return Redirect::route('property.details', $validate['property_id'])
                ->with([
                    'status' => 'warning',
                    'message' => 'please login to send a message to the Agent'
                ]);
        }


    }
}
