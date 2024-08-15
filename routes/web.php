<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\SliderController;
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
Route::get('/documents/{empleado_id}/list', [DocumentController::class, 'getDocumentsByEmployee'])->name('documents.getDocumentsByEmployee');
Route::get('/empleados/search', [EmpleadoController::class, 'search'])->name('empleados.search');
Route::get('/documents/{empleado_id}/search', [DocumentController::class, 'search'])->name('documents.search');
Route::get('/documents/empleados/search', [EmpleadoController::class, 'search'])->name('empleados.search');
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
    Route::get('/documents/{empleado_id}/list', [DocumentController::class, 'getDocumentsByEmployee'])->name('documents.getDocumentsByEmployee');
    Route::get('/empleados/search', [EmpleadoController::class, 'search']);
    Route::resource('empleados', EmpleadoController::class);
});

Route::get("/",[HomeController::class, 'index'])->name('index');

Route::group(['prefix'=> 'admin'],function(){
    Route::get('Panel-Administrativo', [IndexController::class, 'index'])->name('dashboard');
    Route::resource('slide', SliderController::class)->parameters(['sliders' => 'slider'])->names('admin.slider');
    });

    
Route::group(['middleware' => 'auth'], function () {
    // Otras rutas...
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix'=> 'admin'],function(){
    Route::get('Panel-Administrativo', [IndexController::class, 'index'])->name('home');

});

Auth::routes();
