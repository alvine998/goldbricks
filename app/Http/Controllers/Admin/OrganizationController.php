<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::orderBy('sort_order')->orderByDesc('created_at')->paginate(20);
        return view('admin.organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('admin.organizations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'position'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('organizations', 'public');
        }

        Organization::create($data);
        return redirect()->route('admin.organizations.index')->with('success', 'Anggota organisasi berhasil ditambahkan.');
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, Organization $organization)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'position'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('organizations', 'public');
        }

        $organization->update($data);
        return redirect()->route('admin.organizations.index')->with('success', 'Anggota organisasi berhasil diperbarui.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return redirect()->route('admin.organizations.index')->with('success', 'Anggota organisasi berhasil dihapus.');
    }
}
