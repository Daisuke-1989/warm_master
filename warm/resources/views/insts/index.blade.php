@extends('layouts.insts.app')
@section('content')

<div class="inner">
<p class="greet_small">
    Hello, {{ $user->firstname }}！
</p>

<a href="/inst_users/{{ $user->id }}">
    <div class="link_box">
        <div class="link_box_l">
            <p class="link_box_heading">Manage Personal Account</p>
            <p class="link_box_content">Lorem Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna </p>
        </div>
        <div class="link_box_r">
           <i class="fas fa-angle-right"></i>
        </div>
    </div>
</a>

<p class="heading_large">{{ $inst->inst_name }}</p>

<p>{{$inst->id}}</p>

<div class="link_box_flex">
    <div class="link_box_inner">
        <a href="/insts/create">
            <div class="link_box">
                <div class="link_box_l">
                    <p class="link_box_heading">Create Event</p>
                    <p class="link_box_content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna </p>
                </div>
                <div class="link_box_r">
                    <a href="/insts/create"><i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </a>
        </div>
    <div class="link_box_inner">
        <a href="/insts">
            <div class="link_box">
                <div class="link_box_l">
                    <p class="link_box_heading">Manage Event</p>
                    <p class="link_box_content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna </p>
                </div>
                <div class="link_box_r">
                    <a href="/insts"><i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </a>
    </div>
    <div class="link_box_inner">
        <a href="terms/{{ $inst->id }}">
            <div class="link_box">
                <div class="link_box_l">
                    <p class="link_box_heading">Data</p>
                    <p class="link_box_content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna </p>
                </div>
                <div class="link_box_r">
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </a>
    </div>
</div>

</div>
@endsection('content')