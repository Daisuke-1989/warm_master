@extends('layouts.students.app')
@section('content')



<div class="inner">

    <h1 class="greet">{{--Auth::lastname()--}}'s Page</h1>
</div>

<div class="container">

    <div class="heading">Your upcoming events</div>

    {{--@foreach($events as $event)--}}
    <div class="rsv_box mb60">
    <div class="rsv_cont">
        <div>
            <span class="e-date">{{--$event->date--}}</span>
            <span class="event-time">{{--$event->start_time--}} - </span>
            <span class="event-time">{{--$event->end_time--}}</span>
        </div>
        
            <p class="e_inst">{{--$event->inst_name(大学名)--}}</p>
            <p class="e_title_40">{{--$event->title--}}</p>
            <a href="{{--url('books/'.$event->id)--}}"><i class="fas fa-chevron-circle-right"></i>Details</a>
            <a href="{{--url('querys/create/'.$event->id)--}}"><i class="fas fa-chevron-circle-right"></i>Ask questions</a>
            <a href="{{--url('books/'.$event->id)--}}"><i class="fas fa-chevron-circle-right"></i>Cancel</a>
        </div>
        <div class="rsv_img">
            <img src="{{--$event->img--}}" alt="" class="rsv_img_size">
        <div>
    </div>
    
    {{--@endforeach--}}

</div>

@endsection('content')