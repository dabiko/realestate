<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse|Response
    {
        $request->authenticate();

        $request->session()->regenerate();


        if($request->user()->role === 'admin'){

            return redirect()->intended(RouteServiceProvider::ADMINDASHBOARD);

        }elseif ($request->user()->role === 'agent'){

            return redirect()->intended(RouteServiceProvider::AGENTDASHBOARD);

        }elseif ($request->user()->role === 'user'){

            return redirect()->intended(RouteServiceProvider::HOME);

        }else{

            return Response::deny('who are you please? :)');

        }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
