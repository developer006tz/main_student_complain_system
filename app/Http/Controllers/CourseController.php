<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Program;
use App\Models\Semester;
use App\Models\NtaLevel;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Course::class);

        $search = $request->get('search', '');

        $courses = Course::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.courses.index', compact('courses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Course::class);

        $semesters = Semester::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $ntaLevels = NtaLevel::pluck('name', 'id');
        $programs = Program::pluck('name', 'id');

        return view(
            'app.courses.create',
            compact('semesters', 'departments', 'ntaLevels', 'programs')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Course::class);

        $validated = $request->validated();

        $course = Course::create($validated);

        return redirect()
            ->route('courses.edit', $course)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Course $course): View
    {
        $this->authorize('view', $course);

        return view('app.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Course $course): View
    {
        $this->authorize('update', $course);

        $semesters = Semester::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $ntaLevels = NtaLevel::pluck('name', 'id');
        $programs = Program::pluck('name', 'id');

        return view(
            'app.courses.edit',
            compact(
                'course',
                'semesters',
                'departments',
                'ntaLevels',
                'programs'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CourseUpdateRequest $request,
        Course $course
    ): RedirectResponse {
        $this->authorize('update', $course);

        $validated = $request->validated();

        $course->update($validated);

        return redirect()
            ->route('courses.edit', $course)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Course $course): RedirectResponse
    {
        $this->authorize('delete', $course);

        $course->delete();

        return redirect()
            ->route('courses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
