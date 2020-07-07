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
use Validator;


class EventsController extends Controller
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

    public function index()
{       
        $user = auth()->user();
        $id = $user->id;
        // $user_id    =   Auth::user()->id->get();
        // $student    =   Student::where('id', $id)->get();
        // $student    =   Student::find($id);
        $nations     =   Nation::all();
        $levels     =    Level::all();

        $events      =   Event::join('insts','events.insts_id','=','insts.id')
                        // ->join('nations', 'insts.nations_id', '=', 'nations.id')
                        ->join('e_r_maps','events.id','=','e_r_maps.events_id')
                        ->join('nations','e_r_maps.regions_id', '=', 'nations.rgn_id')
                        ->join('e_l_maps','events.id','=','e_l_maps.events_id')
                        ->join('levels','e_l_maps.levels_id','=','levels.id')
                        ->select('insts.inst_name', 'nations.region', 'events.title', 'events.date', 'events.id', 'events.img', 'levels.level' )
                        ->get();
        
        return view('students.index',[
                    'user'      =>$user,
                    // 'student'   =>$student,
                    'events'     =>$events,
                    'nations'    =>$nations,
                    'levels'    =>$levels
                    ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $event  =Event::join('insts','events.insts_id','=','insts.id')
                        ->join('e_r_maps','events.id','=','e_r_maps.events_id')
                        ->join('nations','e_r_maps.regions_id','rgn_id')
                        ->join('e_l_maps','events.id','=','e_l_maps.events_id')
                        ->join('levels','e_l_maps.levels_id','=','levels.id')
                        ->join('e_sbj_maps','events_id','=','e_sbj_maps.events_id')
                        ->join('subjects','e_sbj_maps.subjects_id','=','subject.id')
                        ->where('events.id','=',$id)
                        ->get();
                        return view('students.detail', ['event' => $events]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //イベント情報を取得
        $event = Event::find($id);

        return view('insts.event_edit', ['event'=>$event]);
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
        //編集内容をupdate
        $file = $request->file('img');
        // ファイルが空かチェック
        if(!empty($file)){
            // ファイル名を取得
            $filename = $file->getClientOriginalName();
            $move = $file->store('../upload/'.$filename); //public/upload....
            
        }else{
            $filename = "";
        }

        // バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'dtls' => 'required',
            'img' => 'required',
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/events/{{ $event->id }}/edit')
                ->withInput()
                ->withErrors($validator);
        }
        //イベント情報を登録

        // 直し必要
        $event = new Event();

        $event->dtls = request('detail');
        $event->img = $filename;

        $event->save();

        return redirect('/events/{{ $event->id }}/edit');
    }

    public function inst_index($id){

        // // session値が取れている場合
        // $inst_id = $request->session()->get('inst_id');
        // $inst = Inst::where('id', $inst_id)->get();
        // $events = Event::where('insts_id', $inst_id)->get();

        // session値が取れていない場合
        // $user_id = Auth::user()->id->get();
        // $inst_id = Inst_user::where('id', $user_id)->get('inst_id');
        // $inst = Inst::where('id', $inst_id)->get();

        // $user = Auth::user();
        
        // $inst = Inst::join('events', 'insts.id', '=', 'events.insts_id')
        //     ->where('events.insts_id', $id)
        //     ->first();
        // $events = Event::where('id', $id)->get();

        // return view('insts.list', ['events'=>$events, 'inst'=>$inst]);

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
