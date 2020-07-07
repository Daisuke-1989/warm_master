<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\Event;
use App\Inst;
use App\Level;
use App\Subject;
use App\Nation;
use App\Book;
use App\Query;
use App\Term;
use App\E_l_map;
use App\E_sbj_map;
use App\E_r_map;
use Validator;

class InstsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        // $inst = Inst::join('events', 'insts.id', '=', 'events.insts_id')
        // ->where('events.insts_id', $id)
        // ->first();
        // $events = Event::where('insts_id', $id)->get();

        // return view('insts.list', ['events'=>$events, 'inst'=>$inst]);

        $user = auth()->user();
        $id = $user->id;
        // $id = Auth::user()->id->get();
        // $inst_user = User::find($id)->get();

        //instテーブルのidと大学ユーザーテーブルの大学idと合致するレコードを探して、$instに代入する。
        $inst = Inst::join('inst_users', 'insts.id', '=', 'inst_users.inst_id')
            ->where('inst_users.id', $id)
            ->select('insts.inst_name', 'insts.id')
            ->first();
        $inst_id = $inst->id;
        $events = Event::where('insts_id', $inst_id)->get();


        // $inst = Inst::join('events', 'insts.id', '=', 'events.insts_id')
        // ->where('events.insts_id', $id)
        // ->first();
        // $events = Event::where('insts_id', $id)->get();

        return view('insts.list', ['events'=>$events, 'inst'=>$inst]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //イベント作成時に、大学と大学ユーザーのIDをstoreに渡す
        // $user = auth()->user();
        // $id = $user->id;

        $user = Auth::user();

        $inst = Inst::join('inst_users', 'insts.id', '=', 'inst_users.inst_id')
            ->where('inst_users.id', $user->id)
            ->select('insts.id')
            ->first();
        // $inst_id = Inst_user::where('id', $id)->get('inst_id');
        // // $inst_id = $inst_user['inst_id'];
        // $inst = Inst::where('id', $inst_id)->get();

        //level: フォームのセレクトボックスのvalue
        $levels = Level::all();

        //subject: フォームのセレクトボックスのvalue
        $subjects = Subject::all();

        //region: フォームのセレクトボックスのvalue
        // distinctを使う
        $regions = Nation::all();

        return view('insts.create', ['user'=>$user, 'inst'=> $inst, 'levels'=>$levels, 'subjects'=>$subjects, 'regions'=>$regions]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request){

        // バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'detail' => 'required',
            'upfile' => 'required',
            'lvls' => 'required',
            'sbjs' => 'required',
            'rgns' => 'required',
            'inst_id' => 'required',
            'user_id' => 'required'
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/insts/create')
                ->withInput()
                ->withErrors($validator);
        }

        // $file = $request->file('upfile');
        $file = $request->file('upfile')->store('public/img/'); //storage>app>publicに入る
        
        // ファイルが空かチェック
        if(empty($file)){
            // ファイル名を取得
            $move = $file->store('public/img/'); //public/upload....
            $filename = ltrim($move, 'public/img/');

        }else{
            $filename = "";
        }
          

        //イベント情報を登録
        $event = new Event();

        $event->title = request('title');
        $event->insts_id = request('inst_id');
        $date1 = request('date');
        $date2 = strtotime($date1);
        $date3 = date('Y-m-d', $date2);
        $event->date = $date3;
        $starttime1 = request('starttime');
        $starttime2 = strtotime('$starttime1');
        $starttime3 = date('H:i:s', $starttime2);
        $event->start_time = $starttime3;
        $endtime1 = request('endtime');
        $endtime2 = strtotime('$endtime1');
        $endtime3 = date('H:i:s', $endtime2);
        $event->end_time = $endtime3;
        $event->dtls = request('detail');
        $event->capacity = 1;
        $event->img = $file;
        $event->inst_users_id = request('user_id');

        $event->save();

        // 上記で作成されたイベントのidを取得
        $event_id = $event->id;

        //複数のレベル情報とイベントIDを、中間テーブルにループで登録
        foreach($request->lvls as $lvl){
            $level = new E_l_map();
            $level->levels_id = $lvl;
            $level->events_id = $event_id;

            $level->save();
        }

        //複数の科目情報とイベントIDを中間テーブルにループで登録
        foreach($request->sbjs as $sbj){
            $subject = new E_sbj_map();
            $subject->subjects_id = $sbj;
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

        return redirect('/insts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $events = Event::find($id);
        // $events_id = $id;

        // イベントの対象となるレベルの抽出
        $levels = Level::select('levels.level')
            ->join('e_l_maps', 'levels.id', '=', 'e_l_maps.levels_id')
            ->join('events', 'e_l_maps.events_id', '=', 'events.id')
            ->where('events.id', $id)
            ->get();

        // $levels = E_l_map::where('events_id', $events_id)->get();

        // イベントの対象となる科目の抽出
        $subjects = Subject::select('subjects.subject')
            ->join('e_sbj_maps', 'subjects.id', '=', 'e_sbj_maps.subjects_id')
            ->join('events', 'e_sbj_maps.events_id', '=', 'events.id')
            ->where('events.id', $id)
            ->get();

        // $subjects = E_sbj_map::where('events_id', $events_id)->get();

        // イベントの対象となる地域の抽出
        $regions = Nation::select('nations.region')
            ->join('e_r_maps', 'nations.rgn_id', '=', 'e_r_maps.regions_id')
            ->join('events', 'e_r_maps.events_id', '=', 'events.id')
            ->where('events.id', $id)
            ->get();
        // $regions = E_r_map::where('events_id', $events_id)->get();

        // イベントの参加者数
        // $regs = Book::select(DB::raw('count(*) as reg_num'))
        //     ->where('events_id', $id)
        //     ->where('CXL', '=', 0)
        //     ->first();

        $regs = Book::where('events_id', $id)
            ->where('CXL', '=', 0)
            ->count();


        // イベントの参加者リスト
        $ppts = Book::join('students', 'books.students_id', '=', 'students.id')
            ->join('users', 'students.id', '=', 'users.id')
            ->join('nations', 'students.nations_id', '=', 'nations.id')
            ->join('s_l_maps', 's_l_maps.students_id', '=', 'books.students_id')
            ->join('levels', 's_l_maps.levels_id', '=', 'levels.id')
            ->where('books.events_id', $id)
            ->where('books.CXL', '=', 0)
            ->get();

        // 質問数
        $qry_num = Query::where('events_id', $id)
            ->count();

            //質問数sql
            // $sql = "SELECT COUNT(*) as qry_num
            // FROM e_qry WHERE e_qry_e_id = :id";

        //、質問タイプと内容
        $qrys = Term::join('queries', 'terms.id', '=', 'queries.terms_id')
            ->where('queries.events_id', $id)
            ->orderBy('terms.id')
            ->select('terms.term', 'queries.dtls')
            ->get();

            //質問タイプと内容sql
            // $sql = "SELECT e_qry_typ,e_qry_cnt
            // FROM e_qry_typ
            // JOIN e_qry ON e_qry_typ.ee_qry_typ_id = e_qry.e_qry_typ_id
            // WHERE e_qry.e_qry_e_id = :id
            // ORDER BY ee_qry_typ_id";

        return view('insts.detail', ['events'=>$events, 'levels'=>$levels, 'subjects'=>$subjects, 'regions'=>$regions, 'regs'=>$regs, 'qry_num'=>$qry_num, 'qrys'=>$qrys, 'ppts'=>$ppts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

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
        //
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
}
