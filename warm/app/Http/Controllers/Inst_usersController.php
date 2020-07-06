<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Inst;
use App\Inst_user;

class Inst_usersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // // sessionに値を保存する
        // $firstname = Auth::user()->firstname->get();
        // $request->session()->put('name', $firstname);

        //Authからidをゲットして大学ユーザーの名前を表示

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
        //大学ユーザー情報を表示
        $user = User::find($id);
        $inst_user = Inst_user::find($id);
        //大学情報を表示
        $inst_id = $inst_user->inst_id;
        $inst = Inst::find($inst_id);

        return view('insts.user', ['user'=>$user, 'inst_user'=>$inst_user, 'inst'=>$inst]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //大学ユーザー情報を編集ページに表示
        // formのvalueに、{{ $inst_user->first_name }}などを含む
        $user = User::find($id);
        $inst_user = Inst_user::find($id);
        return view('insts.user_edit', ['user'=>$user, 'inst_user'=>$inst_user]);
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
        //ユーザー情報の更新

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'jobtitle' => 'required',
            'department' => 'required'
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）
        // Eloquent モデル
        $user = User::find($request->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->save(); 
       
        $inst_user = Inst_user::find($request->id);
        $inst_user->j_title = $request->jobtitle;
        $inst_user->dept = $request->department;
        $inst_user->save(); 

        return redirect('/inst_users');
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
