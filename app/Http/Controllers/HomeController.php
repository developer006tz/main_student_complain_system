<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ComplainType;
use App\Models\Complaint;
use App\Models\Student;
use App\Models\Resolve;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get loged in user

        $role = Auth::user()->getRoleNames()[0];
        $user = Auth::user();
         $student = Student::where('user_id', $user->id)->first();
        //get complaints of loged in student
        if ($role == 'student' && $student) {
            $complaints = Complaint::where('student_id', $user->student->id)->get();
            return view('home', compact('user', 'role', 'student', 'complaints'));
        }elseif($user->hasRole('lecturer')){
            if(!empty($user->lecture)){
              
                $complaints = $user->lecture->complaints;

                if(count($complaints) < 1 && $user->hasRole('department-head')){
                    //check in resolve table if there is complaints with resolve status of 3 and if they are having his lecture_id
                    $check_resolved = Resolve::where('lecture_id', $user->lecture->id)->where('resolve_status', 3)->get();
          
                    //then for each check_resolved item use check_resolved complaint_id to find complaints with id as of complaint_id in check resolved

                    if(count($check_resolved) > 0){
                        foreach($check_resolved as $check){
                            $complaints = Complaint::where('id', $check->complaint_id)->get();
                        }

                    }

                    $total_department_complaints = Complaint::where('department_id', $user->lecture->department->id)->get();

                    return view('home', compact('user', 'role', 'student', 'complaints', 'total_department_complaints'));


                }
            }else{
                $complaints = array();
            }
            
            return view('home', compact('user','complaints','role'));

        }
        else{
            return view('home', compact('user', 'role','student'));
        }
        
        
    }
}
