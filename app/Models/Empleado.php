<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    // Definir la tabla que usará el modelo, si no es la pluralización por defecto
    protected $table = 'empleados'; 

    // Definir los campos que son asignables en masa
    protected $fillable = [
        'Nombre',
        'ApellidoPaterno',
        'ApellidoMaterno',
        'Correo',
        'Foto',
        'cargo', // Asegúrate de incluir todos los campos necesarios
    ];

    // Definir los campos que no deberían ser rellenables
    protected $guarded = [];
     // Define la relación con el modelo Document
     public function documents()
     {
         return $this->hasMany(Document::class, 'empleado_id');
     }
}
