<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChatMessageController extends Controller
{
    use EncryptDecrypt;

    public function index(): View
    {
        $user_messages = ChatMessage::with(['user','agent'])->where('user_id',Auth::id())->get();

        return view('frontend.profile.dashboard',
            [
                'user_messages' => $user_messages
            ]

        );
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'agent_id' => ['required',],
            'message' => ['required', 'string'],
        ]);

        ChatMessage::create([
            'user_id' => Auth::id(),
            'agent_id' => $validate['agent_id'],
            'message' => $validate['message'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'sent successfully'
        ]);



    }

    public function allUsers()
    {
        $chats = ChatMessage::with(['user','agent'])
            ->where('user_id',Auth::id())
            ->orderBy('id','DESC')
            ->orWhere('agent_id',Auth::id())
            ->get();

        return $chats->flatMap(function ($chat){
           return $chat->user_id === Auth::id() ? [$chat->user, $chat->agent] : [$chat->agent, $chat->user];
        })->unique();
    }

    public function userMessages(int $id): JsonResponse
    {
        $user = User::findOrFail($id);
            $messages = ChatMessage::where(function ($query) use ($id){
                $query->where('user_id',$id);
                $query->where('agent_id', Auth::id());
            })->orWhere(function ($query) use ($id){
                $query->where('user_id', Auth::id());
                $query->where('agent_id', $id);
            })->with('user')->get();

            return response()->json(
                [
                    'user' => $user,
                    'messages' => $messages
                ]
            );

    }
}
