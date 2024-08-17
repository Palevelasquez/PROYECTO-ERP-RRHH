<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Definir la tabla asociada al modelo si es diferente de 'sales'
    protected $table = 'sales'; 

    // Definir los campos que se pueden asignar en masa
    protected $fillable = ['amount', 'description', 'date'];
}