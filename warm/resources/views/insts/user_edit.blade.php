@extends('layouts.insts.app')
@section('content')

<div class="container">

    <h1 class="heading">Edit personal details</h1>

    <div class="row">

    <form action="i_user_update.php" method="post" class="col s12">

    <div class="row">
        <div class="input-field col s6">
            <label for="firstname"></label>
            <input type="text" name="firstname" value="{{ $user->firstname }}">
        </div>
        <div class="input-field col s6">
            <label for="lastname"></label>
            <input type="text" name="lastname" value="{{ $user->lastname }}">
        </div>
    </div>

    <div class="row">
        <div class="input-field col s6">
            <label for="email"></label>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="input-field col s6">
            <label for="password"></label>
            <input type="password" name="password" value="{{ $user->password }}">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <label for="jobtitle"></label>
            <input type="text" name="jobtitle" value="{{ $isnt_user->j_title }}">
        </div>
        <div class="input-field col s6">
            <label for="department"></label>
            <input type="text" name="department" value="{{ $isnt_user->dept }}">
        </div>
    </div>
        <input type="hidden" name="iuser_id" value="{{ $user->id }}">
        <input type="submit" value="Save" class="btn-submit_i btn-filter">
    </form>

    </div>
    
</div>
@endsection('content')
