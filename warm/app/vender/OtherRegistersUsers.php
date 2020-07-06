<?php

namespace App\vender;

use App\Event;
use App\Inst;
use App\Inst_user;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Auth\Events\Registered;

trait OtherRegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInstUserRegistrationForm()
    {
        return view('insts.auth.register');
    }

    public function showStudentRegistrationForm()
    {
        return view('students.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function instUserRegister(Request $request, Inst_user $inst_user)
    {
        $this->instUserValidator($request->all())->validate();

        event(new Registered($user = $this->instUserCreate($request->all())));

        $id = $user->id;
        $this->instUserTableValidator($request->all())->validate();
        $this->instUserTableCreate($id, $request->all(), $inst_user);

        $this->guard()->login($user);

        return $this->instUserRegistered($user)
                        ?: redirect($this->redirectPath());
    }

    public function studentRegister(Request $request, Student $student)
    {
        $this->studentValidator($request->all())->validate();

        event(new Registered($user = $this->studentCreate($request->all())));

        $id = $user->id;
        $this->studentTableValidator($request->all())->validate();
        $this->studentTableCreate($id, $request->all(), $student);

        $this->guard()->login($user);

        return $this->studentRegistered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function otherGuard()
    {
        return Auth::otherGuard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function instUserRegistered($user)
    {
        //
        $user = auth()->user();
        $id = $user->id;
        $inst = Inst::join('inst_users', 'insts.id', '=', 'inst_users.inst_id')
            ->where('inst_users.id', $id)
            ->select('insts.inst_name', 'insts.id')
            ->first();
        $inst_id = $inst->id;
        $events = Event::where('insts_id', $inst_id)->get();

        return view('insts.list', ['events'=>$events, 'inst'=>$inst]);
    }

    protected function studentRegistered(Request $request, $user)
    {
        //
        return view('students.index',compact('nations','levels','events'));
    }
}
