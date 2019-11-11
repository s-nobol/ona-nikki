@extends('app')

@section('content')

    
<!--メイン-->
<div>

    <!--<h2>log/year</h2>-->
    <h2>2019年</h2>
    <div>みんなのグラフなら上手くいく</div>
    <div>{{ $logs }}</div>
    
    
    <div>棒グラフ 一年間）</div>
    <canvas id="bar_Chart"></canvas>
    
    
    <div>棒グラフ　ひと月（月別1-12月まで）</div>
    <div class="logs">
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
        <a href="/logs/2019/1"class="logs__item card p-2">
            <img class="" src="{{ asset('image/chart.jpg') }}" alt="Generic placeholder image" style="width:100%">
            <div><span>0X月</span><div>てすとてすとてすとてすとてすとてすと</div></div>
        </a>
    </div>
    
    
    <style type="text/css">
        .logs__item{
            display: inline-block;
            width:24%;
        }
    </style>
    
    <script > 
    // パイチャート
        var bar_Chart2 = document.getElementById('bar_Chart').getContext('2d');
        var myChart2 = new Chart(bar_Chart2, {
            type: "bar",
            data:{
                labels:["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"],
                datasets:[{
                  data:[4,5,9,14,15,24,30,4,5,9,14,15,24,30],
                  backgroundColor: "rgba(255, 74, 74, 1)"
                },
                {
                  data:[0.4,0.5,0.9,1.4,1.5,2,4,3.0],
                  backgroundColor: "rgba(25, 24, 24, 0.5)"
                }]
                },
                options:{
                scales:{
                  xAxes:[{
                    stacked: true
                  }],
                  yAxes:[{
                    stacked: true
                  }]
                }
            }
        });
    </script>

</div>
        
        
<!--</div>-->
@endsection
