<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Inst;
use App\Inst_user;

class Inst_usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Authからidをゲットして大学ユーザーの名前を表示
        $id = Auth::user()->id->get();
        $inst_user = User::find($id);

        //instテーブルのidと大学ユーザーテーブルの大学idと合致するレコードを探して、$instに代入する。
        $inst = Inst::where('id', $inst_user->inst_id)->get();

        // view'dashboard'で、{{ $inst_user->firstname }}で大学ユーザーの名前を,{{ $inst->inst_name }}で大学名を呼び出し
        return view('inst.dashboard', ['inst_user'=>$inst_user, 'inst'=>$inst]);
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
        $user = User::find($id)->get();
        $inst_user = Inst_user::find($id)->get();
        //大学情報を表示
        $inst_id = $inst_user['inst_id'];
        $inst = Inst::find($inst_id)->get();

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
        $user = User::find($id)->get();
        $inst_user = Inst_user::find($id)->get();
        return view('inst.edit', ['user'=>$user, 'inst_user'=>$inst_user]);
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
            'pw' => 'required|min:1|max:6',
            'published' => 'required|date_format:"Y-m-d H:i:s"',
        ]);
    
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）
        // Eloquent モデル
        $books = Book::where('user_id', Auth::user()->id)
            ->find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save(); 
        return redirect('/');
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
