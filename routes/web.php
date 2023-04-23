<?php

use App\Http\Livewire\Courses\Read;
use App\Http\Livewire\StudentIndex;
use App\Http\Livewire\TeacherIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AdminIndex;
use App\Http\Livewire\Teacher\EnrolledStudents;

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
    return redirect()->route('login');
})->name('welcome');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('admin/home', AdminIndex::class)->name('admin.index');
        Route::get('admin/users', AdminIndex::class)->name('admin.users');
        Route::get('admin/add-users', AdminIndex::class)->name('admin.add-user');
    });
    Route::group(['middleware' => ['role:teacher']], function () {
        Route::get('teacher/home', TeacherIndex::class)->name('teacher.index');
        Route::get('teacher/courses', Read::class)->name('teacher.courses');
    });
    Route::group(['middleware' => ['role:student']], function () {
        Route::get('student/home', StudentIndex::class)->name('student.index');
        Route::get('student/courses', Read::class)->name('student.courses');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
