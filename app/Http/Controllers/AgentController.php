<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AgentController extends Controller
{
    public function AgentDashboard(): View
    {
        return view('agent.dashboard');
    }
}
