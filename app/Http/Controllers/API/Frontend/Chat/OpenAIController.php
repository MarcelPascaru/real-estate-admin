<?php

namespace App\Http\Controllers\API\Frontend\Chat;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenAIController
{
    public function chat(Request $request)
    {
        $input = $request->validate([
            'message' => 'required|string'
        ]);
        $response = Http::withHeaders(
            [
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            ]
        )->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            "messages"=> [
                [
                    "role"=> "system",
                    "content"=> $input['message'],
                ]
            ],
        ]);

        $chatResponse = $response->json() ?? 'Sorry, I could not understand that.';

        return response()->json(['message' => $chatResponse]);
    }
}
