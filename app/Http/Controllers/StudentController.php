<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Program;
use App\Models\Country;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Student::class);

        $search = $request->get('search', '');

        $students = Student::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.students.index', compact('students', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Student::class);

        $users = User::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $programs = Program::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        return view(
            'app.students.create',
            compact('users', 'departments', 'programs', 'countries')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Student::class);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $student = Student::create($validated);

        return redirect()
            ->route('students.edit', $student)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Student $student): View
    {
        $this->authorize('view', $student);

        return view('app.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Student $student): View
    {
        $this->authorize('update', $student);

        $users = User::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $programs = Program::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');

        return view(
            'app.students.edit',
            compact('student', 'users', 'departments', 'programs', 'countries')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StudentUpdateRequest $request,
        Student $student
    ): RedirectResponse {
        $this->authorize('update', $student);

        $validated = $request->validated();
        if ($request->hasFile('photo')) {
            if ($student->photo) {
                Storage::delete($student->photo);
            }

            $validated['photo'] = $request->file('photo')->store('public');
        }

        $student->update($validated);

        return redirect()
            ->route('students.edit', $student)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Student $student
    ): RedirectResponse {
        $this->authorize('delete', $student);

        if ($student->photo) {
            Storage::delete($student->photo);
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
