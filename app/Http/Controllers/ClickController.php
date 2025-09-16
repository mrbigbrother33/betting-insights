<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClickController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|max:255',
        ]);

        DB::table('blog_clicks')->insertOrIgnore([
            'slug'       => $data['slug'],
            'ip'         => $request->ip(),              // automatisk IP
            'clicked_at' => now(),
            'visited_on' => now()->toDateString(),       // dato
        ]);

        return response()->noContent();
    }
}
