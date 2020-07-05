@extends('layouts.insts.app')
@section('content')

<div class="container">

    <h1 class="heading">Edit event details</h1>

    <div class="mb20">
        <span class="mr20">{{ $event->date }}</span>
        <span>{{ $event->start_time }} - </span> 
        <span>{{ $event->end_time }}</span>
    </div>

    <p class="e_title_large mb30">{{ $event->title }}</p>';

    <form action="/events/{{ $event->id }}" method="post" enctype="multipart/form-data">
        <div class="mb30">
            <label for="detail" class="label">Event details</label>
            <textarea name="detail" id="" cols="30" rows="40" class="edit_textarea">{{ $event->dtls }}</textarea>
        </div>
        <div>
            <label for="upfile" class="label">Event Image</label>
            <input type="file" name="upfile" value="upload/{{ $event->img }}">
            <img src="upload/{{ $event->img }}" class="edit_img mb40">
        </div>
        <input type="hidden" name="id" value="{{ $event->id }}">
        <div>
            <input type="submit" value="Update" class="btn-submit_i btn-filter">
        </div>
    </form>
  
</div>

@endsection('content')