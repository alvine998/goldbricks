<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('sort_order')->orderByDesc('created_at')->paginate(20);
        return view('admin.banks.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.banks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'logo'      => 'required|image|mimes:jpeg,jpg,png,webp,svg|max:2048',
            'link'      => 'nullable|url',
            'sort_order' => 'nullable|integer',
        ]);

        $data['logo'] = $request->file('logo')->store('banks', 'public');
        Bank::create($data);
        return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil ditambahkan.');
    }

    public function edit(Bank $bank)
    {
        return view('admin.banks.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'logo'      => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:2048',
            'link'      => 'nullable|url',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('banks', 'public');
        }

        $bank->update($data);
        return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil diperbarui.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil dihapus.');
    }
}
