@extends('layouts.insts.app')
@section('content')

<div class="inner">
  <h1 class="greet"><?= $r_inst["inst_name"]?></h1>
</div>

<div class="container">
    <h1 class="heading">Events List</h1>
    
    
  
        <?= $view ?>


</div>
@endsection('content')