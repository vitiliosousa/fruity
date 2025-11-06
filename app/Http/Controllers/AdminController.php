<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $fruits = Fruit::orderBy('created_at', 'desc')->get();
        
        return Inertia::render('Admin/Index', [
            'fruits' => $fruits
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload da imagem se existir
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fruits', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        Fruit::create($validated);

        return redirect()->route('admin.index')->with('success', 'Fruta adicionada com sucesso!');
    }

    public function edit(Fruit $fruit)
    {
        return Inertia::render('Admin/Edit', [
            'fruit' => $fruit
        ]);
    }

    public function update(Request $request, Fruit $fruit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload da nova imagem se existir
        if ($request->hasFile('image')) {
            // Deletar imagem antiga se existir
            if ($fruit->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $fruit->image));
            }
            
            $imagePath = $request->file('image')->store('fruits', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        $fruit->update($validated);

        return redirect()->route('admin.index')->with('success', 'Fruta atualizada com sucesso!');
    }

    public function destroy(Fruit $fruit)
    {
        // Deletar imagem se existir
        if ($fruit->image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $fruit->image));
        }

        $fruit->delete();

        return redirect()->route('admin.index')->with('success', 'Fruta removida com sucesso!');
    }
}
