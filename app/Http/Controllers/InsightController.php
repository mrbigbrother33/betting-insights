<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insight;
use App\Models\Category;

class InsightController extends Controller
{
    public function index()
    {
        $query = Insight::with('category');

        if ($search = request('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        if (request('sort') === 'latest') {
            $query->latest('published_at');
        } elseif (request('sort') === 'oldest') {
            $query->oldest('published_at');
        } elseif (request('sort') === 'popular') {
            $query->withCount('likes')->orderByDesc('likes_count');
        }

        $insights = $query->paginate(12);

        return view('insights.index', compact('insights'));
    }

    public function show(Insight $insight)
    {
        return view('insights.show', compact('insight'));
    }
}
