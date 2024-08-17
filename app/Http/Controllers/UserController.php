<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all(); // Si usas Spatie, esto obtendrá todos los roles
        return view('users.index', compact('users', 'roles'));
    }

    public function __construct()
    {
        $this->middleware('can:manage-users');
    }
    
    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles disponibles
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'username' => 'required|unique:users',
        'password' => 'required|min:8',
        'role' => 'required|string'
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->password = bcrypt($request->password); // Encriptar la contraseña
    $user->save();

    $user->assignRole($validated['role']);

    return redirect()->back()->with('success', 'Usuario creado con éxito');
}


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Obtener todos los roles disponibles
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
{
    $user = User::find($id);

    $user->update([
        'name' => $request->name,
        'username' => $request->username
    ]);

    if($request->has('password')) {
        $user->update(['password' => bcrypt($request->password)]);
    }

    $user->syncRoles($request->role);

    return redirect()->route('users.index');
}



public function destroy($id)
{
    User::find($id)->delete();
    return redirect()->route('users.index');
}
}
