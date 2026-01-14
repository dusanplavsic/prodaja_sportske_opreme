<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategorijeStoreRequest;
use App\Http\Requests\KategorijeUpdateRequest;
use App\Models\Kategorije;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategorijeController extends Controller
{
    public function index(Request $request): Response
    {
        $kategorijes = Kategorije::all();

        return view('kategorije.index', [
            'kategorijes' => $kategorijes,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('kategorije.create');
    }

    public function store(KategorijeStoreRequest $request): Response
    {
        $kategorije = Kategorije::create($request->validated());

        $request->session()->flash('kategorije.id', $kategorije->id);

        return redirect()->route('kategorijes.index');
    }

    public function show(Request $request, Kategorije $kategorije): Response
    {
        return view('kategorije.show', [
            'kategorije' => $kategorije,
        ]);
    }

    public function edit(Request $request, Kategorije $kategorije): Response
    {
        return view('kategorije.edit', [
            'kategorije' => $kategorije,
        ]);
    }

    public function update(KategorijeUpdateRequest $request, Kategorije $kategorije): Response
    {
        $kategorije->update($request->validated());

        $request->session()->flash('kategorije.id', $kategorije->id);

        return redirect()->route('kategorijes.index');
    }

    public function destroy(Request $request, Kategorije $kategorije): Response
    {
        $kategorije->delete();

        return redirect()->route('kategorijes.index');
    }
}
