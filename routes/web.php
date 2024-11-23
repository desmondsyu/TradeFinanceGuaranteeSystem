<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuaranteeController;

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

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Resource routes for guarantees
Route::middleware(['auth'])->group(function () {
    Route::get('guarantees/index', [GuaranteeController::class, 'index'])->name('guarantees.index');
    Route::get('guarantees/create', [GuaranteeController::class, 'create'])->name('guarantees.create');
    Route::post('guarantees/store', [GuaranteeController::class, 'store'])->name('guarantees.store');
    Route::post('guarantees/{id}/review', [GuaranteeController::class, 'review'])->name('guarantees.review');
    Route::post('guarantees/{id}/apply', [GuaranteeController::class, 'apply'])->name('guarantees.apply');
    Route::post('guarantees/{id}/issue', [GuaranteeController::class, 'issue'])->name('guarantees.issue');
    Route::delete('guarantees/{id}', [GuaranteeController::class, 'destroy'])->name('guarantees.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';
