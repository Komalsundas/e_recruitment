<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\CreatePost;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PanelController;

 
Route::get('/counter', Counter::class);
Route::get('/create-post', CreatePost::class);


Route::get('/', function () {
    return view('welcome');
});

//panel routes
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/panel/dashboard', [PanelController::class, 'dashboard'])->name('panel.dashboard');
//     Route::get('/panel/shortlisted', [PanelController::class, 'shortlistedCandidates'])->name('panel.shortlisted');
//     Route::get('/panel/settings', [PanelController::class, 'settings'])->name('panel.settings');
// });

// Route::get('/add-panel', [PanelController::class, 'create'])->name('addPanel');

Route::post('/applicants/{id}/compare', [UserController::class, 'compareCriteriaWithQualifications'])->name('applicants.compare');

// Route::post('/add-panel', [AdminController::class, 'addPanel'])->name('addPanel');
Route::post('/add-panel', [PanelController::class, 'addPanel'])->name('addPanel');


// Route::post('/add_panel', [AdminController::class, 'addPanel'])->name('add_panel');


// Route::post('/panel/login', [PanelController::class,'login'])->name('panel.login');


Route::get('/form/{id}', [UserController::class, 'viewForm'])->name('form');

    
Route::get('/shortlisted-candidate/{id?}', [AdminController::class, 'shortlisted'])->name('shortlisted-candidate');
Route::get('/viewshortlisted/{id}', [AdminController::class, 'viewshortlisted'])->name('viewshortlisted');

Route::post('/shortlist/{id}', [AdminController::class, 'shortlist'])->name('shortlist');
Route::get('/result/{id?}', [AdminController::class, 'result'])->name('result');

Route::post('/select/{id}', [AdminController::class,'select'])->name('select');

Route::post('/standby/{id}', [AdminController::class, 'standby'])->name('standby');
Route::get('/updateresult/{id}', [AdminController::class, 'updateresult'])->name('updateresult');

Route::post('/checkcid', [UserController::class, 'checkcid'])->name('checkcid');




// routes/web.php



// Route::post('/complete-assessment', [AdminController::class, 'completeAssessment'])->name('complete-assessment');
// Route::get('/viewresult', [AdminController::class, 'viewresult'])->name('viewresult');

Route::get('/viewresult/{id}', [AdminController::class, 'viewresult'])->name('viewresult');
Route::post('/complete-assessment', [AdminController::class, 'completeAssessment'])->name('complete-assessment');



// Route::post('/save-remarks', [AdminController::class, 'saveRemarks'])->name('save-remarks');

// Route::post('/save-remarks/{id}/', [AdminController::class, 'saveRemarks'])->name('save-remarks');
Route::post('/save-remarks/{id}', [AdminController::class, 'saveRemarks'])->name('save-remarks');







Route::post('/add-remark/{id}', [AdminController::class, 'addRemark'])->name('add.remark');


Route::get('/passwordChange', [AdminController::class, 'change_pwd'])->name('change_pwd');
Route::post('/savePassword', [AdminController::class, 'save_pwd'])->name('save_password');

Route::get('/export-to-excel', [AdminController::class, 'exportToExcel'])->name('exportToExcel');





Route::get('vacancy', [AdminController::class, 'showVacancyUser'])->name('vacancy');

Route::get('/novacancy', function () {
    return view('novacancy'); // Replace 'vacancy' with the actual name of your Blade view
})->name('novacancy'); // Give the route a name (optional but recommended)


    Route::post('/store', [UserController::class, 'store'])->name('store');//to store canididate data



    Route::middleware(['auth', 'verified'])->group(function(){
 
    Route::get('/createVacancy', [AdminController::class, 'createVacancy'])->name('create-vacancy');
    Route::post('/saveVacancy', [AdminController::class, 'saveVacancy'])->name('save-vacancy');
    Route::get('/listVacancy', [AdminController::class, 'showVacancy'])->name('show-vacancy');
 
    Route::get('/listVacancy/{id}', [AdminController::class, 'viewVacancy'])->name('view-vacancy');
    Route::get('/showcanidate/{id}', [AdminController::class, 'showcanidate'])->name('showcanidate');
    Route::get('/viewCandidate/{id}', [AdminController::class, 'viewCandidate'])->name('view-candidate');



// routes/web.php

Route::get('/report', [AdminController::class, 'showReport'])->name('report');
Route::post('/report', [AdminController::class, 'generateReport'])->name('generateReport');


    Route::post('/update-vacancy/{id}', [AdminController::class, 'update'])->name('update-vacancy');

 

});


Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/delete-vacancy/{id}', [AdminController::class, 'deleteVacancy'])->name('delete-vacancy');
//  Route::delete('/delete-vacancy/{id}', [AdminController::class,'deleteVacancy')->name('delete-vacancy');

Route::get('/vacancy-list', [AdminController::class, 'showVacancy'])->name('vacancy-list');



require __DIR__.'/auth.php';
