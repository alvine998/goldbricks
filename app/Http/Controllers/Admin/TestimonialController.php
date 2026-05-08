<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->orderByDesc('created_at')->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'position'  => 'nullable|string|max:100',
            'company'   => 'nullable|string|max:100',
            'message'   => 'required|string',
            'photo'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'rating'    => 'nullable|integer|min:1|max:5',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'position'  => 'nullable|string|max:100',
            'company'   => 'nullable|string|max:100',
            'message'   => 'required|string',
            'photo'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'rating'    => 'nullable|integer|min:1|max:5',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
