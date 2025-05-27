<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\DoctorScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Admin\HealthReminderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HealthAssessmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;



// Home
Route::get('/', function () {
    $articles = \App\Models\Article::latest()->paginate(10);
    return view('dashboard', compact('articles'));
})->name('home');

// Routes for Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Chat Routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.messages');

    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/health-assessments', [AdminController::class, 'healthAssessments'])
            ->name('admin.health-assessments.index');
            
        // Health Reminder Routes
        Route::resource('admin/health-reminder', HealthReminderController::class, [
            'names' => [
                'index' => 'admin.health-reminder.index',
                'create' => 'admin.health-reminder.create',
                'store' => 'admin.health-reminder.store',
                'edit' => 'admin.health-reminder.edit',
                'update' => 'admin.health-reminder.update',
                'destroy' => 'admin.health-reminder.destroy'
            ]
        ]);

        // Article Routes
        Route::resource('admin/articles', ArticleController::class)->names([
            'index' => 'admin.articles.index',
            'create' => 'admin.articles.create',
            'store' => 'admin.articles.store',
            'edit' => 'admin.articles.edit',
            'update' => 'admin.articles.update',
            'destroy' => 'admin.articles.destroy',
            'show' => 'admin.articles.show'
        ]);
    });

    // Patient (User) Routes
    Route::middleware('role:user')->group(function () {
        Route::get('/pasien/dashboard', function () {
            return view('pasien.dashboard');
        })->name('pasien.dashboard');

        Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/history', [AppointmentController::class, 'history'])->name('appointments.history');
    });

    // Doctor Routes
    Route::middleware('role:doctor')->group(function () {
        Route::get('/doctor/dashboard', function () {
            return view('doctor.dashboard');
        })->name('doctor.dashboard');

        Route::get('/doctor/schedule', [DoctorScheduleController::class, 'index'])->name('doctor.schedule');
        Route::get('/doctor/schedule/create', [DoctorScheduleController::class, 'create'])->name('doctor.schedule.create');
        Route::post('/doctor/schedule', [DoctorScheduleController::class, 'store'])->name('doctor.schedule.store');
        Route::delete('/doctor/schedule/{schedule}', [DoctorScheduleController::class, 'destroy'])->name('doctor.schedule.destroy');
        
        // Tambahkan route untuk riwayat janji temu dokter
        Route::get('/doctor/appointments/history', [AppointmentController::class, 'doctorHistory'])->name('doctor.appointments.history');
    });

    // Common Appointment Routes (semua user yang login)
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::post('/health-assessment/calculate', [HealthAssessmentController::class, 'calculate'])->name('health-assessment.calculate');
    Route::get('/health-assessments', [HealthAssessmentController::class, 'index'])->name('health-assessments.index');
    Route::patch('/appointments/{appointment}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
}); // Closing bracket for middleware auth group

// Routes untuk admin
// Hapus atau pindahkan route artikel yang duplikat ini
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('admin/articles', Admin\ArticleController::class)->names('admin.articles');
// });

// Perbaiki route untuk menampilkan artikel di frontend
Route::get('/', function () {
    try {
        $articles = \App\Models\Article::latest()->paginate(6);
        return view('dashboard', compact('articles'));
    } catch (\Exception $e) {
        $articles = collect([]);
        return view('dashboard', compact('articles'));
    }
})->name('home');

Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// Forum Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{post}/comment', [ForumController::class, 'storeComment'])->name('forum.comment.store');
    Route::delete('/forum/comment/{comment}', [ForumController::class, 'destroyComment'])->name('forum.comment.destroy');
});

// Hapus duplikasi route berikut karena sudah ada di dalam middleware auth group
Route::post('/forum/{post}/comment', [ForumController::class, 'storeComment'])->name('forum.comment.store');
Route::delete('/forum/comment/{comment}', [ForumController::class, 'destroyComment'])->name('forum.comment.destroy');

// Doctor Profile Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/profile/edit', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('doctor.profile.edit');
    Route::put('/doctor/profile/update', [App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('doctor.profile.update');
});