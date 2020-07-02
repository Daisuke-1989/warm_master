@extends('layouts.insts.app')
@section('content')

<div class="inner">

  <h1 class="heading">Event Details</h1>

  <a href="i_e_updateview.php?id=<?=$id?>" class="e_edit"><i class="fas fa-chevron-circle-right"></i>Edit event details</a>

  <div class="mb60">
        <div class="e_time">
          <div>
            <span class="event-date"><?=$r_e["e_date"]?></span>
          </div>
          <div>
            <span class="event-time"><?=$r_e["e_start_time"]?></span>
            <span> - </span>
            <span class="event-time"><?=$r_e["e_end_time"]?></span>
          </div>
        </div>
        <div class="e_detail_small">
          <div class="e_cont">
            <?= $view ?>
          </div>
          <div class="e_imgLarger">
            <img src="upload/<?=$r_e["e_img"]?>" class="event_img" alt="">
          </div>
        </div>
        <div class="e_infoSmaller">Level: <span><?= $view_lvl?></span></div> 
        <div class="e_infoSmaller">Subject areas: <span><?= $view_sbj?></span></div>
        <div class="e_infoSmaller">Suitable for students from <span><?= $view_rgn?></span> region.</div>
  </div>
    
  <div class="reg mb60">
      <h2 class="sub_heading">Participants</h2>
      <?php if($r_num["reg_num"]>0){?>
      <div class="mb20">You have <?= $r_num["reg_num"]?> registerants for this event.</div>

          <?php if($r_num["reg_num"]>0){?>
          <div id="p_list" class="pointer mb20"><i class="fas fa-chevron-circle-right"></i>Participants list</div>

          <div class="reg_table" id="p_table">
            <table >
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Level of Study</th>
                    <th>Year to Start</th>
                </tr>
                
                    <?= $view_rgts ?>
            </table>
          </div>

            <div class="pointer mb20"><i class="fas fa-chevron-circle-right"></i><a href="i_e_chart.php?id=<?=$id?>">Student statistics</a></div>

          <?php } ?>

        <?php }else{ ?>
            <div>You have no registrants for this event.</div>
        <?php } ?>
  </div>

    <div class="reg mb80">
      <h2 class="sub_heading">Questions from students</h2>
      <?php if($r_qry["qry_num"]>0){?>
        <div class="mb20">You have <?=$r_qry["qry_num"]?> questions sent from students.</div>

        <div id="q_list" class="pointer mb20"><i class="fas fa-chevron-circle-right"></i>List of questions</div>

        <div class="q_table" id="q_table">
          <table>
            <tr>
                <th>Category</th>
                <th>Content</th>
            </tr>
                <?= $view_qc ?>
          </table>
        </div>
    

      <?php }else{ ?>
      <div>You have no questions sent from students.</div>
      <?php } ?>
    </div>

</div>

@endsection('content')