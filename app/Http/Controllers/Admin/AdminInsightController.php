<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Insight;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;


class AdminInsightController extends Controller
{

    public function index()
    {
        $insights = Insight::with('category')->orderByDesc('published_at')->paginate(15);

        return view('admin.insights.index', compact('insights'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.insights.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'nullable|string|unique:insights,slug',
            'content'       => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'published_at'  => 'nullable|date',
            'image'         => 'nullable|image|max:5120', // 5MB, jpg/png/webp etc.
            'affiliate_url' => 'nullable|url',
        ], [
            'title.required'         => 'Titel er påkrævet.',
            'title.max'              => 'Titlen må højst være 255 tegn.',
            'slug.unique'            => 'Sluggen skal være unik.',
            'content.required'       => 'Indhold er påkrævet.',
            'category_id.exists'     => 'Vælg en gyldig kategori.',
            'category_id.required' => 'Du skal vælge en kategori.',
            'published_at.date'      => 'Publiceringsdatoen skal være en gyldig dato.',
            'image.image'            => 'Den valgte fil skal være et billede.',
            'image.max'              => 'Billedet må højst være 5MB.',
            'affiliate_url.url'      => 'Affiliate-linket skal være en gyldig URL.',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image_url'] = $request->file('image')->store('insight-images', 'public');
        }

        // Automatisk slug hvis ikke angivet
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }

        // Opret Insight
        Insight::create($validatedData);

        return redirect()
            ->route('admin.insights.index')
            ->with('success', 'Insight blev oprettet.');
    }

    public function edit(Insight $insight)
    {
        $categories = Category::all();
        return view('admin.insights.edit', compact('insight', 'categories'));
    }

    public function update(Request $request, Insight $insight)
    {

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'nullable|string|unique:insights,slug,' . $insight->id,
            'content'       => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'published_at'  => 'nullable|date',
            'image'         => 'nullable|image|max:5120',
            'affiliate_url' => 'nullable|url',
        ], [
            'title.required'         => 'Titel er påkrævet.',
            'title.max'              => 'Titlen må højst være 255 tegn.',
            'slug.unique'            => 'Sluggen skal være unik.',
            'content.required'       => 'Indhold er påkrævet.',
            'category_id.exists'     => 'Vælg en gyldig kategori.',
            'category_id.required' => 'Du skal vælge en kategori.',
            'published_at.date'      => 'Publiceringsdatoen skal være en gyldig dato.',
            'image.image'            => 'Den valgte fil skal være et billede.',
            'image.max'              => 'Billedet må højst være 5MB.',
            'affiliate_url.url'      => 'Affiliate-linket skal være en gyldig URL.',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize til fx maks bredde 1200px, bevar aspektforhold
            $resized = Image::make($image)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // Forhindrer forstørrelse af små billeder
                })
                ->encode();

            Storage::disk('public')->put("insight-images/{$filename}", $resized);

            $validated['image_url'] = "insight-images/{$filename}";
        }

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        $insight->update($validated);

        return redirect()->route('admin.insights.index')->with('success', 'Indlægget er opdateret.');
    }


    public function destroy(Insight $insight)
    {
        $insight->delete();

        // Check if request came from dashboard
        if (request()->query('from') == 'dashboard') {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Insight blev slettet.');
        }

        return redirect()
            ->route('admin.insights.index')
            ->with('success', 'Insight blev slettet.');
    }

    public function removeImage(Insight $insight)
    {
        if ($insight->image_url && Storage::disk('public')->exists($insight->image_url)) {
            Storage::disk('public')->delete($insight->image_url);
        }

        $insight->update(['image_url' => null]);

        return back()->with('success', 'Billedet er fjernet.');
    }
}
