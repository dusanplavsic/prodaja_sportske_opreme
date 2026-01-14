<?php

namespace App\Http\Controllers;

use App\Http\Requests\KupciStoreRequest;
use App\Http\Requests\KupciUpdateRequest;
use App\Models\Kupci;
use Illuminate\Http\Request;

class KupciController extends Controller
{
    public function index(Request $request)
    {
        $kupcis = Kupci::all();

        return view('kupci.index', [
            'kupcis' => $kupcis,
        ]);
    }

    public function create(Request $request)
    {
        return view('kupci.create');
    }

    public function store(KupciStoreRequest $request)
    {
        $kupci = Kupci::create($request->validated());

        $request->session()->flash('kupci.id', $kupci->id);

        return redirect()->route('kupcis.index');
    }

    public function show(Request $request, Kupci $kupci)
    {
        return view('kupci.show', [
            'kupci' => $kupci,
        ]);
    }

    public function edit(Request $request, Kupci $kupci)
    {
        return view('kupci.edit', [
            'kupci' => $kupci,
        ]);
    }

    public function update(KupciUpdateRequest $request, Kupci $kupci)
    {
        $kupci->update($request->validated());

        $request->session()->flash('kupci.id', $kupci->id);

        return redirect()->route('kupcis.index');
    }

    public function destroy(Request $request, Kupci $kupci)
    {
        $kupci->delete();

        return redirect()->route('kupcis.index');
    }
}
