<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YoutubeController extends Controller
{
    // public $default;

    /**
     * Return the details of the youtube search.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => 'sometimes|required|string|min:1|max:255',
        ]);

        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'key' => config('app.yt_key'),
            'part' => 'snippet',
            'maxResults' => 10,
            'q' => $request->input('search', config('app.yt_fallback')),
        ]);

        if ($response->successful()) {
            return $response->json()['items'];
        }
        return [];
    }
}
