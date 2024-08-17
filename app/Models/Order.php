<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Definir la tabla asociada al modelo si es diferente de 'orders'
    protected $table = 'orders'; 

    // Definir los campos que se pueden asignar en masa
    protected $fillable = ['amount', 'description', 'date'];
}