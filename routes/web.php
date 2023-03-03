<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("admin")->prefix("admin")->group(function () {

    Route::resources(['produit' => ProduitController::class]);
    Route::resources(['categorie' => CategorieController::class]);

});

Route::get('/', function () {
    return view('dashboard');
    })->middleware(['admin'])
      ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware("admin")->prefix("admin")->group(function () {

    Route::resource("user", UserController::class);            

});

Route::get("/choose-pass-user/{encryption_id}/edit?email={email}", [UserController::class, "edit"])
    ->prefix("admin")
    ->name("reset-password-user-ext");

Route::get("/send-mail", [ContactController::class, "index"]);

require __DIR__ . '/auth.php';
