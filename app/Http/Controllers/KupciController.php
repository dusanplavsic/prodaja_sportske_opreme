<?php

namespace App\Http\Controllers;

use App\Http\Requests\KupciStoreRequest;
use App\Http\Requests\KupciUpdateRequest;
use App\Models\Kupci;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KupciController extends Controller
{
    public function index(Request $request): Response
    {
        $kupcis = Kupci::all();

        return view('kupci.index', [
            'kupcis' => $kupcis,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('kupci.create');
    }

    public function store(KupciStoreRequest $request): Response
    {
        $kupci = Kupci::create($request->validated());

        $request->session()->flash('kupci.id', $kupci->id);

        return redirect()->route('kupcis.index');
    }

    public function show(Request $request, Kupci $kupci): Response
    {
        return view('kupci.show', [
            'kupci' => $kupci,
        ]);
    }

    public function edit(Request $request, Kupci $kupci): Response
    {
        return view('kupci.edit', [
            'kupci' => $kupci,
        ]);
    }

    public function update(KupciUpdateRequest $request, Kupci $kupci): Response
    {
        $kupci->update($request->validated());

        $request->session()->flash('kupci.id', $kupci->id);

        return redirect()->route('kupcis.index');
    }

    public function destroy(Request $request, Kupci $kupci): Response
    {
        $kupci->delete();

        return redirect()->route('kupcis.index');
    }
}
