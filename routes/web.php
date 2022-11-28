<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('productlist', [WebsiteController::class, 'productlist']);
Route::get('productDetails/{id}', [WebsiteController::class, 'productDetails']);
// Route::post('singleCharge', [WebsiteController::class, 'singleCharge'])->name('singleCharge');
Route::post('single-charge', [WebsiteController::class, 'singleCharge'])->name('single.charge');
//Route::post('products/{id}/purchase', [WebsiteController::class, 'purchase'])->name('products.purchase');
//Route::post('products/{id}/purchase', [WebsiteController::class, 'purchase'])->name('products.purchase');
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cache</h1>';
});
//Clear Config clear:
Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});