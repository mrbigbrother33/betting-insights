<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insight;

class HomeController extends Controller
{
    public function index()
    {
        $insights = Insight::with('category')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.index', compact('insights'));
    }
}
