<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ComplainType;
use App\Models\Complaint;
use App\Models\Student;


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
