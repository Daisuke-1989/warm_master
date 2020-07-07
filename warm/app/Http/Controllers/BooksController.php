<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Book;

class BooksController extends Controller
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
        //バリデーションはいらない（ユーザーが入力する項目がないので)
        $books = new Book;
        $books->events_id   =  $request->input('event_id');
        $books->students_id =   1; //Auth::user()->id
        $books->CXL         =   0;
        $books->save();    
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
        $events =Event::join('insts','events.insts_id','=','insts.id')
                        ->where('events.id','=',$id)
                        ->select('events.id as event_id','events.date','events.start_time','events.end_time','events.title','events.img','insts.inst_name') 
                        ->first();
        return view('students.book', ['event' => $events]);

        

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
