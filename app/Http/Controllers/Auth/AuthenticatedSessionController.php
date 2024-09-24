<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
        // return redirect()->intended(route('dealer-dashboard',['id' => Auth::user()->showroom_id], absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $role_id = Auth::user()->role_id; // Get the role_id before logging out
     
        Auth::guard('web')->logout(); // Logout the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the session token
     
        // Redirect based on the role_id
        if ($role_id == 5) {
            return redirect()->route('login.company');  // Redirect to company login
        } elseif (in_array($role_id, [1, 2, 3])) {
            return redirect()->route('login.dealer');   // Redirect to dealer login
        } elseif ($role_id == 4) {
            return redirect()->route('login.customer'); // Redirect to customer login
        }
     
        return redirect('/'); // Default redirect if no role matches
    }
}
