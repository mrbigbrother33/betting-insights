<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{

    public function index()
    {
        $insights = Auth::user()
            ->likes()
            ->with('insight.category')
            ->get()
            ->pluck('insight');

        return view('insights.favorites', compact('insights'));
    }

    public function toggle(Insight $insight)
    {
        $user = Auth::user();

        $liked = $insight->likes()->where('user_id', $user->id)->exists();

        if ($liked) {
            $insight->likes()->where('user_id', $user->id)->delete();
        } else {
            $insight->likes()->create(['user_id' => $user->id]);
        }

        return response()->json(['liked' => !$liked, 'count' => $insight->likes()->count()]);
    }
}
