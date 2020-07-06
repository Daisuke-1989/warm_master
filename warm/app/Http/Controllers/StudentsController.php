<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Event;
use App\Nation;
use App\Level;


class StudentsController extends Controller
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

    public function chart_each($id){

        // 当該イベントに予約した学生の統計
        
        // イベント情報の取得
        $events = Event::find($id)->get();


        // 学生の出身国
        $cntrys = Nation::join('students', 'nations.id', '=', 'students.nations_id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->where('books.events_id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('nations.country')
            ->orderBy('nations.country')
            ->select('nations.country', DB::raw('count(nations.country) as total'))
            ->get();

            // SQL文
            // $sql = "SELECT stu_cntry.stucntry, COUNT(stucntry) as total
            // FROM stu_cntry
            // JOIN stuser ON stu_cntry.stucntry_id = stuser.s_stucntry_id
            // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
            // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
            // GROUP BY stu_cntry.stucntry
            // ORDER BY stu_cntry.stucntry";

        $json[] = '';
        $json2[] = '';
        $view = '';

        if(!isset($cntrys[0])){

            $view .= '<tr>';
            $view .= '<td>none</td>';
            $view .= '<td>none</td>';
            $view .= '</tr>';

        }else{

            foreach($cntrys as $cntry){
                // jsonに変換
                // extract($cntry);
                $json[] = $cntry->country;
                $json2[] = $cntry->total;
                
                $view .= '<tr>';
                $view .= '<td>'.$cntry['country'].'</td>';
                $view .= '<td>'.$cntry['total'].'</td>';
                $view .= '</tr>';
            }
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

            // SQL文
            // $sql = "SELECT icntry.icntry, COUNT(icntry) as total
            // FROM icntry
            // JOIN stuser_icntry_map ON icntry.icntry_id = stuser_icntry_map.si_icntry_id
            // JOIN stuser ON stuser_icntry_map.si_stuser_id = stuser.stuser_id
            // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
            // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
            // GROUP BY icntry.icntry";

            $json3[] = '';
            $json4[] = '';
            $view_d = '';
    
            if(!isset($dtns[0])){
    
                $view_d .= '<tr>';
                $view_d .= '<td>0</td>';
                $view_d .= '<td>0</td>';
                $view_d .= '</tr>';
    
            }else{
    
                foreach($dtns as $dtn){
                    // jsonに変換
                    // extract($cntry);
                    $json3[] = $dtn->country;
                    $json4[] = $dtn->total;
                    
                    $view_d .= '<tr>';
                    $view_d .= '<td>'.$dtn['country'].'</td>';
                    $view_d .= '<td>'.$dtn['total'].'</td>';
                    $view_d .= '</tr>';
                }
            }

        // 留学のレベル
        $lvls = Level::join('s_l_maps', 'levels.id', '=', 's_l_maps.levels_id')
            ->join('students', 's_l_maps.students_id', '=', 'students.id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->where('books.events_id', '=', $id)
            ->where('books.CXL', '=', 0)
            ->groupBy('levels.level')
            ->select('levels.level', DB::raw('count(levels.level) as total'))
            ->get;
    
            // SQL文
            // $sql = "SELECT lvl.lvl, COUNT(lvl) as total
            // FROM lvl
            // JOIN stuser_lvl_map ON lvl.lvl_id = stuser_lvl_map.sl_lvl_id
            // JOIN stuser ON stuser_lvl_map.sl_stuser_id = stuser.stuser_id
            // JOIN rsv ON stuser.stuser_id = rsv.r_stuser_id
            // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
            // GROUP BY lvl.lvl"; 

            $json5[] = '';
            $json6[] = '';
            $view_l = '';
    
            if(!isset($lvls[0])){
    
                $view_l .= '<tr>';
                $view_l .= '<td>0</td>';
                $view_l .= '<td>0</td>';
                $view_l .= '</tr>';
    
            }else{
    
                foreach($lvls as $lvl){
                    // jsonに変換
                    // extract($cntry);
                    $json5[] = $lvl->level;
                    $json6[] = $lvl->total;
                    
                    $view_l .= '<tr>';
                    $view_l .= '<td>'.$lvl['level'].'</td>';
                    $view_l .= '<td>'.$lvl['total'].'</td>';
                    $view_l .= '</tr>';
                }
            }

        // 科目
        $sbjs = Subject::join('s_sbj_maps', 'subjects.id', '=', 's_l_maps.subjects_id')
            ->join('students', 's_sbj_maps.students_id', '=', 'students.id')
            ->join('books', 'students.id', '=', 'books.students_id')
            ->where('books.events_id', '=', $id)
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
                // WHERE rsv.r_e_id = :id AND rsv.rsv_flg=1
                // GROUP BY sbj.sbj";

                $json7[] = '';
                $json8[] = '';
                $view_s = '';
        
                if(!isset($sbjs[0])){
        
                    $view_s .= '<tr>';
                    $view_s .= '<td>0</td>';
                    $view_s .= '<td>0</td>';
                    $view_s .= '</tr>';
        
                }else{
        
                    foreach($sbjs as $sbj){
                        // jsonに変換
                        // extract($cntry);
                        $json7[] = $sbj->sbject;
                        $json8[] = $sbj->total;
                        
                        $view_s .= '<tr>';
                        $view_s .= '<td>'.$sbj['subject'].'</td>';
                        $view_s .= '<td>'.$sbj['total'].'</td>';
                        $view_s .= '</tr>';
                    }
                }

        // return view('insts.chart_each', ['events'=>$events, 'cntrys'=>$cntrys, 'dtns'=>$dtns, 'lvls'=>$lvls, 'sbjs'=>$sbjs]);

        // return view('insts.chart_each', ['events'=>$events, 'view'=>$view, 'view_d'=>$view_d,'view_l'=>$view_l, 'sbjs'=>$sbjs, 'json'=>$json, 'json2'=>$json2, 'json3'=>$json3, 'json4'=>$json4, 'json5'=>$json5, 'json6'=>$json6, 'json7'=>$json7, 'json8'=>$json8]);

        return view('insts.chart_each', ['events'=>$events, 'view'=>$view, 'view_d'=>$view_d,'view_l'=>$view_l, 'sbjs'=>$sbjs, $json->toJson(), $json2->toJson(), $json3->toJson(), $json4->toJson(), $json5->toJson(), $json6->toJson(), $json7->toJson(), $json8->toJson()]);

    }

    public function chart_all($id){

        // 当該大学が開催したイベントに予約した学生の統計

        // 大学名の取得
        $inst = Inst::find($id)->get();

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
            ->get;

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

         // 科目
         $sbjs = Subject::join('s_sbj_maps', 'subjects.id', '=', 's_l_maps.subjects_id')
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

        // コンペティターアナリシス
        $sub_query = DB::raw('SELECT students.id FROM stuents
        JOIN books ON students.id = books.students_id
        JOIN events ON books.events_id = events.id 
        WHERE events.insts_id = {{ $id }}');

        $anlyss = Inst::join('events', 'insts.id', '=', 'events.insts_id')
            ->join('books', 'events.id', '=', 'books.events.id')
            ->join('{{ $sub_query }} AS students', 'books.students_id', '=', 'students.id')
            ->where('insts.id', '!=', $id)
            ->groupBy('insts.inst_name')
            ->select('insts.inst_name')
            ->get();

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

        return view('insts.chart_all', ['inst'=>$inst, 'cntrys'=>$cntrys, 'dtns'=>$dtns, 'lvls'=>$lvls, 'sbjs'=>$sbjs, 'anlyss'=>$anlyss]);


    }

    public function index()
    {
        $user_id    =   Auth::user()->id->get();
        $student    =   Student::where('id', $user_id)->get();
        $student_id = $student->id;
        
        $book      =   Book::join('events','book.events_id','=','events.id')
                        ->join('insts','events.insts_id','=','insts.id')
                        ->where('id','=',$student_id)
                        ->get();
        
        
        return view('students.user',[
                    'book'=>$book
                    ]);
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
        //
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
