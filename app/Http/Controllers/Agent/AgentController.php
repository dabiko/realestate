<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\PropertyDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class AgentController extends Controller
{
    public function AgentDashboard(): View
    {
        return view('agent.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function AgentLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('agent.login');
    }

    public function AgentLogin(): View
    {
        return view('agent.auth.login');
    }

    public function AgentRegister(): View
    {
        return view('agent.auth.register');
    }

    public function processRegistration(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' =>  $validate['name'],
            'email' => $validate['email'],
            'role' => 'agent',
            'status' => 'inactive',
            'password' => Hash::make($validate['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENTDASHBOARD);
    }
}
