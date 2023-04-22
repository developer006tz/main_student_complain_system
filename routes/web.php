<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\NtaLevelController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ComplainTypeController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\DepartmentHeadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('complain-types', ComplainTypeController::class);
        Route::resource('complaints', ComplaintController::class);
        Route::resource('students', StudentController::class);
        Route::resource('lectures', LectureController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('department-heads', DepartmentHeadController::class);
        Route::resource('programs', ProgramController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('semesters', SemesterController::class);
        Route::resource('enrollments', EnrollmentController::class);
        Route::resource('nta-levels', NtaLevelController::class);
        Route::resource('academic-years', AcademicYearController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('users', UserController::class);
        Route::resource('messages', MessageController::class);
    });
