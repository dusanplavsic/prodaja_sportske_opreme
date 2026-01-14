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
    public function index(Request $request): Response
    {
        $porudzbines = Porudzbine::all();

        return view('porudzbine.index', [
            'porudzbines' => $porudzbines,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('porudzbine.create');
    }

    public function store(PorudzbineStoreRequest $request): Response
    {
        $porudzbine = Porudzbine::create($request->validated());

        $request->session()->flash('porudzbine.id', $porudzbine->id);

        return redirect()->route('porudzbines.index');
    }

    public function show(Request $request, Porudzbine $porudzbine): Response
    {
        return view('porudzbine.show', [
            'porudzbine' => $porudzbine,
        ]);
    }

    public function edit(Request $request, Porudzbine $porudzbine): Response
    {
        return view('porudzbine.edit', [
            'porudzbine' => $porudzbine,
        ]);
    }

    public function update(PorudzbineUpdateRequest $request, Porudzbine $porudzbine): Response
    {
        $porudzbine->update($request->validated());

        $request->session()->flash('porudzbine.id', $porudzbine->id);

        return redirect()->route('porudzbines.index');
    }

    public function destroy(Request $request, Porudzbine $porudzbine): Response
    {
        $porudzbine->delete();

        return redirect()->route('porudzbines.index');
    }
}
