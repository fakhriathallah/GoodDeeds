<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MsDeedsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [MsDeedsController::class,'guestDashboard'])->name('home.index');



Route::prefix('owner')->group(function(){
    Route::get('/dashboard', [MsDeedsController::class, 'ownerDashboard'])->name('ownerDashboardShow');

});

Route::prefix('taker')->group(function(){
    Route::get('/dashboard', [MsDeedsController::class, 'takerDashboard'])->name('takerDashboardShow');
    Route::get('/deeddetail/{deed}', [MsDeedsController::class,'TakerDeedDetail'])->name('deedDetailTaker');
    Route::post('/take-deed/{id}', [MsDeedsController::class, 'takeDeed'])->name('deed.take');
    Route::get('/mydeeds', [MsDeedsController::class,'takerOnProgressDeeds'])->name('takerDeeds');
    Route::put('/done-deed/{id}', [MsDeedsController::class,'doneDeed'])->name('doneDeed');
    Route::get('/done', [MsDeedsController::class,'takerDoneDeeds'])->name('takerDoneDeeds');
});


require __DIR__.'/auth.php';

Route::get('/deeddetail/{deed}', [MsDeedsController::class,'deedDetail'])->name('deed.detail');
Route::get('/mydeeds', [MsDeedsController::class,'myDeeds'])->name('mydeed.index');
Route::get('/adddeeds', [MsDeedsController::class,'addDeed'])->name('adddeed.index'); // owner
Route::post('/adddeeds', [MsDeedsController::class, 'storeDeed'])->name('adddeed.store'); // owner
Route::post('/take-deed/{id}', [MsDeedsController::class, 'takeDeed'])->name('deed.take');
Route::get('/activity', [MsDeedsController::class, 'activity'])->name('activity.index');
Route::post('/cancel-deed/{id}', [MsDeedsController::class, 'cancelDeed'])->name('deed.cancel');
Route::post('/complete-deed/{id}', [MsDeedsController::class, 'completeDeed'])->name('deed.complete');
Route::delete('/deeds/{deed}', [MsDeedsController::class, 'deleteDeed'])->name('deed.delete'); // owner

//Route buat upload sana hapus foto
Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete.photo');
