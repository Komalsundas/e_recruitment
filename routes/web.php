<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\CreatePost;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

 
Route::get('/counter', Counter::class);
Route::get('/create-post', CreatePost::class);
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

Route::get('/form/{id}', [UserController::class, 'viewForm'])->name('form');

// Route::get('/form', function () {
//     return view('form'); // Replace 'form' with the actual name of your Blade view
// })->name('form'); // Give the route a name (optional but recommended)


// Route::get('/vacancy', function () {
//     return view('vacancy'); // Replace 'vacancy' with the actual name of your Blade view
// })->name('vacancy'); // Give the route a name (optional but recommended)

// Route::get('/vacancyy',  [Controller::class, 'vacancyy'])->name('vacancyy');
// Route::get('/listVacancy', [AdminController::class, 'showVacancy'])->name('show-vacancy');


Route::get('vacancy', [AdminController::class, 'showVacancyUser'])->name('vacancy');

Route::get('/novacancy', function () {
    return view('novacancy'); // Replace 'vacancy' with the actual name of your Blade view
})->name('novacancy'); // Give the route a name (optional but recommended)

// Route::get('/userprofile', [AdminController::class, 'userprofile'])->name('userprofile');
// Route::get('/userprofile', function () {
//     return view('userprofile'); // Replace 'vacancy' with the actual name of your Blade view
// })->name('userprofile'); // Give the route a name (optional but recommended)


Route::post('/store', [UserController::class, 'store'])->name('store');//to store canididate data

// Route::get('/userprofile2', function () {
//     return view('userprofile2'); // Replace 'vacancy' with the actual name of your Blade view
// })->name('userprofile2'); // Give the route a name (optional but recommended)

Route::middleware(['auth', 'verified'])->group(function(){
 
    Route::get('/createVacancy', [AdminController::class, 'createVacancy'])->name('create-vacancy');
    Route::post('/saveVacancy', [AdminController::class, 'saveVacancy'])->name('save-vacancy');
    Route::get('/listVacancy', [AdminController::class, 'showVacancy'])->name('show-vacancy');
 
    Route::get('/listVacancy/{id}', [AdminController::class, 'viewVacancy'])->name('view-vacancy');
    Route::get('/showcanidate/{id}', [AdminController::class, 'showcanidate'])->name('showcanidate');
    Route::get('/viewCandidate/{id}', [AdminController::class, 'viewCandidate'])->name('view-candidate');

    

    




});

// Route::get('/candidate', function () {
//     return view('candidate');
// })->name('candidate');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/delete-vacancy/{id}', [AdminController::class, 'deleteVacancy'])->name('delete-vacancy');
// Route::delete('/delete-vacancy/{id}', 'AdminController@deleteVacancy')->name('delete-vacancy');

Route::get('/vacancy-list', [AdminController::class, 'showVacancy'])->name('vacancy-list');



require __DIR__.'/auth.php';