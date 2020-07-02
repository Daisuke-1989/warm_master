@extends('layouts.insts.app')
@section('content')

<div class="container">

    <h1 class="heading">Edit event details</h1>

    <?= $view ?>

    <form action="i_e_update.php" method="post" enctype="multipart/form-data">
        <div class="mb30">
            <label for="e_detail" class="label">Event details</label>
            <textarea name="e_detail" id="" cols="30" rows="40" class="edit_textarea"><?=$r["e_dtl"]?></textarea>
        </div>
        <div>
            <label for="upfile" class="label">Event Image</label>
            <input type="file" name="upfile" value="upload/<?=$r["e_img"]?>">
            <img src="upload/<?=$r["e_img"]?>" class="edit_img mb40">
        </div>
        <input type="hidden" name="id" value="<?=$r["e_id"]?>">
        <div>
            <input type="submit" value="Update" class="btn-submit_i btn-filter">
        </div>
    </form>
  
</div>

@endsection('content')