<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Inst_user;
use App\Student;
use App\vender\OtherRegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
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
    use OtherRegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function instUserValidator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function studentValidator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'type' => 1,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'life' => 1,
            'remember_token' => '1234567890abcdefg',
        ]);
    }

    protected function instUserCreate(array $data)
    {
        return User::create([
            'type' => 2,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'life' => 1,
            'remember_token' => '1234567890abcdefg',
        ]);
    }

    protected function studentCreate(array $data)
    {
        return User::create([
            'type' => 3,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'life' => 1,
            'remember_token' => '1234567890abcdefg',
        ]);
    }

    protected function instUserTableValidator(array $data)
    {
        return Validator::make($data, [
            'inst_id' => ['required', 'integer'],
            'j_title' => ['required', 'string'],
            'dept' => ['required', 'string'],
        ]);
    }

    protected function studentTableValidator(array $data)
    {
        return Validator::make($data, [
            'nations_id' => ['required', 'integer'],
            'year' => ['required', 'string'],
        ]);
    }

    protected function instUserTableCreate(Int $id, array $data, Inst_user $inst_user)
    {
        $inst_user = new Inst_user();
        $inst_user->fill(['id'=>$id,'inst_id'=>$data['inst_id'],'j_title'=>$data['j_title'],'dept'=>$data['dept']]);
        $inst_user->save();
        return;
    }

    protected function studentTableCreate(Int $id, array $data, Student $student)
    {
        $student = new Student();
        $student->fill(['id'=>$id,'nations_id'=>$data['nations_id'],'year'=>$data['year']]);
        $student->save();
        return;
    }
}
