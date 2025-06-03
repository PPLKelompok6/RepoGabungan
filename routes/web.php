<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes with role-based middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');
    
    // Chat routes for admin/doctor
    Route::get('/admin/chat', [ChatController::class, 'index'])->name('admin.chat.index');
    Route::post('/admin/chat/send', [ChatController::class, 'sendMessage'])->name('admin.chat.send');
    Route::get('/admin/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('admin.chat.messages');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
    
    // Chat routes for user/patient
    Route::get('/user/chat', [ChatController::class, 'index'])->name('user.chat.index');
    Route::post('/user/chat/send', [ChatController::class, 'sendMessage'])->name('user.chat.send');
    Route::get('/user/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('user.chat.messages');
});