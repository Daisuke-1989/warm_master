

@extends('layouts.students.app')
@section('content')

<!-- EYE CATCH -->
<div class="eye-catch">
<div class="intro-box">
    <p class="intro-text">Introducing opportunities to speak to university representatives to learn about overseas study choices.</p><br>
    <p class="second-text">Your journey begins here.</p> 
</div>
</div>

<div class="inner">

    <h1 class="greet">Welcome！</h1>

    <p class="greet">Hello, {{Auth::lastname()}} !</p> //Authから持ってくる？ログインしていない場合ー＞Helloのみ


</div>

<div class="container">
    <h1 class="heading">Search</h1>


    <div id="search" class="row">
        <form action="{{url('events')}}" method="post" id="filterResult" name="filterResult" class="col s12">
        {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s12">
                <select name="dest" id="selectDestination">
                    <option value="" disabled selected>Choose destination</option>
                        @foreach ($nations as $nation) //nationsテーブルからnationを取得しforearchで回す。
                        <option value="{{$nation->country}}">{{$nation->country}}</option>
                        @endforeach
                </select>
                <label for="dest">Destination</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <select name="rgn" id="selectArea">
                        <option value="" disabled selected>Choose your region</option>
                            @foreach ($nations as $nation)
                            <option value="{{$nation->region}}">{{$nation->region}}</option> //nationsテーブルからregionを取得しforearchで回す。
                            @endforeach
                    </select>
                    <label for="rgn">Where you are</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="lvl" id="selectLevel">
                    <option value="" disabled selected class="choose">Choose level of study</option>
                            @foreach ($levels as $level)
                            <option value="{{$level->level}}">{{$level->level}}</option> //levelsテーブルからlevelを取得しforearchで回す。
                            @endforeach
                    </select>
                    <label for="lvl">Level of study</label>
                </div>
            </div>
                <button ><span class="btn-filter">Filter</span></button>
        </form>
    </div>

            @foreach ($events as $event)
            <div class="e_list">
            <div class="cont_l">
            <p class="e_date">{{$event->date}}</p>
            <p class="e_inst">{{大学名(instsテーブル)}}, {{大学の国(nationsテーブル)}}</p>
            <p class="e_title">{{$event->title}}</p>
            <div class="flex">
            <span class="e_info">Level: {{レベル(levelsテーブル)}}</span>
            <span class="e_info">Suitable for students in {{地域(nationsテーブル)}} region.</span>
            </div>
            </div>
            <div class="cont_r">
            <div>
            <img src="{{$event->img}}" class="e_img_thumbnail" alt="">
            </div>
            <div>
            <a href="{{url('books/'.$event->id)}}"><i class="fas fa-angle-right"></i></a>
            </div>
            </div>
            </div>
            @endforeach
        </div>

@endsection('content')