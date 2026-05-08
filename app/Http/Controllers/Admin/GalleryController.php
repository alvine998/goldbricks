<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->orderByDesc('created_at')->paginate(20);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:200',
            'image'       => 'required|image|mimes:jpeg,jpg,png,webp|max:5120',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,jpg,png,webp|max:5120',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['image'] = $request->file('image')->store('gallery', 'public');
        
        // Handle multiple images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('gallery', 'public');
            }
            $data['images'] = $images;
        }
        
        Gallery::create($data);
        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:200',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,jpg,png,webp|max:5120',
            'description' => 'nullable|string',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        // Handle removing specific images
        if ($request->has('remove_images')) {
            $images = $gallery->images ?? [];
            $removeIndices = collect($request->input('remove_images'))->map('intval')->sort()->reverse();
            foreach ($removeIndices as $index) {
                unset($images[$index]);
            }
            $data['images'] = array_values($images); // Re-index array
        } else {
            $data['images'] = $gallery->images ?? [];
        }

        // Handle multiple images (append to existing)
        if ($request->hasFile('images')) {
            $images = $data['images'];
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('gallery', 'public');
            }
            $data['images'] = $images;
        }

        $gallery->update($data);
        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil dihapus.');
    }
}
