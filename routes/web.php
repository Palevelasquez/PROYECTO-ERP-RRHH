<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\DashboardStatistics;
use App\Http\Controllers\DepartmentController;
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

// Ruta por defecto, redirige al login si no está autenticado
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Auth::routes();

// Ruta para el Home/Dashboard
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');


// Rutas de documentos (Autenticación requerida)
Route::middleware('auth')->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('/documents/import', [DocumentController::class, 'import'])->name('documents.import');
    Route::get('/documents/export/{empleado}', [DocumentController::class, 'export'])->name('documents.export');
    Route::post('/documents/download', [DocumentController::class, 'download'])->name('documents.download.submit');
    Route::get('/documents/download', [DocumentController::class, 'showDownloadForm'])->name('documents.download');
    Route::get('/documents/{empleado_id}/list', [DocumentController::class, 'getDocumentsByEmployee'])->name('documents.getDocumentsByEmployee');
    Route::get('/documents/{empleado_id}/search', [DocumentController::class, 'search'])->name('documents.search');
});

// Rutas de empleados (Autenticación requerida)
Route::middleware('auth')->group(function () {
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

// Rutas del módulo de usuarios (Autenticación + Middleware de administrador requerido)
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::resource('users', UserController::class);
});
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');



Route::get('/admin/profile', function () {
    // Aquí podrías devolver una vista si es necesario
    return view('admin.profile');
})->name('admin.profile.index');

Route::get('/admin/users', function () {
    return view('admin.users.index');
})->name('admin.users.index');

Route::get('/admin/notifications', function () {
    return view('admin.notifications.index');
})->name('admin.notifications.index');

Route::get('/admin/sales', function () {
    return view('admin.sales.index');
})->name('admin.sales.index');
Route::get('/admin/statistics', DashboardStatistics::class)->name('admin.statistics');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('departments', 'DepartmentController')->only(['index']);
});
Route::resource('departments', DepartmentController::class);

// Rutas del Panel Administrativo (Autenticación requerida)
Route::middleware('auth')->group(function () {
    Route::group(['prefix'=> 'admin'], function() {
        Route::get('Panel-Administrativo', [IndexController::class, 'index'])->name('dashboard');
        Route::resource('slide', SliderController::class)->parameters(['sliders' => 'slider'])->names('admin.slider');
    });
});