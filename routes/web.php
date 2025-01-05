<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MybookController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Session\Middleware\AuthenticateSession;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');//bu Dashboar controllerdagi kodlarni o'qshish uchun
    
Route::get('/mybook', [MybookController::class, 'mybookindex'])->middleware(['auth', 'verified'])->name('mybook'); //Mening kitoblarim bo'limi 

Route::post('/rate', [RateController::class, 'rate'])->name('rate'); //baholash funksiyasi

Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); //kitobni ochirib tashlash funksiyasi

Route::post('savebook', [BookController::class, 'store'])->name('storebook');  //kitob rasmni sqalash funksiyasi


Route::get('/users', [UserController::class, 'index'])->name('users.index'); //Foydalanuvchini boshqarish sahifasi

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Foydalanuvchini o'chirish funksiyasi


Route::post('/users/{id}/block', [UserController::class, 'blockUser'])->name('users.block');

Route::post('/users/{id}/unblock', [UserController::class, 'unblockUser'])->name('users.unblock');


Route::get('/addbook', function () {
    return view('addbook');
})->middleware(['auth', 'verified'])->name('addbook'); //kitob qoshish bo'limi


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
