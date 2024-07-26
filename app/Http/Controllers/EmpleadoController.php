<?php

namespace App\Http\Controllers;

use App\Models\Empleado; // Asegúrate de que el modelo esté correctamente importado
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all(); // Recupera todos los empleados
        return view('Empleado.index', compact('empleados')); // Muestra la vista
    }

    public function create()
    {
        return view('Empleado.create'); // Muestra el formulario para agregar un nuevo empleado
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Nombre' => 'required|string|max:255',
        'ApellidoPaterno' => 'required|string|max:255',
        'ApellidoMaterno' => 'nullable|string|max:255',
        'Correo' => 'required|email|max:255',
        'cargo' => 'required|string|max:255', // Validar el campo cargo
        'Foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $empleado = new Empleado();
        $empleado->Nombre = $request->Nombre;
        $empleado->ApellidoPaterno = $request->ApellidoPaterno;
        $empleado->ApellidoMaterno = $request->ApellidoMaterno;
        $empleado->Correo = $request->Correo;
        $empleado->cargo = $request->cargo; // Asignar el valor del campo cargo
        

        // Subir la foto si se proporciona
        if ($request->hasFile('Foto')) {
            $foto = $request->file('Foto')->store('public/fotos');
            $empleado->Foto = basename($foto);
        }

        $empleado->save(); // Guardar el nuevo empleado en la base de datos

        return redirect()->route('empleado.index')->with('success', 'Empleado agregado correctamente');
      }

    public function edit($id)
    {
        $empleado = Empleado::find($id);
        return view('empleados.edit', compact('empleado'));
    
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'Nombre' => 'required|string|max:255',
        'ApellidoPaterno' => 'required|string|max:255',
        'ApellidoMaterno' => 'nullable|string|max:255',
        'Correo' => 'required|email|max:255',
        'Cargo' => 'required|string|max:255', // Validar el campo cargo
    ]);

    $empleado = Empleado::find($id);

    if (!$empleado) {
        return redirect()->route('empleados.index')->with('error', 'Empleado no encontrado.');
    }

    $empleado->Nombre = $request->input('Nombre');
    $empleado->ApellidoPaterno = $request->input('ApellidoPaterno');
    $empleado->ApellidoMaterno = $request->input('ApellidoMaterno');
    $empleado->Correo = $request->input('Correo');
    $empleado->Cargo = $request->input('Cargo');

    $empleado->save(); // Guardar los cambios

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
}

    
    public function destroy($id)
{
    $empleado = Empleado::findOrFail($id);
    $empleado->delete();

    return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
}

}
