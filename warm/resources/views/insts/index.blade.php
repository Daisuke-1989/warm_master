@extends('layouts.insts.app')
@section('content')

<div class="inner">
<p class="greet_small">
    Hello, {{ $inst_user->firstname }}！
</p>

<a href="i_user_account.php?id={{ $inst_user->id }}">
    <div class="link_box">
        <div class="link_box_l">
            <p class="link_box_heading">Manage Personal Account</p>
            <p class="link_box_content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna </p>
        </div>
        <div class="link_box_r">
           <i class="fas fa-angle-right"></i>
        </div>
    </div>
</a>

<p class="heading_large">{{ $inst->inst_name }}</p>

<div class="link_box_flex">
    <div class="link_box_inner">
        <a href="i_e_entry.php">
            <div class="link_box">
                <div class="link_box_l">
                    <p class="link_box_heading">Create Event</p>
                    <p class="link_box_content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna </p>
                </div>
                <div class="link_box_r">
                    <a href="i_e_entry.php"><i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </a>
        </div>
    <div class="link_box_inner">
        <a href="i_e_list.php">
            <div class="link_box">
                <div class="link_box_l">
                    <p class="link_box_heading">Manage Event</p>
                    <p class="link_box_content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna </p>
                </div>
                <div class="link_box_r">
                    <a href="i_e_list.php"><i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </a>
    </div>
    <div class="link_box_inner">
        <a href="i_stats.php?id= {{ $inst->id }}">
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