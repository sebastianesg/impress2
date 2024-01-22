<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $breadcrumbs = [['name' => "Administradores"]];
        return view('cms.admin.adminList', ['breadcrumbs' => $breadcrumbs, 'admins' => User::all()]);
    }

    public function create()
    {
        $breadcrumbs = [['link' => route('admins'), 'name' => "Administradores"], ['name' => "Crear Administrador"]];
        return view('cms.admin.adminForm', ['breadcrumbs' => $breadcrumbs, 'admin' => new User(), 'action' => route('admins.store'), 'method' => 'create', "roles" => Rol::all()]);
    }

    public function show($id)
    {
        //
    }

    public function edit(User $admin)
    {
        $breadcrumbs = [['link' => route('admins'), 'name' => "Administradores"], ['name' => "Editar Administrador"]];
        return view('cms.admin.adminForm', ['breadcrumbs' => $breadcrumbs, 'admin' => $admin, 'action' => route('admins.update', $admin), 'method' => 'edit', "roles" => Rol::all()]);
    }

    public function store(Request $request)
    {
        $validated = AdminController::validateForm($request, 0);
        if ($validated){
            $admin = new User($request->all());
            $admin->password = Hash::make($admin->password);
            $admin->save();

            ////UPDATE PHOTO PROFILE
            if (request()->hasFile('profile_photo_path')) $admin->updateProfilePhoto(request()->file('profile_photo_path'));
        }
        return redirect()->route('admins')->with(['saved' => true]);
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        $validated = AdminController::validateForm($request, $id);
        if ($validated && $admin){
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->rol_id = $request->input('rol_id', 0);
            $admin->save();

            ////UPDATE PHOTO PROFILE
            if (request()->hasFile('profile_photo_path')) $admin->updateProfilePhoto(request()->file('profile_photo_path'));

            ////UPDATE PASSWORD
            $pass = $request->input('password');
            if (!empty($pass)){
                $admin->password = Hash::make($pass);
                $admin->save();
            }
        }
        return redirect()->route('admins')->with(['saved' => true]);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with(['deleted' => true]);
    }

    private static function validateForm(Request $request, $id){
        return $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => $id === 0 ? 'required' : ''
        ]);
    }
}
