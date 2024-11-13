<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkDayController;
use App\Http\Controllers\ClassController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/add-credits', [AdminController::class, 'showAddCreditsForm'])->name('admin.show-add-credits-form');
    Route::get('/admin/add-credits/socio/{id}', [AdminController::class, 'showAddCreditsSocioForm'])->name('admin.show-add-credits-socio-form');
    Route::post('/admin/add-credits', [AdminController::class, 'addCredits'])->name('admin.add-credits');
    Route::get('socios', [AdminController::class, 'listSocios'])->name('list-socios');
    Route::delete('/admin/delete-socio/{id}', [AdminController::class, 'deleteSocio'])->name('admin.delete-socio');
    //Profes
    Route::get('profes', [AdminController::class, 'listProfes'])->name('list-profes');
    Route::get('admin/add-profes', [AdminController::class, 'addProfes'])->name('add-profes');
    Route::post('/admin/add-new-profe', [AdminController::class, 'addNewProfe'])->name('add-profe');
    Route::get('/admin/edit-profes/{id}', [AdminController::class, 'editProfes'])->name('view-edit-profes');
    Route::put('/admin/profesores/{id}', [AdminController::class, 'updateProfe'])->name('update-profesor');
    //Clases
    Route::get('/clases', [AdminController::class, 'listClases'])->name('admin.list-clases');
    Route::get('/clases/socios/{id}',[AdminController::class, 'sociosEnClase'])->name('admin.socios-en-clase');
    Route::post('/class/{class}/add-member/{member}', [ClassController::class, 'addMember'])->name('class.addMember');

    //Route::get('/admin/add-clases', [AdminController::class, 'addClases'])->name('add-clases');
    Route::get('/admin/clases/add', [AdminController::class, 'addClases'])->name('admin.add-clases');
    Route::post('/admin/clases/store', [AdminController::class, 'storeClase'])->name('admin.store-clase');

    //Rutas para work_days
    Route::resource('work_days', WorkDayController::class);
    //Generación de Clases mensuales
    Route::get('/admin/generate-classes', [AdminController::class, 'generateClassesList'])->name('admin.generate-classes');
    Route::post('/admin/generate-classes', [AdminController::class, 'generateClasses'])->name('admin.generate-classes');




});

/* Route::middleware(['auth', 'can:admin-only'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('work_days', WorkDayController::class);
});
 */

require __DIR__.'/auth.php';
