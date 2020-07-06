@extends('layouts.insts.app')
@section('content')

<div class="inner">

  <h1 class="heading">Event Details</h1>

  <a href="events/{{ $events->id }}/edit" class="e_edit"><i class="fas fa-chevron-circle-right"></i>Edit event details</a>

  <div class="mb60">
        <div class="e_time">
          <div>
            <span class="event-date">{{ $events->date }}</span>
          </div>
          <div>
            <span class="event-time">{{ $events->start_time }}</span>
            <span> - </span>
            <span class="event-time">{{ $events->end_time }}</span>
          </div>
        </div>
        <div class="e_detail_small">
          <div class="e_cont">
            <p class="event-title">{{ $events->title }}</p>
            <p class="event-description">{{ $events->dtls }}</p>
          </div>
          <div class="e_imgLarger">
            <img src="upload/{{ $events->img }}" class="event_img" alt="">
          </div>
        </div>
        <div class="e_infoSmaller">Level: 
          @foreach($levels as $level)
            <span>{{ $level }} </span>
          @endforeach
        </div> 
        <div class="e_infoSmaller">Subject areas: 
          @foreach($subjects as $subject)
            <span>{{ $subject }} </span>
          @endforeach
        </div>
        <div class="e_infoSmaller">Suitable for students from 
          @foreach($regions as $region)
            <span>{{ $region }}</span> region.
          @endforeach
        </div>
  </div>
    
  <div class="reg mb60">
      <h2 class="sub_heading">Participants</h2>
      @if($regs > 0)
        <div class="mb20">You have {{ $regs }} registerants for this event.</div>

          @if($regs > 0)
          <div id="p_list" class="pointer mb20"><i class="fas fa-chevron-circle-right"></i>Participants list</div>

          <div class="reg_table" id="p_table">
            <table >
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Level of Study</th>
                    <th>Year to Start</th>
                </tr>
                @foreach($ppts as $ppt)
                  <tr>
                      <td>{{ $ppt->firstname }} </td>
                      <td>{{ $ppt->lastname }} </td>
                      <td>{{ $ppt->email }} </td>
                      <td>{{ $ppt->country }} </td>
                      <td>{{ $ppt->level }}</td>
                      <td>{{ $ppt->year }} </td>
                  </tr>
                @endforeach
            </table>
          </div>

            <div class="pointer mb20"><i class="fas fa-chevron-circle-right"></i><a href="/subjects/{{ $events->id }}">Student statistics</a></div>

          @endif

      @else
            <div>You have no registrants for this event.</div>
      @endif
  </div>

  <div class="reg mb80">
      <h2 class="sub_heading">Questions from students</h2>
      @if($qry_num > 0)
        <div class="mb20">You have {{ $qry_num }} questions sent from students.</div>

        <div id="q_list" class="pointer mb20"><i class="fas fa-chevron-circle-right"></i>List of questions</div>

        <div class="q_table" id="q_table">
          <table>
            <tr>
                <th>Category</th>
                <th>Content</th>
            </tr>
            @foreach($qrys as $qry)
              <tr>
                  <td>{{ $qry->term }}</td>
                  <td>{{ $qry->dtls }}</td>
              </tr>
            @endforeach
          </table>
        </div>
    

      @else
        <div>You have no questions sent from students.</div>
      @endif
  </div>

</div>

@endsection('content')