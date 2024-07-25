<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth

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

/*
Route::get('/empleado', function () {
    return view('empleado.index');
});

Route::get('empleado/create',[EmpleadoController::class,'create'] );
*/
// routes/web.php
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);


Route::get('/chart', [ChartController::class, 'index'])->name('chart.index');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/documents/import', [DocumentController::class, 'import'])->name('documents.import');
Route::get('/documents/export/{empleado}', [DocumentController::class, 'export'])->name('documents.export');
Route::post('/documents/export-to-sheets', [DocumentController::class, 'exportToSheets'])->name('documents.exportToSheets');
// Ruta para manejar la solicitud de descarga de documentos (POST)
Route::post('/documents/download', [DocumentController::class, 'download'])->name('documents.download.submit');
// Ruta para mostrar el formulario de descarga de documentos (GET)
Route::get('/documents/download', [DocumentController::class, 'showDownloadForm'])->name('documents.download');
Auth::routes();


Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleado.index');
Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleado.create');
Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleado.store');
Route::get('/empleados/export/{empleado}', [DocumentController::class, 'exportToSheets'])->name('empleados.export');


Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});
