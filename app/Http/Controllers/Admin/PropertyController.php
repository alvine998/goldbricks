<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyController
{
    public function index($projectSlug)
    {
        $project = Project::where('slug', $projectSlug)->firstOrFail();
        $properties = $project->properties()->orderBy('sort_order')->paginate(10);
        return view('admin.properties.index', compact('project', 'properties'));
    }

    public function create($projectSlug)
    {
        $project = Project::where('slug', $projectSlug)->firstOrFail();
        return view('admin.properties.create', compact('project'));
    }

    public function store($projectSlug, Request $request)
    {
        $project = Project::where('slug', $projectSlug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:house,apartment,ruko,kavling,other',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:available,sold,reserved',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:5120',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'images.max' => 'Maksimal 10 foto',
            'images.*.max' => 'Masing-masing foto maksimal 5 MB',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('properties', 'public');
        }

        // Handle multiple images
        $storedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $storedImages[] = $file->store('properties', 'public');
            }
        }
        if (!empty($storedImages)) {
            $validated['images'] = $storedImages;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $project->properties()->create($validated);

        return redirect()->route('admin.properties.index', $project->slug)->with('success', 'Properti berhasil ditambahkan.');
    }

    public function edit($projectSlug, Property $property)
    {
        $project = Project::where('slug', $projectSlug)->firstOrFail();
        if ($property->project_id !== $project->id) abort(404);
        return view('admin.properties.edit', compact('project', 'property'));
    }

    public function update($projectSlug, Request $request, Property $property)
    {
        $project = Project::where('slug', $projectSlug)->firstOrFail();
        if ($property->project_id !== $project->id) abort(404);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:house,apartment,ruko,kavling,other',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:available,sold,reserved',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:5120',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'images.max' => 'Maksimal 10 foto',
            'images.*.max' => 'Masing-masing foto maksimal 5 MB',
        ]);

        if ($request->hasFile('image')) {
            if ($property->image && \Storage::disk('public')->exists($property->image)) {
                \Storage::disk('public')->delete($property->image);
            }
            $validated['image'] = $request->file('image')->store('properties', 'public');
        }

        // Handle multiple images
        $storedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $storedImages[] = $file->store('properties', 'public');
            }
        }
        if (!empty($storedImages)) {
            $validated['images'] = $storedImages;
        }

        $property->update($validated);

        return redirect()->route('admin.properties.index', $project->slug)->with('success', 'Properti berhasil diperbarui.');
    }

    public function destroy($projectSlug, Property $property)
    {
        $project = Project::where('slug', $projectSlug)->firstOrFail();
        if ($property->project_id !== $project->id) abort(404);

        if ($property->image && \Storage::disk('public')->exists($property->image)) {
            \Storage::disk('public')->delete($property->image);
        }

        $property->delete();

        return redirect()->route('admin.properties.index', $project->slug)->with('success', 'Properti berhasil dihapus.');
    }
}
