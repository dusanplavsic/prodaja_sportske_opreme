<?php

namespace App\Http\Controllers;

use App\Http\Requests\PorudzbineStoreRequest;
use App\Http\Requests\PorudzbineUpdateRequest;
use App\Models\Porudzbine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PorudzbineController extends Controller
{
    // Prikaz svih porudžbina
    public function index(Request $request): View
    {
        $porudzbines = Porudzbine::all();

        return view('porudzbine.index', [
            'porudzbines' => $porudzbines,
        ]);
    }

    // Forma za kreiranje nove porudžbine
    public function create(Request $request): View
    {
        return view('porudzbine.create');
    }

    // Čuvanje nove porudžbine
    public function store(PorudzbineStoreRequest $request): RedirectResponse
    {
        $porudzbine = Porudzbine::create($request->validated());

        $request->session()->flash('porudzbine.id', $porudzbine->id);

        return redirect()->route('porudzbines.index');
    }

    // Prikaz jedne porudžbine
    public function show(Request $request, Porudzbine $porudzbine): View
    {
        return view('porudzbine.show', [
            'porudzbine' => $porudzbine,
        ]);
    }

    // Forma za uređivanje porudžbine
    public function edit(Request $request, Porudzbine $porudzbine): View
    {
        return view('porudzbine.edit', [
            'porudzbine' => $porudzbine,
        ]);
    }

    // Ažuriranje porudžbine
    public function update(PorudzbineUpdateRequest $request, Porudzbine $porudzbine): RedirectResponse
    {
        $porudzbine->update($request->validated());

        $request->session()->flash('porudzbine.id', $porudzbine->id);

        return redirect()->route('porudzbines.index');
    }

    // Brisanje porudžbine
    public function destroy(Request $request, Porudzbine $porudzbine): RedirectResponse
    {
        $porudzbine->delete();

        return redirect()->route('porudzbines.index');
    }
}
