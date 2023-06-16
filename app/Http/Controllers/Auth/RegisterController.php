<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\NotificationController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Message;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\MailableScs;
use App\Mail\ContactMail;

class RegisterController extends NotificationController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:8','unique:users'],
            'role' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        // $roles = Role::where('name', 'user')->first()->id;
        // $role = array($roles);
        // $user->assignRole($role);
        $role = $data['role'];
        if($role==1){
            $role = 'Student';
            $user->assignRole(Role::findByName('student'));
        }elseif($role==2){
            $role = 'Lecturer';
            $user->assignRole(Role::findByName('lecturer'));
        }else{
            $role = 'User';
            $user->assignRole(Role::findByName('user'));
        }

        //send phone message and email to user 

        $message = new Message();
        $message->body = "Hellow $user->name, You are registered as $role in NIT Student Complaint System. Please Fill remained information to complete your profile.";
        $message->user_id = $user->id;
        $message->phone = $user->phone;
        $message->type = 1;
        $message->send_status = 0;
        $message->save();

        beem_sms(validatePhoneNumber($user->phone), $message->body);
        sendEmail($user->email,$user->naame,'COMPLETE YOUR PROFILE', $message->body);
        
        return $user;
    }
}
