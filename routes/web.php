<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkdayController;
use App\Http\Controllers\Admin\WorkdayController as AdminWorkdayController;
use App\Http\Controllers\Admin\FestivalController as AdminFestivalController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function(){
    Route::get('workdays', [WorkdayController::class,'index'])->name('workdays.index');
    Route::post('workdays/{workday}/signup', [WorkdayController::class,'signup'])->name('workdays.signup');
    Route::delete('workdays/{workday}/cancel', [WorkdayController::class,'cancel'])->name('workdays.cancel');
});

Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('festival', [AdminFestivalController::class, 'edit'])->name('festival.edit');
    Route::put('festival', [AdminFestivalController::class, 'update'])->name('festival.update');
    Route::get('workdays', [AdminWorkdayController::class, 'index'])->name('workdays.index');
    Route::post('workdays/{workday}/signup', [AdminWorkdayController::class, 'signup'])->name('workdays.signup');
    Route::delete('workdays/{workday}/cancel', [AdminWorkdayController::class, 'cancel'])->name('workdays.cancel');
});

require __DIR__.'/auth.php';
