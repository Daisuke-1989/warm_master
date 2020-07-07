@extends('layouts.students.app')
@section('content')



<div class="inner">
<h1 class="greet">{{$user->firstname}}`s page</h1>
</div>

<div class="container">

    <div class="heading">Your upcoming events</div>


@foreach($books as $book)
    <div class="rsv_box mb60">
        <div class="rsv_cont">
            <div>
                <span class="e-date">{{$book->date}}</span>
                <span class="event-time">{{$book->start_time}} - </span>
                <span class="event-time">{{$book->end_time}}</span>
            </div>
            <p class="e_inst">{{$book->inst_name}}</p>
            <p class="e_title_40">{{$book->title}}</p>
            <a href="{{url('books/'.$book->event_id)}}"><i class="fas fa-chevron-circle-right"></i>Details</a>
            <a href="{{url('querys/create/'.$book->event_id)}}"><i class="fas fa-chevron-circle-right"></i>Ask questions</a>
            <a href="{{url('books/'.$book->event_id)}}"><i class="fas fa-chevron-circle-right"></i>Cancel</a>
        </div>
        <div class="rsv_img">
            <img src="{{ asset('storage/img/' .$event->img) }}" alt="" class="rsv_img_size">
        <div>
    </div>
@endforeach
</div>
@endsection('content')
