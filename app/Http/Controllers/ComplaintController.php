<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Student;
use App\Models\Program;
use App\Models\Lecture;
use App\Models\Semester;
use App\Models\Complaint;
use App\Models\Resolve;
use DB;
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
            if (auth()->user()->hasRole('department-head')) {
                $complaints = Complaint::where('department_id', auth()->user()->lecture->department_id)->search($search)
                    ->latest()
                    ->paginate(500)
                    ->withQueryString();
                return view('app.complaints.index', compact('complaints', 'search'));
            } elseif (auth()->user()->hasRole('lecturer')) {
                $lecture = Lecture::where('user_id', auth()->user()->id)->first();
                $complaints = Complaint::where('lecture_id', $lecture->id)->search($search)
                    ->latest()
                    ->paginate(500)
                    ->withQueryString();
                return view('app.complaints.index', compact('complaints', 'search'));
                
            }elseif(auth()->user()->hasRole('super-admin')){
                $complaints = Complaint::search($search)
                ->latest()
                ->paginate(500)
                ->withQueryString();
                return view('app.complaints.index', compact('complaints', 'search'));
            }else{
                $complaints = [];
                return view('app.complaints.index', compact('complaints', 'search'));
            }
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

    public function resolve_reject_or_transfer( Request $request, Complaint $complaint ): RedirectResponse
    {
        //validate requests
        $validated = $request->validate([
            'complaint_id' => 'required',
            'lecture_id' => 'required',
            'user_id' => 'required',
            'resolve_status' => 'required',
            'remark' => 'nullable',
        ]);

        //check if resolve status is transfer (3) then check a lecture with role department head in the department of the lecture who his lecture_id is in the complaint then if exists assign it to the complaint
        if($validated['resolve_status'] == 3){
            $complaint->update(['status' => $validated['resolve_status']]);

            $department_head = User::select('users.name as name', 'users.email', 'users.phone', 'departments.name as department', 'departments.id as dept_id', 'users.id as user_id','lectures.id as lecture_id')
                ->whereHas('roles', function ($q) {
                $q->where('name', 'department-head');
                })
                ->join('lectures', 'users.id', '=', 'lectures.user_id')
                ->where('lectures.department_id', $complaint->lecture->department_id)
                ->join('departments', 'departments.id', '=', 'lectures.department_id')
                ->first();


            if($department_head){
                $validated['lecture_id'] = $department_head->lecture_id;
                Resolve::create(array_merge($validated, ['date' => now()]));
                //send email to  student and department head
                $student_message = 'Dear '.$complaint->student->user->name.', your complaint has been transfered to department head of '.$department_head->department.' department  for futher check-up.';
                $student_message_email = 'Your complaint has been transfered to department head of '.$department_head->department.' department for futher check-up.';

                $department_head_message = 'Dear '.$department_head->name.', you have received a complaint claims from Lecturer '.$complaint->lecture->user->name.'. and now You can continue solving that complaint because it is beyond his/her level.';
                $department_head_message_email = 'You have received a complaint claims from Lecturer ' . $complaint->lecture->user->name . '. and now You can continue solving that complaint because it is beyond his/her level.';

                $save_student_sms = $this->save_message($student_message, $complaint->student->user->id,null, $complaint->student->user->phone, 1, 0);
                $save_department_head_sms = $this->save_message($department_head_message, $department_head->user_id, null, $department_head->phone, 1, 0);

                try {
                    sendEmail($complaint->student->user->email, $complaint->student->user->name, 'COMPLAINT TRANSFERED', $student_message_email);
                    beem_sms(validatePhoneNumber($complaint->student->user->phone), $save_student_sms->body);

                    sendEmail($department_head->email, $department_head->name, 'COMPLAINT TRANSFERED', $department_head_message_email);
                    beem_sms(validatePhoneNumber($department_head->phone), $save_department_head_sms->body);
                   
                    $save_department_head_sms->send_status = 1;
                    $save_department_head_sms->save();

                    $save_student_sms->send_status = 1;
                    $save_student_sms->save();

                } catch (\Throwable $th) {
                    error_log($th->getMessage());
                }

                return to_route('complaints.show', $complaint)
                    ->withSuccess(__('Complaint transfered successfully'));

            }else{
                return back()->withError('There is no department head in this department');
            }
        }else{
            $complaint->update(['status' => $validated['resolve_status']]);
            Resolve::create(array_merge($validated, ['date' => now()]));
            return to_route('complaints.show', $complaint)
                ->withSuccess(__('Complaint resolved successfully'));
        }
        


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
