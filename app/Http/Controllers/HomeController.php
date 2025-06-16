<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insight;

class HomeController extends Controller
{
    public function index()
    {
        $insights = Insight::with('category')->latest()->take(3)->get(); // eller paginate
        return view('pages.index', compact('insights'));
    }
}
