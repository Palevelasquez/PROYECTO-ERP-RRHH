<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class ChartController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();

        $data = [
            'labels' => $empleados->pluck('Nombre')->toArray(),
            'datasets' => [
                [
                    'label' => 'Correos por empleado',
                    'data' => $empleados->pluck('Correo')->map(function($correo) {
                        return strlen($correo); // Ejemplo de dato, longitud del correo
                    })->toArray(),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];

        return view('chart.index', compact('data'));
    }
}
