

@extends('layouts.students.app')
@section('content')

<div class="inner">

<h1 class="greet">{{$user->firstname}}, you are asking a question about ...</h1>

</div>

<div class="container">

    <div class="heading">{{$event->inst_name}}</div>

    <div class="row">
    <form action="query.store" method="post" class="col s12">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s12">
            <select name="category" id="">
            <option value="" disabled selected>Select category</option>
            @foreach($subjects as $subject)
            <option value="{{$subject->subject_id}}">{{$subject->subject}}</option>
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
        <input type="hidden" name="e_id" value="{{$event->insts_id}}">
        <input type="hidden" name="s_id" value="{{$user->student_id}}">
        <input type="submit" value="Send" class="btn-submit btn-filter">
    </form>
    </div>
</div>
@endsection('content')
