@extends('app')

@section('content')

<div>
        <!--メイン-->
            <div  class="containerss">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d47574.00857717284!2d139.71828551023023!3d35.64759556085902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601889a07930e2f9%3A0x62e41ee20b961991!2z6Iqd5rWm5bel5qWt5aSn5a2mIOixiua0suOCreODo-ODs-ODkeOCuQ!5e0!3m2!1sja!2sjp!4v1572866344134!5m2!1sja!2sjp" 
                width="100%" height="550" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <div class="row">
                <div class="col-4">
                    <div>北海道</div>
                    <div>青森　秋田　岩手　福島</div>
                    <div>青森　秋田　岩手　福島</div>
                </div>
                <div class="col-4">
                    <div>西日本</div>
                    <div>青森　秋田　岩手　福島</div>
                    <div>青森　秋田　岩手　福島</div>
                </div>
                <div class="col-4">
                    <div>四国　九州</div>
                    <div>青森　秋田　岩手　福島</div>
                    <div>青森　秋田　岩手　福島</div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card p-2 ">
                        <h5><b>最高回数</b></h5>
                        <h4 class="text-right"><b>152</b></h4>
                    </div>
                </div> 
                <div class="col-4">
                    <div class="card p-2">
                        <h5><b>最高回数</b></h5>
                        <h4 class="text-right"><b>78</b></h4>
                    </div>
                </div> 
                <div class="col-4">
                    <div class="card p-2">
                        <h5><b>最高回数</b></h5>
                        <h4 class="text-right"><b>2</b></h4>
                    </div>
                </div> 
            </div>
            <div class="row mt-2">
                <div class="col-4">
                    <div class="card p-2">
                        <h5><b>最高回数</b></h5>
                        <h4 class="text-right"><b>152</b></h4>
                    </div>
                </div> 
                <div class="col-4">
                    <div class="card p-2">
                        <h5><b>最高回数</b></h5>
                        <h4 class="text-right"><b>78</b></h4>
                    </div>
                </div> 
                <div class="col-4">
                    <div class="card p-2">
                        <h5><b>最高回数</b></h5>
                        <h4 class="text-right"><b>2</b></h4>
                    </div>
                </div> 
            </div>
    
            <div class="row mt-3">
                <div class="col-6">
                    <h4>利用が多い時間帯</h4>
                </div>
                <div class="col-6">
                    <h4>男女比率</h4>
                </div>
                
            </div>
  
            <div class="row">
                <div class="col-6">
                    <canvas id="horizontalBar_Chart"></canvas>    
                
                </div>
                <div class="col-6">
                    <canvas id="pie_Chart"></canvas>    
                </div>
            </div>
            
                
    
            <div>
                <h4>一日ごとの集計</h4>
                <canvas id="bar_Chart"></canvas>
                <!--<img src="{{ asset('image/ona-nikki2.jpg') }}" style="width:100%;"></img>-->
            </div>
            
            
            
            
            
            <div class="media">
                <div class="media-body card">
                    <h5 class="mt-0 mb-1">Media object</h5>
                    本日もお勤めご苦労様でした
                </div>
                <img class="ml-3" src="{{ asset('image/chara.png') }}" alt="Generic placeholder image" style="width:150px;">
            </div>
            
    <!--多い時間帯-->
    
    
    
    
    　　　　　　　　<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script>
    
        var bar_Chart = document.getElementById('bar_Chart').getContext('2d');
        var myChart = new Chart(bar_Chart, {
            type: 'bar',
            data: {
                labels: ['2018/01/01', '2018/01/02', '2018/01/03', '2018/01/04', '2018/01/05', '2018/01/06', '2018/01/07'],
                datasets: [{
                    label: '平均回数',
                    type: "line",
                    fill: false,
                    data: [10000, 11000, 15000, 12000, 9000, 12000, 13000],
                    borderColor: "rgba(255, 74, 74, 0.4)",
                    yAxisID: "y-axis-1",
                },  {
                    label: '月別回数',
                    data: [22, 23, 10, 15, 40, 35, 30],
                    backgroundColor: "rgba(255, 74, 74, 0.1)",
                    borderColor: "rgba(255, 74, 74, 0.8)",
                    yAxisID: "y-axis-2",
                }]
            },
            options: {
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                },
                responsive: true,
                scales: {
                    yAxes: [{
                        id: "y-axis-1",
                        type: "linear",
                        position: "left",
                        ticks: {
                            max: 15000,
                            min: 0,
                            stepSize: 1000
                        },
                    }, {
                        id: "y-axis-2",
                        type: "linear",
                        position: "right",
                        ticks: {
                            max: 200,
                            min: 0,
                            stepSize: 5
                        },
                        gridLines: {
                            drawOnChartArea: false,
                        },
                    }],
                },
            }
        });  
    
    
        // パイチャート
        var horizontalBar_Chart = document.getElementById('horizontalBar_Chart').getContext('2d');
        var myChart = new Chart(horizontalBar_Chart, {
            type: 'bar',

            data: {
                labels: ['イチゴ', 'りんご', 'みかん', 'なし', 'ぶどう', 'キウイ',],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgba(255, 74, 74, 0.1)',
                    
                    data: [0, 10, 5, 2, 20, 30, 45]
                }]
            },
        });
        // パイチャート
        var pie_Chart = document.getElementById('pie_Chart').getContext('2d');
        var myChart = new Chart(pie_Chart, {
            type: 'pie',

            data: {
                labels: ['イチゴ', 'りんご', 'みかん', 'なし', 'ぶどう', 'キウイ',],
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgba(255, 74, 74, 0.1)',
                    borderColor: "rgba(255, 74, 74, 0.4)",
                    
                    data: [0, 10, 5, 2, 20, 30, 45]
                }]
            },
        });
    </script>
            

</div>


@endsection
