<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Event;
use App\Nation;
use App\Level;
use App\Book;
use App\Student;
use App\Inst;

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


    public function index()
    {
        $user = auth()->user();
        $id = $user->id;
        
        $book  =Book::join('events','books.events_id','=','events.id')
                    ->join('insts','events.insts_id','=','insts.id')
                    ->where('books.students_id','=',$id)
                    ->select('events.id as event_id','events.date','events.start_time','events.end_time','events.title','events.img','insts.inst_name') 
                    ->get();
        
        
        return view('students.user',[
                    'books'=>$book,
                    'user'=>$user,
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
