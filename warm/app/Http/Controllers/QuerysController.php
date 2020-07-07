<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Inst;
use App\Inst_user;
use App\Level;
use App\Subject;
use App\Student;
use App\Nation;
use App\Event;
use App\E_l_map;
use App\E_r_map;
use App\E_sbj_map;
use App\Book;
use App\Query;
use App\Term;

class QuerysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request)
    {
            $querys = new  Query;
            $querys->events_id = $request->input('e_id');
            $querys->terms_id = $request->input('category');
            $querys->students_id = $request->input('s_id');
            $querys->sdtls = $request->input('qry');
            $querys->seve();
            return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
}

public function info($id)
{
    $user = auth()->user();
    $terms = Term::all();

    $events = Event::join('insts','events.insts_id','=','insts.id')
                    ->join('e_r_maps','events.id','=','e_r_maps.events_id')
                    ->join('nations','e_r_maps.regions_id', '=', 'nations.rgn_id')
                    ->join('e_l_maps','events.id','=','e_l_maps.events_id')
                    ->join('levels','e_l_maps.levels_id','=','levels.id')
                    ->join('e_sbj_maps','events.id','=','e_sbj_maps.events_id')
                    ->join('subjects','e_sbj_maps.subjects_id','=','subjects.id')
                    ->where('events.id','=',$id)
                    ->select('events.id as event_id','insts.inst_name')
                    ->first();


    return view('students.query',[
                            'event'=>$events,
                            'user'=>$user,
                            'terms'=>$terms
                            ]);
        
}
public function set(Request $request)
{
    
    $querys = new  Query;
    $querys->events_id      = $request->input('events_id');
    $querys->terms_id       = $request->input('terms_id');
    $querys->students_id    = $request->input('students_id');
    $querys->dtls          = $request->input('qry');
    $querys->save();
    return redirect('/students');

}

}