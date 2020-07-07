@extends('layouts.insts.app')
@section('content')

<div class="inner">

<h1 class="heading">Students Statistics</h1>

<div class="mb60">
<p class="sub_heading">{{ $events->title}} <span>on {{ $events->date }}</span></p>
</div>

<div class="mb80">
   
    <p id="btn1" class="c_title pointer"><i class="fas fa-chevron-circle-right"></i>Countries of origins</p> 
    <div id="out_box1" class="out_box1">
        <div class="chart_box">
            <div class="table">
                <table>
                    <tr>
                        <th>Country</th>
                        <th>Number</th>
                    </tr>
                        {{ $view }}
                </table>
            </div>
            <div class="pie-chart-container chart">
                <canvas id="myChart1" width="400px" height="400px"></canvas>
            </div>  
        </div>
    </div>


    <p id="btn2" class="c_title pointer"><i class="fas fa-chevron-circle-right"></i>Desired destinations</p> 
    <div id="out_box2" class="out_box2">
        <div class="chart_box">
            <div class="table">
                <table>
                    <tr>
                        <th>Destination</th>
                        <th>Number</th>
                    </tr>
                        {{ $view_d }}
                </table>
            </div>
            <div class="pie-chart-container chart">
                <canvas id="myChart2" width="400px" height="400px"></canvas>
            </div> 
        </div>
    </div>

    <p id="btn3" class="c_title pointer"><i class="fas fa-chevron-circle-right"></i>Level of study</p> 
    <div id="out_box3" class="out_box3">
        <div class="chart_box">
            <div class="table">
                <table>
                    <tr>
                        <th>Level</th>
                        <th>Number</th>
                    </tr>
                        {{ $view_l }}
                </table>
            </div>
            <div class="pie-chart-container chart">
                <canvas id="myChart3" width="400px" height="400px"></canvas>
            </div> 
        </div>
    </div>

    <p id="btn4" class="c_title pointer"><i class="fas fa-chevron-circle-right"></i>Subject areas</p> 
    <div id="out_box4" class="out_box4">
        <div class="chart_box">
        <div class="table">
                <table>
                    <tr>
                        <th>Sbject area</th>
                        <th>Number</th>
                    </tr>
                        {{ $view_s }}
                </table>
            </div><div class="pie-chart-container1 chart">
                <canvas id="myChart4" width="800px" height="800px"></canvas>
            </div> 
        </div>
    </div>

</div>
</div>
<script>
const c = @json($json);
const c2 = @json($json2);
const c3 = @json($json3);
const c4 = @json($json4);
const c5 = @json($json5);
const c6 = @json($json6);
const c7 = @json($json7);
const c8 = @json($json8);
</script>
@endsection('content')