<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::orderBy('sort_order')->orderByDesc('created_at')->paginate(20);
        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'position'   => 'nullable|string|max:100',
            'photo'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'facebook'   => 'nullable|url|max:255',
            'twitter'    => 'nullable|url|max:255',
            'linkedin'   => 'nullable|url|max:255',
            'pinterest'  => 'nullable|url|max:255',
            'whatsapp'   => 'nullable|string|max:30',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('agents', 'public');
        }

        Agent::create($data);
        return redirect()->route('admin.agents.index')->with('success', 'Agen berhasil ditambahkan.');
    }

    public function edit(Agent $agent)
    {
        return view('admin.agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:100',
            'position'   => 'nullable|string|max:100',
            'photo'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'facebook'   => 'nullable|url|max:255',
            'twitter'    => 'nullable|url|max:255',
            'linkedin'   => 'nullable|url|max:255',
            'pinterest'  => 'nullable|url|max:255',
            'whatsapp'   => 'nullable|string|max:30',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($agent->photo) {
                Storage::disk('public')->delete($agent->photo);
            }
            $data['photo'] = $request->file('photo')->store('agents', 'public');
        }

        $agent->update($data);
        return redirect()->route('admin.agents.index')->with('success', 'Agen berhasil diperbarui.');
    }

    public function destroy(Agent $agent)
    {
        if ($agent->photo) {
            Storage::disk('public')->delete($agent->photo);
        }
        $agent->delete();
        return redirect()->route('admin.agents.index')->with('success', 'Agen berhasil dihapus.');
    }
}
