<?php

namespace App\Http\Controllers;

use App\Http\Requests\Stavke_porudzbineStoreRequest;
use App\Http\Requests\Stavke_porudzbineUpdateRequest;
use App\Models\StavkePorudzbine;
use App\Models\Stavke_porudzbine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Stavke_porudzbineController extends Controller
{
    public function index(Request $request): Response
    {
        $stavkePorudzbines = StavkePorudzbine::all();

        return view('stavkePorudzbine.index', [
            'stavkePorudzbines' => $stavkePorudzbines,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('stavkePorudzbine.create');
    }

    public function store(Stavke_porudzbineStoreRequest $request): Response
    {
        $stavkePorudzbine = StavkePorudzbine::create($request->validated());

        $request->session()->flash('stavkePorudzbine.id', $stavkePorudzbine->id);

        return redirect()->route('stavkePorudzbines.index');
    }

    public function show(Request $request, Stavke_porudzbine $stavkePorudzbine): Response
    {
        return view('stavkePorudzbine.show', [
            'stavkePorudzbine' => $stavkePorudzbine,
        ]);
    }

    public function edit(Request $request, Stavke_porudzbine $stavkePorudzbine): Response
    {
        return view('stavkePorudzbine.edit', [
            'stavkePorudzbine' => $stavkePorudzbine,
        ]);
    }

    public function update(Stavke_porudzbineUpdateRequest $request, Stavke_porudzbine $stavkePorudzbine): Response
    {
        $stavkePorudzbine->update($request->validated());

        $request->session()->flash('stavkePorudzbine.id', $stavkePorudzbine->id);

        return redirect()->route('stavkePorudzbines.index');
    }

    public function destroy(Request $request, Stavke_porudzbine $stavkePorudzbine): Response
    {
        $stavkePorudzbine->delete();

        return redirect()->route('stavkePorudzbines.index');
    }
}
