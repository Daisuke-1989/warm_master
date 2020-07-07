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

class TermsController extends Controller
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
        // 当該大学が開催したイベントに予約した学生の統計

        // 大学名の取得
        $inst = Inst::find($id);

        // 学生の出身国

        $cntrys = Nation::join('students', 'nations.id', '=', 'students.nations_id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->join('events', 'books.events_id', '=', 'events.id')
            ->join('insts', 'events.insts_id', '=', 'insts.id')
            ->where('insts.id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('nations.country')
            ->orderBy('nations.country')
            ->select('nations.country', DB::raw('count(nations.country) as total'))
            ->get();

        $json = [];
        $json2 = [];

        foreach($cntrys as $cntry){
            
            // jsonに変換
            // extract($cntrys);
            $json[] = $cntry->country;
            $json2[] = $cntry->total;
            // dd($json);
        }

                // SQL文
                // $sql = "SELECT stu_cntry.stucntry, COUNT(stucntry) as total
                // FROM stu_cntry
                // JOIN stuser ON stu_cntry.stucntry_id = stuser.s_stucntry_id
                // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id 
                // JOIN i_event ON rsv.r_e_id = i_event.e_id
                // JOIN inst ON i_event.e_inst_id = inst.inst_id
                // WHERE inst.inst_id = :id AND rsv.rsv_flg=1
                // GROUP BY stu_cntry.stucntry
                // ORDER BY stu_cntry.stucntry";

        // 希望するの留学先国
        $dtns = Nation::join('s_n_maps', 'nations.id', '=', 's_n_maps.nations_id')
            ->join('students', 's_n_maps.students_id', '=', 'students.id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->join('events', 'books.events_id', '=', 'events.id')
            ->join('insts', 'events.insts_id', '=', 'insts.id')
            ->where('insts.id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('nations.country')
            ->select('nations.country', DB::raw('count(nations.country) as total'))
            ->get();

                // SQL文
                // $sql = "SELECT icntry.icntry, COUNT(icntry) as total
                // FROM icntry
                // JOIN stuser_icntry_map ON icntry.icntry_id = stuser_icntry_map.si_icntry_id
                // JOIN stuser ON stuser_icntry_map.si_stuser_id = stuser.stuser_id
                // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
                // JOIN i_event ON rsv.r_e_id = i_event.e_id
                // JOIN inst ON i_event.e_inst_id = inst.inst_id
                // WHERE inst.inst_id = :id AND rsv.rsv_flg=1
                // GROUP BY icntry.icntry";


            $json3 = [];
            $json4 = [];
            
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
            ->join('events', 'books.events_id', '=', 'events.id')
            ->join('insts', 'events.insts_id', '=', 'insts.id')
            ->where('insts.id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('levels.level')
            ->select('levels.level', DB::raw('count(levels.level) as total'))
            ->get();

                // SQL文
                // $sql = "SELECT lvl.lvl, COUNT(lvl) as total
                // FROM lvl
                // JOIN stuser_lvl_map ON lvl.lvl_id = stuser_lvl_map.sl_lvl_id
                // JOIN stuser ON stuser_lvl_map.sl_stuser_id = stuser.stuser_id
                // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
                // JOIN i_event ON rsv.r_e_id = i_event.e_id
                // JOIN inst ON i_event.e_inst_id = inst.inst_id
                // WHERE inst.inst_id = :id AND rsv.rsv_flg=1
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
            ->join('events', 'books.events_id', '=', 'events.id')
            ->join('insts', 'events.insts_id', '=', 'insts.id')
            ->where('insts.id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('subjects.subject')
            ->select('subjects.subject', DB::raw('count(subject) as total'))
            ->get();

                // SQL文
                // $sql = "SELECT sbj.sbj, COUNT(sbj) as total
                // FROM sbj
                // JOIN sbj_stuser_map ON sbj.sbj_id = sbj_stuser_map.ss_sbj_id
                // JOIN stuser ON sbj_stuser_map.ss_stuser_id = stuser.stuser_id
                // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
                // JOIN i_event ON rsv.r_e_id = i_event.e_id
                // JOIN inst ON i_event.e_inst_id = inst.inst_id
                // WHERE inst.inst_id = :id AND rsv.rsv_flg=1
                // GROUP BY sbj.sbj";


                $json7 = [];
                $json8 = [];

                foreach($sbjs as $sbj){
                    // jsonに変換
                    // extract($sbjs);
                    $json7[] = $sbj->subject;
                    $json8[] = $sbj->total;
  
                }

        // コンペティターアナリシス
        // $sub_query = DB::raw('SELECT students.id FROM stuents
        // JOIN books ON students.id = books.students_id
        // JOIN events ON books.events_id = events.id 
        // WHERE events.insts_id = {{ $id }}');

        // $anlyss = Inst::join('events', 'insts.id', '=', 'events.insts_id')
        //     ->join('books', 'events.id', '=', 'books.events.id')
        //     ->join('{{ $sub_query }} AS students', 'books.students_id', '=', 'students.id')
        //     ->where('insts.id', '!=', $id)
        //     ->groupBy('insts.inst_name')
        //     ->select('insts.inst_name')
        //     ->get();

                // SQL文
                // $sql = "SELECT inst.inst_name
                // FROM inst
                // JOIN i_event ON inst.inst_id = i_event.e_inst_id 
                // JOIN rsv ON i_event.e_id = rsv.r_e_id
                // JOIN 
                // (SELECT stuser.stuser_id FROM stuser
                // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
                // JOIN i_event ON rsv.r_e_id = i_event.e_id 
                // WHERE i_event.e_inst_id = :id) AS stuser
                // ON rsv.r_stuser_id = stuser.stuser_id
                // WHERE NOT inst.inst_id = :i_id 
                // GROUP BY inst.inst_name";

        return view('insts.chart_all', ['inst'=>$inst, 'cntrys'=>$cntrys, 'dtns'=>$dtns, 'lvls'=>$lvls, 'sbjs'=>$sbjs, 'json'=>$json, 'json2'=>$json2, 'json3'=>$json3,'json4'=>$json4,'json5'=>$json5,'json6'=>$json6, 'json7'=>$json7, 'json8'=>$json8,]);

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
