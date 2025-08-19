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

        DB::table('blog_clicks')->insert([
            'slug'       => $data['slug'],
            'clicked_at' => now(),
            // (valgfrit) ekstra signaler:
            // 'ip'         => $request->ip(),
            // 'ua'         => substr($request->userAgent() ?? '', 0, 255),
        ]);

        return response()->noContent(); // 204
    }
}
