<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/* ------------------ Admin Route ----------------- */
Route::prefix('admin')->group(function(){
    Route::get('/login',[AdminController::class, 'Index'])->name('admin_login');
    Route::post('/login/owner',[AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class, 'Dashboard'])
    ->name('admin.dashboard')->middleware('admin');

    Route::post('/logout',[AdminController::class, 'Logout'])
    ->name('admin.logout')->middleware('admin');

    Route::get('/register',[AdminController::class, 'Register'])->name('admin_register');
    Route::post('/register/create',[AdminController::class, 'Registeration'])->name('admin.register');

    
    


    
});

/* ------------------ End Admin Route ----------------- */

/* ------------------ Seller Route ----------------- */
Route::prefix('seller')->group(function(){
    Route::get('/login',[SellerController::class, 'Index'])->name('seller_login');
    Route::post('/login/owner',[SellerController::class, 'Login'])->name('seller.login');
    Route::get('/dashboard',[SellerController::class, 'Dashboard'])
    ->name('seller.dashboard')->middleware('seller');

    Route::post('/logout',[SellerController::class, 'Logout'])
    ->name('seller.logout')->middleware('seller');

    Route::get('/register',[SellerController::class, 'Register'])->name('seller_register');
    Route::post('/register/create',[SellerController::class, 'Registeration'])->name('seller.register');



    
});

/* ------------------ End Seller Route ----------------- */


Route::group(['middleware' => 'prevent-back-history'],function(){
	Route::get('/home', 'HomeController@index');
});