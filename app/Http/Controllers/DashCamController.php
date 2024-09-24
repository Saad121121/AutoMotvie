<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashCamController extends Controller
{
    public function index()
    {
        return view('dashboard.dashcam.index');
    }
    public function store(Request $request)
    {
        // Retrieve all input from the request
        $input = $request->all();

        // Define valid credentials
        $validEmail = "security_123";
        $validPassword = "Corsair@123";

        // Validate the request input against the valid credentials
        if ($input['dashEmail'] === $validEmail && $input['dashPass'] === $validPassword) {
            // Redirect to the URL if credentials are valid
            return redirect()->to('https://rtsp.me/embed/5GENiafB/');
        } else {
            // Redirect back with an error message if credentials are invalid
            return redirect()->back()->withErrors(['invalid' => 'Invalid credentials!']);
        }
    }
}
