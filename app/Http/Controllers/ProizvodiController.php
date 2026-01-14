<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProizvodiStoreRequest;
use App\Http\Requests\ProizvodiUpdateRequest;
use App\Models\Proizvodi;
use Illuminate\Http\Request;

class ProizvodiController extends Controller
{
    // Prikaz svih proizvoda
    public function index(Request $request) 
    {
        $proizvodis = Proizvodi::all();

        return view('proizvodi.index', [
            'proizvodis' => $proizvodis,
        ]);
    }

    // Forma za kreiranje novog proizvoda
    public function create(Request $request) 
    {
        return view('proizvodi.create');
    }

    // Čuvanje novog proizvoda u bazi
    public function store(ProizvodiStoreRequest $request) 
    {
        $proizvodi = Proizvodi::create($request->validated());

        $request->session()->flash('proizvodi.id', $proizvodi->id);

        return redirect()->route('proizvodis.index');
    }

    // Prikaz jednog proizvoda
    public function show(Request $request, Proizvodi $proizvodi) 
    {
        return view('proizvodi.show', [
            'proizvodi' => $proizvodi,
        ]);
    }

    // Forma za uređivanje proizvoda
    public function edit(Request $request, Proizvodi $proizvodi) 
    {
        return view('proizvodi.edit', [
            'proizvodi' => $proizvodi,
        ]);
    }

    // Ažuriranje proizvoda
    public function update(ProizvodiUpdateRequest $request, Proizvodi $proizvodi) 
    {
        $proizvodi->update($request->validated());

        $request->session()->flash('proizvodi.id', $proizvodi->id);

        return redirect()->route('proizvodis.index');
    }

    // Brisanje proizvoda
    public function destroy(Request $request, Proizvodi $proizvodi) 
    {
        $proizvodi->delete();

        return redirect()->route('proizvodis.index');
    }
}
