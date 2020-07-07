

@extends('layouts.students.app')
@section('content')

<div class="inner">

<h1 class="greet">{{$user->firstname}}, you are asking a question about ...</h1>

</div>

<div class="container">

    <div class="heading">{{$event->inst_name}}</div>

    <div class="row">
    <form action="/querys/set" method="post" class="col s12">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s12">
            <select name="terms_id" id="">
            <option value="" disabled selected>Select category</option>
            @foreach($terms as $term)
            <option name='terms_id' value="{{$term->id}}">{{$term->term}}</option>
            @endforeach
            </select>
            <label for="category">Select category</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
        <textarea id="textarea1" name="qry" class="materialize-textarea"></textarea>
        <label for="textarea1">What would you like to ask?</label>
        </div>
    </div>
        <input type="hidden" name="events_id" value="{{$event->event_id}}">
        <input type="hidden" name="students_id" value="{{$user->id}}">
        <input type="submit" value="Send" class="btn-submit btn-filter">
    </form>
    </div>
</div>
@endsection('content')
