<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use App\User;
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
use Validator;

class SubjectsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 当該イベントに予約した学生の統計
        
        // イベント情報の取得
        $events = Event::find($id);


        // 学生の出身国
        $cntrys = Nation::join('students', 'nations.id', '=', 'students.nations_id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->where('books.events_id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('nations.country')
            ->orderBy('nations.country')
            ->select('nations.country', DB::raw('count(nations.country) as total'))
            ->get();
            // ->pluck('country')->toArray();
            // dd($cntrys);
            // SQL文
            // $sql = "SELECT stu_cntry.stucntry, COUNT(stucntry) as total
            // FROM stu_cntry
            // JOIN stuser ON stu_cntry.stucntry_id = stuser.s_stucntry_id
            // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
            // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
            // GROUP BY stu_cntry.stucntry
            // ORDER BY stu_cntry.stucntry";

        $json = [];
        $json2 = [];

        foreach($cntrys as $cntry){
            
            // jsonに変換
            // extract($cntrys);
            $json[] = $cntry->country;
            $json2[] = $cntry->total;
            // dd($json);
        }

    
       
        // 希望の留学先
        $dtns = Nation::join('s_n_maps', 'nations.id', '=', 's_n_maps.nations_id')
            ->join('students', 's_n_maps.students_id', '=', 'students.id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->where('books.events_id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('nations.country')
            ->select('nations.country', DB::raw('count(nations.country) as total'))
            ->get();
            // ->pluck('country')->toArray();

            // SQL文
            // $sql = "SELECT icntry.icntry, COUNT(icntry) as total
            // FROM icntry
            // JOIN stuser_icntry_map ON icntry.icntry_id = stuser_icntry_map.si_icntry_id
            // JOIN stuser ON stuser_icntry_map.si_stuser_id = stuser.stuser_id
            // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
            // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
            // GROUP BY icntry.icntry";

            $json3 = [];
            $json4 = [];
            $view_d = '';
    
            
            foreach($dtns as $dtn){
                // jsonに変換
                // extract($dtns);
                $json3[] = $dtn->country;
                $json4[] = $dtn->total;
                
            }

        

        // 留学のレベル
        $lvls = Level::join('s_l_maps', 'levels.id', '=', 's_l_maps.levels_id')
            ->join('students', 's_l_maps.students_id', '=', 'students.id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->where('books.events_id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('levels.level')
            ->select('levels.level', DB::raw('count(levels.level) as total'))
            ->get();
            // ->pluck('level')->toArray();
    
            // SQL文
            // $sql = "SELECT lvl.lvl, COUNT(lvl) as total
            // FROM lvl
            // JOIN stuser_lvl_map ON lvl.lvl_id = stuser_lvl_map.sl_lvl_id
            // JOIN stuser ON stuser_lvl_map.sl_stuser_id = stuser.stuser_id
            // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
            // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
            // GROUP BY lvl.lvl"; 

            $json5 = [];
            $json6 = [];
    
            foreach($lvls as $lvl){
                    // jsonに変換
                    // extract($lvls);
                    $json5[] = $lvl->level;
                    $json6[] = $lvl->total;
                  
            }

        // 科目
        $sbjs = Subject::join('s_sbj_maps', 'subjects.id', '=', 's_sbj_maps.subjects_id')
            ->join('students', 's_sbj_maps.students_id', '=', 'students.id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->where('books.events_id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('subjects.subject')
            ->select('subjects.subject', DB::raw('count(subject) as total'))
            ->get();
            // ->pluck('subject')->toArray();

                // SQL文
                // $sql = "SELECT sbj.sbj, COUNT(sbj) as total
                // FROM sbj
                // JOIN sbj_stuser_map ON sbj.sbj_id = sbj_stuser_map.ss_sbj_id
                // JOIN stuser ON sbj_stuser_map.ss_stuser_id = stuser.stuser_id
                // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
                // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
                // GROUP BY sbj.sbj";

                $json7 = [];
                $json8 = [];

                foreach($sbjs as $sbj){
                    // jsonに変換
                    // extract($sbjs);
                    $json7[] = $sbj->subject;
                    $json8[] = $sbj->total;
  
                }
                 

        // return view('insts.chart_each', ['events'=>$events, 'cntrys'=>$cntrys, 'dtns'=>$dtns, 'lvls'=>$lvls, 'sbjs'=>$sbjs]);

        // return view('insts.chart_each', ['events'=>$events, 'view'=>$view, 'view_d'=>$view_d,'view_l'=>$view_l, 'sbjs'=>$sbjs, 'json'=>$json, 'json2'=>$json2, 'json3'=>$json3, 'json4'=>$json4, 'json5'=>$json5, 'json6'=>$json6, 'json7'=>$json7, 'json8'=>$json8]);

        

        // return view('insts.chart_each', ['events'=>$events, 'view'=>$view, 'view_d'=>$view_d,'view_l'=>$view_l, 'view_s'=>$view_s,'sbjs'=>$sbjs, 'json'=>$json, 'json2'=>$json2, 'json3'=>$json3, 'json4'=>$json4, 'json5'=>$json5, 'json6'=>$json6, 'json7'=>$json7, 'json8'=>$json8]);

        return view('insts.chart_each', ['events'=>$events, 'cntrys'=>$cntrys, 'dtns'=>$dtns, 'lvls'=>$lvls, 'sbjs'=>$sbjs, 'json'=>$json, 'json2'=>$json2, 'json3'=>$json3, 'json4'=>$json4, 'json5'=>$json5, 'json6'=>$json6, 'json7'=>$json7, 'json8'=>$json8]);

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
        //
    }
}
