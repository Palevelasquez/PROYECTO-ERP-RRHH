<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas web para la aplicación. Estas
| rutas son cargadas por RouteServiceProvider dentro de un grupo que
| contiene el grupo de middleware "web". ¡Ahora crea algo genial!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Rutas de documentos
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/documents/import', [DocumentController::class, 'import'])->name('documents.import');
Route::get('/documents/export/{empleado}', [DocumentController::class, 'export'])->name('documents.export');
Route::post('/documents/export-to-sheets', [DocumentController::class, 'exportToSheets'])->name('documents.exportToSheets');
Route::post('/documents/download', [DocumentController::class, 'download'])->name('documents.download.submit');
Route::get('/documents/download', [DocumentController::class, 'showDownloadForm'])->name('documents.download');

Auth::routes();

// Rutas de empleados
Route::group(['middleware' => 'auth'], function () {
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
    Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update'); // Nota aquí
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
    Route::get('/empleados/export/{empleado}', [DocumentController::class, 'exportToSheets'])->name('empleados.export');
});

// Ruta para la página de inicio
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
