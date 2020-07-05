
@extends('layouts.students.app')
@section('content')

<div class="inner">

    
        <div class="e_time">
          <div>
            <span class="event-date">{{--$event->date--}}</span>
          </div>
          <div>
            <span class="event-time">{{--$event->start_time--}}</span>
            <span> - </span>
            <span class="event-time">{{--$event->end_time--}}</span>
          </div>
        </div>
        <div class="e_detail">
          <div class="e_cont">
          <p class="univ-name">{{--大学名--}}, <span>{{--大学の国--}}</span></p>
          <p class="event-title">{{--$event->title--}}</p>
          <p class="event-description">{{--$event->dtls--}}</p>
          </div>
          <div class="e_imgLarger">
            <img src="{{--$event->img--}}" class="event_img" alt="">
          </div>
        </div>
          <div class="e_infoLarger">Level: <span>{{--レベル--}}</span></div> 
          <div class="e_infoLarger">Subject areas: <span>{{--サブジェクト--}}</span></div>
          <div class="e_infoLarger">Suitable for students from <span>{{--地域--}}</span> region.</div>

    <a href="{{--url('books/'.$event->id)--}}" class="e_book">Book</a>

</div>

@endsection('content')