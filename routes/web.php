<?php

use App\Http\Livewire\Courses\Read;
use App\Http\Livewire\StudentIndex;
use App\Http\Livewire\TeacherIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AdminIndex;
use App\Http\Livewire\Student\ViewGrades;
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

Route::middleware(['auth'])->group(function () {
    Route::middleware(['password.changed'])->group(function () {
        Route::group([
            'middleware' => ['role:super-admin|admin'],
            'as' => 'admin.',
            'prefix' => 'admin'
        ], function () {
            Route::get('home', AdminIndex::class)->name('index');
            Route::get('users', AdminIndex::class)->name('users');
            Route::get('add-users', AdminIndex::class)->name('add-user');
        });
        Route::group([
            'middleware' => ['role:teacher'],
            'as' => 'teacher.',
            'prefix' => 'teacher'
        ], function () {
            Route::get('teacher/home', TeacherIndex::class)->name('teacher.index');
            Route::get('teacher/courses', Read::class)->name('teacher.courses');
        });
        Route::group([
            'middleware' => ['role:student'],
            'as' => 'student.',
            'prefix' => 'student'
        ], function () {
            Route::get('student/home', StudentIndex::class)->name('student.index');
            Route::get('student/courses', Read::class)->name('student.courses');
            Route::get('student/grades', ViewGrades::class)->name('student.grades');
        });
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
