<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private array $homeSettingKeys = [
        'stat_properties_sold', 'stat_label_properties', 'stat_label_projects',
        'stat_years_experience', 'stat_label_experience', 'stat_clients', 'stat_label_clients',
        'whyus_badge', 'whyus_title', 'whyus_desc',
        'whyus_1_title', 'whyus_1_desc', 'whyus_2_title', 'whyus_2_desc',
        'whyus_3_title', 'whyus_3_desc', 'whyus_4_title', 'whyus_4_desc',
        'bank_badge', 'bank_title', 'bank_subtitle',
        'testimonial_badge', 'testimonial_title', 'testimonial_subtitle',
    ];

    public function index()
    {
        $pages = Page::all()->keyBy('slug');
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrNew(['slug' => $slug]);
        $settings = [];
        if ($slug === 'home') {
            $settings = Setting::whereIn('key', $this->homeSettingKeys)->pluck('value', 'key')->toArray();
        }
        return view('admin.pages.edit', compact('page', 'slug', 'settings'));
    }

    public function update(Request $request, string $slug)
    {
        $rules = [
            'hero_title'    => 'nullable|string|max:200',
            'hero_subtitle' => 'nullable|string|max:300',
            'video_url'     => 'nullable|url|max:500',
            'hero_image'    => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'section_title' => 'nullable|string|max:200',
            'content'       => 'nullable|string',
        ];

        if ($slug === 'home') {
            $rules += [
                'stat_properties_sold'  => 'nullable|integer|min:0',
                'stat_label_properties' => 'nullable|string|max:50',
                'stat_label_projects'   => 'nullable|string|max:50',
                'stat_years_experience' => 'nullable|integer|min:0',
                'stat_label_experience' => 'nullable|string|max:50',
                'stat_clients'          => 'nullable|integer|min:0',
                'stat_label_clients'    => 'nullable|string|max:50',
                'whyus_badge'           => 'nullable|string|max:80',
                'whyus_title'           => 'nullable|string|max:200',
                'whyus_desc'            => 'nullable|string|max:400',
                'whyus_1_title'         => 'nullable|string|max:100',
                'whyus_1_desc'          => 'nullable|string|max:200',
                'whyus_2_title'         => 'nullable|string|max:100',
                'whyus_2_desc'          => 'nullable|string|max:200',
                'whyus_3_title'         => 'nullable|string|max:100',
                'whyus_3_desc'          => 'nullable|string|max:200',
                'whyus_4_title'         => 'nullable|string|max:100',
                'whyus_4_desc'          => 'nullable|string|max:200',
                'bank_badge'            => 'nullable|string|max:80',
                'bank_title'            => 'nullable|string|max:200',
                'bank_subtitle'         => 'nullable|string|max:300',
                'testimonial_badge'     => 'nullable|string|max:80',
                'testimonial_title'     => 'nullable|string|max:200',
                'testimonial_subtitle'  => 'nullable|string|max:300',
            ];
        }

        $request->validate($rules);

        $page = Page::firstOrNew(['slug' => $slug]);
        $page->fill($request->only(['hero_title', 'hero_subtitle', 'video_url', 'section_title', 'content']));

        if ($request->hasFile('hero_image')) {
            $page->hero_image = $request->file('hero_image')->store('pages', 'public');
        }

        $page->save();

        if ($slug === 'home') {
            foreach ($this->homeSettingKeys as $key) {
                Setting::set($key, $request->input($key));
            }
        }

        return back()->with('success', 'Halaman berhasil disimpan.');
    }
}
