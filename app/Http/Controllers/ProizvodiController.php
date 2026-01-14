<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProizvodiStoreRequest;
use App\Http\Requests\ProizvodiUpdateRequest;
use App\Models\Proizvodi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProizvodiController extends Controller
{
    public function index(Request $request): Response
    {
        $proizvodis = Proizvodi::all();

        return view('proizvodi.index', [
            'proizvodis' => $proizvodis,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('proizvodi.create');
    }

    public function store(ProizvodiStoreRequest $request): Response
    {
        $proizvodi = Proizvodi::create($request->validated());

        $request->session()->flash('proizvodi.id', $proizvodi->id);

        return redirect()->route('proizvodis.index');
    }

    public function show(Request $request, Proizvodi $proizvodi): Response
    {
        return view('proizvodi.show', [
            'proizvodi' => $proizvodi,
        ]);
    }

    public function edit(Request $request, Proizvodi $proizvodi): Response
    {
        return view('proizvodi.edit', [
            'proizvodi' => $proizvodi,
        ]);
    }

    public function update(ProizvodiUpdateRequest $request, Proizvodi $proizvodi): Response
    {
        $proizvodi->update($request->validated());

        $request->session()->flash('proizvodi.id', $proizvodi->id);

        return redirect()->route('proizvodis.index');
    }

    public function destroy(Request $request, Proizvodi $proizvodi): Response
    {
        $proizvodi->delete();

        return redirect()->route('proizvodis.index');
    }
}
