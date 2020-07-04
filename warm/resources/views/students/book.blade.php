

@extends('layouts.students.app')
@section('content')

<div class="inner">
    <h1 class="greet mb80">Hi {{Auth::lastname()}}, you are booking for</h1>
</div>

<div class="container">
  <div class="rsv_box mb60">
    <div class="rsv_cont">
      <div>
        <span class="e-date">{{$event->date}}</span>    
        <span class="event-time">{{$event->start_time}} - </span> 
        <span class="event-time">{{$event->end_time}}</span> 
      </div>
      <p class="e_inst">{{大学名}}</p>
      <p class="e_title">{{$event->title}}</p>
    </div>
    <div class="rsv_img">
      <img src="{{$event->img}}" alt="" class="rsv_img_size">
    </div>
  </div>

  <div class="row">

    <form action="{{url('books')}}" method="post" class="col s12">
    {{ csrf_field() }}
      <div class="row">
        <div class="input-field col s12">
          <label>First Name</label>
          <input type="text" name="firstname" value="{{ユーザー名前}}" class="validate">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label>Last Name</label>
          <input type="text" name="lastname" value="{{ユーザー名前}}" class="validate">
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label>Email</label>
          <input type="email" name="email" value="{{ユーザーemail}}" class="validate">
        </div>
      </div>
      <input type="hidden" name="event_id" value="{{$event->id}">
      
      <input type="submit" value="Confirm" class="btn-submit btn-filter">

    </form>

  </div>

</div>


@endsection('content')