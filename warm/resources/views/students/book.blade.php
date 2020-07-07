

@extends('layouts.students.app')
@section('content')

<div class="inner">
    <h1 class="greet mb80">Hi {{$user->firstname}}, you are booking for</h1>
</div>

<div class="container">
  <div class="rsv_box mb60">
    <div class="rsv_cont">
      <div>
        <span class="e-date">{{ $event->date }}</span>    
        <span class="event-time">{{$event->start_time}} - </span> 
        <span class="event-time">{{$event->end_time}}</span> 
      </div>
      <p class="e_inst">{{$event->inst_name}}</p>
      <p class="e_title">{{$event->title}}</p>
    </div>
    <div class="rsv_img">
      <img src="{{$event->img}}" alt="" class="rsv_img_size">
    </div>
  </div>

  <div class="row">

    <form action="{{ route('books.store') }}" method="POST" class="col s12">
    {{ csrf_field() }}
      <div class="row">
        <!-- <div class="input-field col s12"> -->
          <p class="e_infoLarger">First Name : <span>{{$user->firstname}}</span></p>
        <!-- </div> -->
      </div>
      <div class="row">
        <!-- <div class="input-field col s12"> -->
          <p class="e_infoLarger">Last Name : <span>{{$user->lastname}}</span></p>
        <!-- </div> -->
      </div>
      <div class="row">
        <!-- <div class="input-field col s12"> -->
          <p class="e_infoLarger">Email : <span>{{$user->email}}</span></p>
        <!-- </div> -->
      </div>
      <input type="hidden" name="event_id" value="{{$event->event_id}}">
      <input type="submit" value="Confirm" class="btn-submit btn-filter">
      
    </form>

  </div>

</div>


@endsection('content')