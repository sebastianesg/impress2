<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return view('cms.admin.roles', ['roles' => $roles, 'max' => ROl::MAX_SECTIONS]);
    }

    public function store(Request $request)
    {
        $rol = Rol::find($request->input('id', 0));
        if (!$rol) $rol = new Rol();
        $rol->name = $request->input('name');
        $rol->sections = implode(',', $request->input('perms', []));;
        $rol->save();

        return redirect()->route('roles')->with('success', 'Rol creado con exito');
    }

    public function destroy($id)
    {
        $rol = Rol::find($id);
        $rol->delete();
        return redirect()->route('roles')->with('success', 'Rol eliminado con exito');
    }

}
