<?php

namespace App\Http\Controllers\cms;
use Illuminate\Http\Request;
use App\Models\Variable;
use App\Http\Controllers\Controller;

class VariablesController extends Controller
{
    /**
     * Display a listing of the variables.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variables = Variable::all();
        return view('cms.variables.index', compact('variables'));
    }

    /**
     * Show the form for creating a new variable.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.variables.create');
    }

    /**
     * Store a newly created variable in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'value' => 'required',
        ]);

        Variable::create($request->all());

        return redirect()->route('variables.index')
            ->with('success', 'Variable created successfully.');
    }

    /**
     * Display the specified variable.
     *
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function show(Variable $variable)
    {
        return view('cms.variables.show', compact('variable'));
    }

    /**
     * Show the form for editing the specified variable.
     *
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function edit(Variable $variable)
    {
        return view('cms.variables.edit', compact('variable'));
    }

    /**
     * Update the specified variable in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variable $variable)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'value' => 'required',
        ]);

        $variable->update($request->all());

        return redirect()->route('variables.index')
            ->with('success', 'Variable updated successfully.');
    }

    /**
     * Remove the specified variable from storage.
     *
     * @param  \App\Models\Variable  $variable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variable $variable)
    {
        $variable->delete();

        return redirect()->route('variables.index')
            ->with('success', 'Variable deleted successfully.');
    }
}