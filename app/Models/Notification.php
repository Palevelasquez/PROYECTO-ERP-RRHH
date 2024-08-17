<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Especifica la tabla si no sigue el nombre por defecto
    protected $table = 'notifications'; // Cambia 'notifications' al nombre correcto de tu tabla

    // Especifica las columnas que se pueden llenar de manera masiva
    protected $fillable = ['user_id', 'message', 'is_read'];
}
