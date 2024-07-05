<?php

use Illuminate\Support\Facades\Route;
use App\Models\About;
use App\Models\Achievment;
use App\Models\Opening;

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
    $about = About::first();
    $opening = Opening::first();
    $achievment = Achievment::first();
    return view('frontend.index',[
        'about' => $about,
        'opening' => $opening,
        'achievment' => $achievment
    ]);
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'root'])->name('root');


//Update User Details
Route::post('/dashboard/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/dashboard/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('/dashboard/{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('/dashboard/index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

//Opening section
Route::get('/dashboard/opening/page', [App\Http\Controllers\OpeningController::class, 'index'])->name('indexOpening');
Route::post('/dashboard/opening/edit/', [App\Http\Controllers\OpeningController::class, 'edit'])->name('editOpening');

//About section
Route::get('/dashboard/about/page', [App\Http\Controllers\AboutController::class, 'index'])->name('indexAbout');
Route::post('/dashboard/about/edit/', [App\Http\Controllers\AboutController::class, 'edit'])->name('editAbout');

//Achievments section
Route::get('/dashboard/achievment/page', [App\Http\Controllers\AchievmentController::class, 'index'])->name('indexAchievment');
Route::post('/dashboard/achievment/edit/', [App\Http\Controllers\AchievmentController::class, 'edit'])->name('editAchievment');