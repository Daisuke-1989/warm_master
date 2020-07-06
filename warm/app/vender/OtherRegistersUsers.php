<?php

namespace App\vender;

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
    public function instUserRegister(Request $request)
    {
        $this->instUserValidator($request->all())->validate();

        event(new Registered($user = $this->instUserCreate($request->all())));

        $this->guard()->login($user);

        return $this->instUserRegistered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function studentRegister(Request $request)
    {
        $this->studentValidator($request->all())->validate();

        event(new Registered($user = $this->studentCreate($request->all())));

        $id = $user->id;
        $this->studentTableValidator($id, $request->all())->validate();
        $this->studentTableCreate($id, $request->all());

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
    protected function instUserRegistered(Request $request, $user)
    {
        //
    }

    protected function studentRegistered(Request $request, $user)
    {
        //
    }
}
