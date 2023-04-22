<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Semester;
use Illuminate\View\View;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Enrollment::class);

        $search = $request->get('search', '');

        $enrollments = Enrollment::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.enrollments.index', compact('enrollments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Enrollment::class);

        $students = Student::pluck('date_of_birth', 'id');
        $courses = Course::pluck('name', 'id');
        $semesters = Semester::pluck('name', 'id');
        $academicYears = AcademicYear::pluck('name', 'id');

        return view(
            'app.enrollments.create',
            compact('students', 'courses', 'semesters', 'academicYears')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnrollmentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Enrollment::class);

        $validated = $request->validated();

        $enrollment = Enrollment::create($validated);

        return redirect()
            ->route('enrollments.edit', $enrollment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Enrollment $enrollment): View
    {
        $this->authorize('view', $enrollment);

        return view('app.enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Enrollment $enrollment): View
    {
        $this->authorize('update', $enrollment);

        $students = Student::pluck('date_of_birth', 'id');
        $courses = Course::pluck('name', 'id');
        $semesters = Semester::pluck('name', 'id');
        $academicYears = AcademicYear::pluck('name', 'id');

        return view(
            'app.enrollments.edit',
            compact(
                'enrollment',
                'students',
                'courses',
                'semesters',
                'academicYears'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EnrollmentUpdateRequest $request,
        Enrollment $enrollment
    ): RedirectResponse {
        $this->authorize('update', $enrollment);

        $validated = $request->validated();

        $enrollment->update($validated);

        return redirect()
            ->route('enrollments.edit', $enrollment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Enrollment $enrollment
    ): RedirectResponse {
        $this->authorize('delete', $enrollment);

        $enrollment->delete();

        return redirect()
            ->route('enrollments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
