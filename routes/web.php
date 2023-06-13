<?php

use App\Models\Type;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/admin/types', function () {
    $types = Type::all();
    return view('admin.types.index', compact('types'));
})->name('admin.types.index');

Route::get('/admin/technologies', 'App\Http\Controllers\TechnologyController@index')->name('admin.technologies.index');




Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // responds to url /admin
    // Occhio Importa il controller 🧠
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // admin.dashboard
    Route::resource('/projects', ProjectController::class)->parameters(['projects'=>'project:slug']);
   
}); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
