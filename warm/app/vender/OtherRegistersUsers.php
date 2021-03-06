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
        // $id = Auth::user()->id->get();
        // $inst_user = User::find($id)->get();

        //instテーブルのidと大学ユーザーテーブルの大学idと合致するレコードを探して、$instに代入する。
        $inst = Inst::join('inst_users', 'insts.id', '=', 'inst_users.inst_id')
            ->where('inst_users.id', $id)
            ->select('insts.id', 'insts.inst_name')
            ->first();

        // view'dashboard'で、{{ $inst_user->firstname }}で大学ユーザーの名前を,{{ $inst->inst_name }}で大学名を呼び出し
        return view('insts.index', ['user'=>$user, 'inst'=>$inst]);
    }

    protected function studentRegistered(Request $request, $user)
    {
        //
        $user = auth()->user();
            $id = $user->id;
            $nations     =   Nation::all();
            $levels     =    Level::all();

            $events      =   Event::join('insts','events.insts_id','=','insts.id')
                            ->join('e_r_maps','events.id','=','e_r_maps.events_id')
                            ->join('nations','e_r_maps.regions_id', '=', 'nations.rgn_id')
                            ->join('e_l_maps','events.id','=','e_l_maps.events_id')
                            ->join('levels','e_l_maps.levels_id','=','levels.id')
                            ->select('insts.inst_name', 'nations.region', 'events.title', 'events.date', 'events.id', 'events.img', 'levels.level' )
                            ->get();

            return view('students.index',[
                        'user'      =>$user,
                        'events'     =>$events,
                        'nations'    =>$nations,
                        'levels'    =>$levels
                        ]);
    }
}
