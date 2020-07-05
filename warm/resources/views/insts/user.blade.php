@extends('layouts.insts.app')
@section('content')

<div class="container">

    <h1 class="heading">{{ $user->firstname }}'s Account</h1>

    <div class="i_user_table">
    <table class="mb40">

        <tr>
            <td class="text-right">Your Name</td>
            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
        </tr>
        <tr>
            <td class="text-right">Email</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td class="text-right">Password</td>
            <td><input type="hidden" value="{{ $user->password }}"></td>
        </tr>
        <tr>
            <td class="text-right">Jot title</td>
            <td>{{ $inst_user->j_title}}</td>
        </tr>
        <tr>
            <td class="text-right">Department</td>
            <td>{{ $inst_user->dept}}</td>
        </tr>
        <tr>
            <td class="text-right">Institution</td>
            <td><?=$r["inst_name"]?></td>
        </tr>
        <tr>
            <td class="text-right">Country</td>
            <td><?=$r["icntry"]?></td>
        </tr>
    </table>
    </div>
    
    <a href="/inst_users/{{ $user->id }}/edit" class="btn-submit_i btn-filter">Edit</a>

</div>
@endsection('content')
