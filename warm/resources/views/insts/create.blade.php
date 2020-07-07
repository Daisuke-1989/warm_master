@extends('layouts.insts.app')
@section('content')

<div class="container">

<h1 class="heading">Create Event</h1>

<div class="row">
    <form action="/insts" method="post" enctype="multipart/form-data" class="col s12">
    @csrf
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" class="validate">
                <label for="e_title">Event Title</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="date" class="datepicker">
                <label for="date">Date</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="starttime" class="timepicker">
                <label for="starttime">Start Time</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="endtime" class="timepicker">
                <label for="endtime">End Time</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea name="detail" id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Event details</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select name="lvls[]" id="" multiple>
                    <option value="" disabled selected>Choose level(s)</option>
                    @foreach( $levels as $level )
                        <option value="{{ $level->id }}">{{ $level->level }}</option>
                    @endforeach
                 </select>
                 <label for="lvl">Target Study Level</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select name="sbjs[]" id="" multiple>
                    <option value="" disabled selected>Choose subject(s)</option>
                    @foreach( $subjects as $subject )
                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                    @endforeach
                </select>
                <label for="sbj">Target Subject Areas</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select name="rgns[]" id="" multiple>Target Region/select>
                    <option value="" disabled selected>Choose region(s)</option>
                    @foreach( $regions as $region )
                        <option value="{{ $region->rgn_id }}">{{ $region->region }}</option>
                    @endforeach
                 </select>
                 <label for="rgn">Target Regions</label>
            </div>
        </div>
        <div class="file-field input-field mb40">
            <div class="btn">
                <span>File</span>
                <input type="file" name="upfile">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <p>{{ $inst->id }}</p>
       <!-- <div class="row">
           <input type="file" name="upfile">
       </div> -->
        <input type="hidden" name="inst_id" value="{{ $inst->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id}}">
        <div>
            <input type="submit" value="Submit" class="btn-submit_i btn-filter">
        </div>
    </form>
</div>
</div>


@endsection('content')