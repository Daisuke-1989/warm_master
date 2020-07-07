@extends('layouts.insts.app')
@section('content')

<div class="inner">
  <h1 class="greet">{{ $inst->inst_name }}</h1>
</div>

<div class="container">
    <h1 class="heading">Events List</h1>

    @if(!isset($events[0]))
      <p class="mb60">You have no events registered.</p>
    @else

      @foreach($events as $event)

        <div class="e_list_box mb60">

          <div class="e_list_cont">
              <span class="e-date">{{ $event->date }}</span>
              <span class="event-time">{{ $event->start_time }} - </span>
              <span class="event-time">{{ $event->end_time }}</span>
              <p class="e_title_40 e_title_large">{{ $event->title }}</p>
              <a href="insts/{{ $event->id }}"><i class="fas fa-chevron-circle-right"></i>Details</a>
          </div>

          <div class="rsv_img">
              <img src="{{ asset('storage/img/' .$event->img) }}" class="rsv_img_size">
          </div>

        </div>
      @endforeach

    @endif

</div>
@endsection('content')
