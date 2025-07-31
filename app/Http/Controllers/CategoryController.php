<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('insights')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = $category->insights()->with('category');

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

        return view('categories.show', compact('category', 'insights'));
    }
}
