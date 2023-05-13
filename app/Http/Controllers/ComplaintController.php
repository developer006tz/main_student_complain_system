<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Program;
use App\Models\Lecture;
use App\Models\Semester;
use App\Models\Complaint;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ComplainType;
use App\Models\AcademicYear;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\ComplaintUpdateRequest;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Complaint::class);

        $search = $request->get('search', '');
        //check if auth user is student then show only his/her complaints
        if (auth()->user()->hasRole('student')) {
            $student = Student::where('user_id', auth()->user()->id)->first();
            $complaints = Complaint::where('student_id', $student->id)->search($search)
                ->latest()
                ->paginate(500)
                ->withQueryString();
            return view('app.complaints.index', compact('complaints', 'search'));
        }else{
            $complaints = Complaint::search($search)
            ->latest()
            ->paginate(500)
            ->withQueryString();

        return view('app.complaints.index', compact('complaints', 'search'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Complaint::class);

        $complainTypes = ComplainType::pluck('name', 'id');

       

        if (auth()->user()->hasRole('student')) {
            $students = Student::where('user_id', auth()->user()->id)->join('users', 'users.id', '=', 'students.user_id')->pluck('users.name', 'students.id');
        } else {
            $students = Student::join('users', 'users.id', '=', 'students.user_id')->pluck('users.name', 'students.id');
        }
        $departments = Department::pluck('name', 'id');
        $programs = Program::pluck('name', 'id');
        $courses = Course::pluck('name', 'id');
        $lectures = Lecture::join('users', 'users.id', '=', 'lectures.user_id')->pluck('users.name', 'lectures.id');
        $semesters = Semester::pluck('name', 'id');
        $academicYears = AcademicYear::pluck('name', 'id');

        return view(
            'app.complaints.create',
            compact(
                'complainTypes',
                'students',
                'departments',
                'programs',
                'courses',
                'lectures',
                'semesters',
                'academicYears'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Complaint::class);

        $validated = $request->validated();

        $complaint = Complaint::create($validated);

        return redirect()
            ->route('complaints.index', $complaint)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Complaint $complaint): View
    {
        $this->authorize('view', $complaint);

        return view('app.complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Complaint $complaint): View
    {
        $this->authorize('update', $complaint);

        $complainTypes = ComplainType::pluck('name', 'id');
        $students = Student::join('users', 'users.id', '=', 'students.user_id')->pluck('users.name', 'students.id');
        $departments = Department::pluck('name', 'id');
        $programs = Program::pluck('name', 'id');
        $courses = Course::pluck('name', 'id');
        $lectures = Lecture::join('users', 'users.id', '=', 'lectures.user_id')->pluck('users.name', 'lectures.id');
        $semesters = Semester::pluck('name', 'id');
        $academicYears = AcademicYear::pluck('name', 'id');

        return view(
            'app.complaints.edit',
            compact(
                'complaint',
                'complainTypes',
                'students',
                'departments',
                'programs',
                'courses',
                'lectures',
                'semesters',
                'academicYears'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ComplaintUpdateRequest $request,
        Complaint $complaint
    ): RedirectResponse {
        $this->authorize('update', $complaint);

        $validated = $request->validated();

        $complaint->update($validated);

        return redirect()
            ->route('complaints.index', $complaint)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Complaint $complaint
    ): RedirectResponse {
        $this->authorize('delete', $complaint);

        $complaint->delete();

        return redirect()
            ->route('complaints.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
