<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pets = Pet::where('user_id', Auth::id())->latest()->paginate(10);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = (string) Str::uuid() . ($extension ? '.' . $extension : '');
            $directory = public_path('storage/pets');
            File::ensureDirectoryExists($directory);
            $file->move($directory, $filename);
            $data['image'] = 'pets/' . $filename;
        }

        Pet::create($data);

        return redirect()->route('pets.index')->with('success', '✅ Mascota registrada correctamente.');
    }

    public function show(Pet $pet)
    {
        $this->authorizeOwner($pet);
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $this->authorizeOwner($pet);
        return view('pets.edit', compact('pet'));
    }

    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $this->authorizeOwner($pet);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($pet->image) {
                File::delete(public_path('storage/' . $pet->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = (string) Str::uuid() . ($extension ? '.' . $extension : '');
            $directory = public_path('storage/pets');
            File::ensureDirectoryExists($directory);
            $file->move($directory, $filename);
            $data['image'] = 'pets/' . $filename;
        }

        $pet->update($data);

        return redirect()->route('pets.index')->with('success', '✅ Mascota actualizada correctamente.');
    }

    public function destroy(Pet $pet)
    {
        $this->authorizeOwner($pet);

        if ($pet->image) {
            File::delete(public_path('storage/' . $pet->image));
        }

        $pet->delete();

        return redirect()->route('pets.index')->with('success', '✅ Mascota eliminada correctamente.');
    }

    protected function authorizeOwner(Pet $pet)
    {
        if ($pet->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
