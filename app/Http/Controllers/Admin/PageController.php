<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all()->keyBy('slug');
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrNew(['slug' => $slug]);
        return view('admin.pages.edit', compact('page', 'slug'));
    }

    public function update(Request $request, string $slug)
    {
        $request->validate([
            'hero_title'    => 'nullable|string|max:200',
            'hero_subtitle' => 'nullable|string|max:300',
            'video_url'     => 'nullable|url|max:500',
            'hero_image'    => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'section_title' => 'nullable|string|max:200',
            'content'       => 'nullable|string',
        ]);

        $page = Page::firstOrNew(['slug' => $slug]);
        $page->fill($request->only(['hero_title', 'hero_subtitle', 'video_url', 'section_title', 'content']));

        if ($request->hasFile('hero_image')) {
            $page->hero_image = $request->file('hero_image')->store('pages', 'public');
        }

        $page->save();
        return back()->with('success', 'Halaman berhasil disimpan.');
    }
}
