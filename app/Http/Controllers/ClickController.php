<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClickController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|max:255',
        ]);

        // Undgå at tælle dine egne IP’er
        $ignoreIps = [
            '188.182.183.23', // din hjemme-IP
        ];

        $isIgnoredIp = in_array($request->ip(), $ignoreIps, true);

        // Undgå at tælle hvis man er admin
        $isAdmin = Auth::check() && Auth::user()->isAdmin();

        if ($isIgnoredIp || $isAdmin) {
            return response()->noContent(); // gør ingenting
        }

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
