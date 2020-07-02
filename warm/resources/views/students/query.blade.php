

@extends('layouts.students.app')
@section('content')


<div class="inner">

<h1 class="greet"><?=$_SESSION["firstname"]?>, you are asking a question about ...</h1>

</div>

<div class="container">

    <div class="heading"><?=$r["inst_name"]?></div>

    <div class="row">
    <form action="e_qry_insert.php" method="post" class="col s12">

    <div class="row">
        <div class="input-field col s12">
            <select name="category" id="">
            <option value="" disabled selected>Select category</option>
            @foreach($terms as $term)
            <option value="{{$term->term}}">{{$term->term}}</option>
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
        <input type="hidden" name="e_id" value="{{大学id}}">
        <input type="hidden" name="s_id" value="{{学生id}}">
        <input type="submit" value="Send" class="btn-submit btn-filter">
    </form>
    </div>
</div>
@endsection('content')