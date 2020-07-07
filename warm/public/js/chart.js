// Chart.jsに関するスクリプト
var ctx1 = $('#myChart1');
var ctx2 = $('#myChart2');
var ctx3 = $('#myChart3');
var ctx4 = $('#myChart4');


var options1 = {
    title :{
        display: true,
        position: "top",
        text: "Country of origins",
        fontSize: 18,
        fontColor: "#262626"
    },
    legend : {
        display: true,
        position: "bottom"
    }
};

var options2 = {
    title :{
        display: true,
        position: "top",
        text: "Desired Destinations",
        fontSize: 18,
        fontColor: "#262626"
    },
    legend : {
        display: true,
        position: "bottom"
    }
};

var options3 = {
    title :{
        display: true,
        position: "top",
        text: "Level of Study",
        fontSize: 18,
        fontColor: "#262626"
    },
    legend : {
        display: true,
        position: "bottom"
    }
};

var options4 = {
    title: {
        display: true,
        position: "top",
        text: "Subject areas of interest",
        fontSize: 18,
        fontColor: "#262626"
    },
    scales: {
        xAxes : [{
            ticks: {
                min: 0
            }
        }]
    },
    legend: {
        display: false
    }
};

// datasetsの中で、先ほど読み出してきた$txtの配列のそれぞれの値をセットしている。例えば$txt[0]はUK、$txt[1]はUSA。
var data1 = {
    
    datasets: [{
        data: '{{ $json2_e }}',
        backgroundColor: [
            "#6A2B86",
            "#F0E52F",
            "#1ABEBE",
            "#ED871D",
            "#DF3291",
            "#66266C",
        ],
        // borderColor: [
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626"
        // ],
        // borderWidth: [1, 1, 1, 1, 1, 1]
        borderAlign: "inner"
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: '{{ $json_e }}'
    
    };

    var data2 = {
    
    datasets: [{
        data: '{{ $json4_e }}',
        backgroundColor: [
            "#71C3FE",
            "#D0FA96",
            "#F687AF"
        ],
        // borderColor: [
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626"
        // ],
        // borderWidth: [1, 1, 1, 1, 1, 1]
        borderAlign: "inner"
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels:  '{{ $json3_e }}'

    };

    var data3 = {
    
    datasets: [{
        data: '{{ $json6_e }}',
        backgroundColor: [
            "#71C3FE",
            "#D0FA96",
            "#F687AF"
        ],
        // borderColor: [
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626",
        //     "#262626"
        // ],
        // borderWidth: [1, 1, 1, 1, 1, 1]
        borderAlign: "inner"
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels:  '{{ $json5_e }}'
    };

var data4 = {
    datasets: [{
        // barPercentage: 0.5,
        // barThickness: "flex",
        // maxBarThickness: 8,
        // minBarLength: 2,
        backgroundColor: "#25DD76",
        borderColor: "#25DD76",
        borderWidth: 1,
        data: '{{ $json8_e }}'
    }],
    labels: '{{ $json7_e }}'
    
};


var myPieChart1 = new Chart(ctx1, {
    type: 'pie',
    data: data1,
    options: options1
});

var myPieChart2 = new Chart(ctx2, {
    type: 'pie',
    data: data2,
    options: options2
});

var myPieChart3 = new Chart(ctx3, {
    type: 'pie',
    data: data3,
    options: options3
});

var myBarChart4 = new Chart(ctx4, {
    type: 'horizontalBar',
    data: data4,
    options: options4
});



// グラフの開閉に関するスクリプト
const btn1 = document.querySelector("#btn1");

btn1.addEventListener("click", function(){
    const oBox1 = document.querySelector("#out_box1")

    if(oBox1.style.display=="block"){
        oBox1.style.display="none";
    }else{
        oBox1.style.display="block";
    }
})

const btn2 = document.querySelector("#btn2");

btn2.addEventListener("click", function(){
    const oBox2 = document.querySelector("#out_box2")

    if(oBox2.style.display=="block"){
        oBox2.style.display="none";
    }else{
        oBox2.style.display="block";
    }
})

const btn3 = document.querySelector("#btn3");

btn3.addEventListener("click", function(){
    const oBox3 = document.querySelector("#out_box3")

    if(oBox3.style.display=="block"){
        oBox3.style.display="none";
    }else{
        oBox3.style.display="block";
    }
})

const btn4 = document.querySelector("#btn4");

btn4.addEventListener("click", function(){
    const oBox4 = document.querySelector("#out_box4")

    if(oBox4.style.display=="block"){
        oBox4.style.display="none";
    }else{
        oBox4.style.display="block";
    }
})

const btn5 = document.querySelector("#btn5");

btn5.addEventListener("click", function(){
    const oBox5 = document.querySelector("#out_box5")

    if(oBox5.style.display=="block"){
        oBox5.style.display="none";
    }else{
        oBox5.style.display="block";
    }
})


