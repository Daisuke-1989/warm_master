<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Inst;
use App\Inst_user;
use App\Level;
use App\Subject;
use App\Nation;
use App\Event;
use App\E_l_map;
use App\E_r_map;
use App\E_sbj_map;
use App\Book;
use App\Query;


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
{       $user_id    =   Auth::user()->id->get();
        $student    =   Student::where('id', $user_id)->get();
        $nation     =   Nation::all();
        $event      =   Event::join('insts','events.insts_id','=','insts.id')
                        ->join('e_r_maps','events.id','=','e_r_maps.events_id')
                        ->join('nation','e_r_maps.regions_id','rgn_id')
                        ->join('e_l_maps','events.id','=','e_l_maps.events_id',)
                        ->join('levels','e_l_maps.levels_id','=','levels_id')
                        ->get();
        
        
        return view('students.index',[
                    'student'   =>$student,
                    'event'     =>$event,
                    'nation'    =>$nation
                    ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //イベント作成時に、大学と大学ユーザーのIDをstoreに渡す
        $inst_user = Auth::user()->id->get();
        $inst = Inst::where('id', $inst_user['inst_id']);

        //level: フォームのセレクトボックスのvalue
        $levels = Level::all();

        //subject: フォームのセレクトボックスのvalue
        $subjects = Subject::all();

        //region: フォームのセレクトボックスのvalue
        $regions = Nation::all();

        return view('events.create', ['inst_user'=>$inst_user, 'inst'=> $inst, 'levels'=>$levels, 'subjects'=>$subjects, 'regions'=>$regions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'inst_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'dtls' => 'required',
            'img' => 'required',
            'user_id' => 'required',
            'lvls' => 'required',
            'sbjs' => 'required',
            'rgns' => 'required'
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/events/ceate')
                ->withInput()
                ->withErrors($validator);
        }
        //イベント情報を登録

        $event = new Event();

        $event->title = request('title');
        $event->insts_id = request('inst_id');
        $event->date = request('date');
        $event->start_time = request('starttime');
        $event->end_time = request('endtime');
        $event->dtls = request('detail');
        $event->capacity = 1;
        $event->img = $filename;
        $event->inst_users_id = request('user_id');

        $event->save();

        // 上記で作成されたイベントのidを取得
        $event_id = $event['id'];

        //複数のレベル情報とイベントIDを、中間テーブルにループで登録
        foreach($request->lvls as $lvl){
            $level = new E_l_map();
            $level->level_id = $lvl;
            $level->events_id = $event_id;

            $level->save();
        }
        
        //複数の科目情報とイベントIDを中間テーブルにループで登録
        foreach($request->sbjs as $sbj){
            $subject = new E_sbj_map();
            $subject->sbjects_id = $sbj;
            $subject->events_id = $event_id;

            $subject->save();
        }

        //複数のリージョン情報とイベントIDを中間テーブルにループで登録
        foreach($request->rgns as $rgn){
            $region = new E_r_map();
            $region->regions_id = $rgn;
            $region->events_id = $event_id;

            $region->save();
        }

        return redirect('events/inst_user');
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
                        ->join('nation','e_r_maps.regions_id','rgn_id')
                        ->join('e_l_maps','events.id','=','e_l_maps.events_id',)
                        ->join('levels','e_l_maps.levels_id','=','levels.id')
                        ->join('e_sbj_maps','events_id','=','e_sbj_maps.events_id')
                        ->join('subjects','e_sbj_maps.subjects_id','=','subject.id')
                        ->where('id','=',$id)
                        ->get();
                        return view('detail', ['event' => $events]);
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
        $event = Event::where('id', $id);

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

    public function inst_index(Request $request){

        // // session値が取れている場合
        // $inst_id = $request->session()->get('inst_id');
        // $inst = Inst::where('id', $inst_id)->get();
        // $events = Event::where('insts_id', $inst_id)->get();

        // session値が取れていない場合
        $user_id = Auth::user()->id->get();
        $inst_id = Inst_user::where('id', $user_id)->get('inst_id');
        $inst = Inst::where('id', $inst_id)->get();
        $events = Event::where("insts_id", $inst_id)->get();

        return view('insts.list', ['events'=>$events, 'inst'=>$inst]);

    }

    public function inst_show($id){

        // // session値が取れている場合
        // $inst_id = $request->session()->get('inst_id');
        // $inst = Inst::where('id', $inst_id)->get();
        // $events = Event::where('insts_id', $inst_id)->get();

        // session値が取れていない場合
        // $user_id = Auth::user()->id->get();
        // $inst_id = Inst_user::where('id', $user_id)->get('inst_id');
        // $inst = Inst::where('id', $inst_id)->get();
        $events = Event::find($id)->get();
        // $events_id = $id;

        // イベントの対象となるレベルの抽出
        $levels = Level::select('levels.level')
            ->join('e_l_maps', 'levels.id', '=', 'e_l_maps.levels_id')
            ->join('events', 'e_l_maps.events_id', '=', 'events.id')
            ->where('events.id', '=', $id)
            ->get();
        // $levels = E_l_map::where('events_id', $events_id)->get();

        // イベントの対象となる科目の抽出
        $subjects = Subject::select('subjects.subject')
            ->join('e_sbj_maps', 'subjects.id', '=', 'e_sbj_maps.subjects_id')
            ->join('events', 'e_sbj_maps.events_id', '=', 'events.id')
            ->where('events.id', '=', $id)
            ->get();
        // $subjects = E_sbj_map::where('events_id', $events_id)->get();

        // イベントの対象となる地域の抽出
        $regions = Nation::select('nations.region')
            ->join('e_r_maps', 'nations.rgn_id', '=', 'e_r_maps.regions_id')
            ->join('events', 'e_r_maps.events_id', '=', 'events.id')
            ->where('events.id', '=', $id)
            ->get();
        // $regions = E_r_map::where('events_id', $events_id)->get();

        // イベントの参加者数
        $regs = Book::select(DB::raw('count(*) as reg_num'))
            ->where('events_id', '=', $id) 
            ->where('CXL', '=', 0)
            ->get();

        // イベントの参加者リスト
        $ppts = Book::join('students', 'books.students_id', '=', 'students.id')
            ->join('users', 'students.id', '=', 'users.id')
            ->join('nations', 'students.nations_id', '=', 'nations.id')
            ->join('s_l_maps', 's_l_maps.students_id', '=', 'books.students_id')
            ->join('levels', 's_l_maps.levels_id', '=', 'levels.id')
            ->where('books.events_id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->get();

        // 質問数、質問タイプと内容
        $qrys = Query::join('terms', 'querys.terms_id', '=', 'terms.id')
            ->where('querys.events_id', '=', $id)
            ->orderBy('terms.id', 'desc')
            ->select(DB::raw('count(*) as qry_num'), 'terms.term', 'querys.dtls')
            ->get();

        return view('insts.detail', ['events'=>$events, 'levels'=>$levels, 'subjects'=>$subjects, 'regions'=>$regions, 'regs'=>$regs, 'qrys'=>$qrys, 'ppts'=>$ppts]);

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
