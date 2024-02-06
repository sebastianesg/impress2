<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CustmoProduct;
use App\Models\Order;
use App\Models\User;
use App\Models\Variable;
use App\Models\Client;
use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class ComboController extends Controller
{
    public function index()
    {
        $combos = Combo::all();
        return view('cms.combos.index', compact('combos'));
    }

    public function create()
    {
        return view('cms.combos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $combo = Combo::create($request->all());

        return redirect()->route('combos.index')->with('success', 'Combo creado exitosamente.');
    }

    public function show(Combo $combo)
    {
        return view('cms.combos.show', compact('combo'));
    }

    public function edit(Combo $combo)
    {
        return view('cms.combos.edit', compact('combo'));
    }

    public function update(Request $request, Combo $combo)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $combo->update($request->all());

        return redirect()->route('cms.combos.index')->with('success', 'Combo actualizado exitosamente.');
    }

    public function destroy(Combo $combo)
    {
        $combo->delete();

        return redirect()->route('cms.combos.index')->with('success', 'Combo eliminado exitosamente.');
    }
}
