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
use App\Mail\MailableScs;
use Illuminate\Support\Facades\Mail;

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

Route::get('/testroute', function () {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('developer.ludovic@gmail.com’')->send(new MailableScs($name));
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
        Route::get('create-gender-complaint', [ComplaintController::class, 'create_gender_complaint'])->name('gender-complaints.create');
        Route::post('store-gender-complaint', [ComplaintController::class, 'store_gender_complaint'])->name('gender-complaints.store');
        Route::get('gender-complaint', [ComplaintController::class, 'lis_gender_complaint'])->name('gender-complaints.list');

        Route::any('gender-complaint-resolve/{complaint}', [ComplaintController::class, 'gender_complaint_resolve'])->name('complaints.resolve');
        Route::any('gender-complaint-reject/{complaint}', [ComplaintController::class, 'gender_complaint_reject'])->name('complaints.reject');

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
        //inline route to update complaints
        Route::patch('complaints/{complaint}/update', [ComplaintController::class, 'update_status'])->name('complaint_status.update');
        Route::put('complaints/{complaint}/resolve', [ComplaintController::class, 'resolve_reject_or_transfer'])->name('complaint_status.resolve');
        //route sent_messages.show to show sent messages of auth user
        Route::get('sent_messages', [MessageController::class, 'sent_messages'])->name('sent_messages.show');
    });
