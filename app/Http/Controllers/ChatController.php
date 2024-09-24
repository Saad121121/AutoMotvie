<?php

// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        $apiKey = env('GOOGLE_GEMINI_API_KEY');

        try {
            // Send the POST request to the Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ]
            ]);

            $gptResponse = $response->json();
            
            // dd( $gptResponse);
            // Extract the reply text if it exists
            $reply = $gptResponse['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';

            return response()->json(['reply' => $reply]);
        } catch (\Exception $e) {
            Log::error('ChatController Error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}

