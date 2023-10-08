<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgentChatMessageController extends Controller
{
    public function liveChats():View
    {
        return view('agent.property.live-chat.index');
    }
}
