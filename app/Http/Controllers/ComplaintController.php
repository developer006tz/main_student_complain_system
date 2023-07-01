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

class ComplaintController extends NotificationController
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
        //caprure lecture id in order to send email and normal sms
        $lecture_id = $complaint->lecture_id;
        if(!empty($lecture_id)){
            $lecture = Lecture::findOrfail($lecture_id);
            $lecture_email = $lecture->user->email;
            $lecture_phone = $lecture->user->phone;
            $lecture_name = $lecture->user->name;
            $student_name = $complaint->student->user->name;
            $student_email = $complaint->student->user->email;
            $student_phone = $complaint->student->user->phone;
            $complaint_type = $complaint->complainType->name;
            $complaint_description = $complaint->description;
            $complaint_date = $complaint->created_at;

            //send email to lecture
       
            $message = 'Dear '.$lecture_name.', you have received a new complaint from '.$student_name.' on '.$complaint_date.'. Please login to the system to view the complaint.';
            $message_for_student = 'Dear '.$student_name.', your complaint has been created and will be attended to as soon as possible. Thank you for using our system.';
            $save_student_sms = $this->save_message($message_for_student, $complaint->student->user->id,null, $student_phone, 1, 0);
           
            $save_lecture_sms = $this->save_message($message, $complaint->lecture->user->id, null, $lecture_phone, 1, 0);

             try {
                
                sendEmail($lecture_email, $lecture_name, 'NEW COMPLAINT RECEIVED', $save_lecture_sms->body);
                beem_sms(validatePhoneNumber($lecture_phone), $save_lecture_sms->body);

                sendEmail($student_email, $student_name, 'COMPLAINT CREATED SUCCESSFULL', $save_student_sms->body);
                beem_sms(validatePhoneNumber($student_phone), $save_student_sms->body);
                // Update $save_lecture_sms send_status to 1
                $save_lecture_sms->send_status = 1;
                $save_lecture_sms->save();

                // Update $save_student_sms status to 1

                $save_student_sms->send_status = 1;
                $save_student_sms->save();

             } catch (\Throwable $th) {
                error_log($th->getMessage());
             }
        }
        

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

    public function update_status(
        Request $request,
        Complaint $complaint
    ): RedirectResponse {
        $this->authorize('update', $complaint);

        $validated = $request->validate([
            'status' => 'required',
        ]);

        $complaint->update($validated);

        //send email to lecture and student
        $student_message = 'Dear '.$complaint->student->user->name.', your complaint has been accepted by lecturer '.$complaint->lecture->user->name.'. and now is in processing stage.';
        $student_message_email = 'Your complaint has been accepted by lecturer ' . $complaint->lecture->user->name . '. and now is in processing stage.';

        $lecture_message = 'Dear '.$complaint->lecture->user->name.', you have accepted a complaint from '.$complaint->student->user->name.'. and now You can continue solving that complaint, if it is beyond your level you can transfer it to the head of department.';
        $lecture_message_email = 'You have accepted a complaint from ' . $complaint->student->user->name . '. and now You can continue solving that complaint, if it is beyond your level you can transfer it to the head of department.';
        $save_student_sms = $this->save_message($student_message, $complaint->student->user->id,null, $complaint->student->user->phone, 1, 0);
        $save_lecture_sms = $this->save_message($lecture_message, $complaint->lecture->user->id, null, $complaint->lecture->user->phone, 1, 0);

        try {
            sendEmail($complaint->student->user->email, $complaint->student->user->name, 'COMPLAINT ACCEPTED', $student_message_email);
            beem_sms(validatePhoneNumber($complaint->student->user->phone), $save_student_sms->body);

            sendEmail($complaint->lecture->user->email, $complaint->lecture->user->name, 'COMPLAINT ACCEPTED', $lecture_message_email);
            beem_sms(validatePhoneNumber($complaint->lecture->user->phone), $save_lecture_sms->body);
           
            $save_lecture_sms->send_status = 1;
            $save_lecture_sms->save();

            $save_student_sms->send_status = 1;
            $save_student_sms->save();

        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }
        return redirect()
            ->route('complaints.show', $complaint)
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
