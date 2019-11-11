@extends('app')

@section('content')

    
<!--メイン-->
<div>
    
    <h2>{{ $month }}月 log/month</h2>
    
    <div>みんなのグラフなら上手くいく</div>
    <div>{{ $logs }}</div>
    <div>{{ $test_logs }}</div>
    <!--<h2>マイページ</h2> -->
      <div>みんなの平均と比較できるようにする</div>
    <style type="text/css">
    .data_list{
        list-style: none;
        font-size:0px;
        padding: 0px;
        margin: 0px;
        border-bottom: solid 1px gainsboro;
    }
        .data_list_item{
        /*border: solid 1px gainsboro;*/
            display: inline-block;
            position:relative;
            
            width:150px;
            height: 100px;
        }
        .data_list_item_title{
            font-size:15px;
            font-weight: bold;
            
        }
        .data_list_item_title small{
            font-size:10px;
            color:gray;
        }
        .data_list_item_content{
            position:absolute;
            bottom: 15px;
            right:15px;
            font-size:35px;
            font-weight: bold;
        }
        .data_list_item_content small{
            font-size:18px;
            /*font-weight: bold;*/
            }
            .media-body p{
            font-size:17px;
            }
    </style>
    
    <!--チャート-->
    
    
    <!--過去一か月の射精回数（一年）-->
    <!--<canvas id="bar_Chart"></canvas>-->
    
    <!--月ごとの射精回数（一年）-->
    
    <div class="chart__tab">
        <span class="chart__tab__item">月別</span>
        <span class="chart__tab__item">年間</span>
        <span class="chart__tab__item">全期間</span>
        <span class="chart__tab__item">折れ線</span>
    </div>
    <canvas id="bar_Chart"></canvas>
      <div>
        <ul class="data_list ">
            <li class="data_list_item">
                <strong class="data_list_item_title">総合射回数</strong>
                <strong class="data_list_item_content">875<small>回</small></strong>
            </li>
            <li class="data_list_item">
                <strong class="data_list_item_title">本日の射回数</strong>
                <strong class="data_list_item_content">5<small>回</small></strong>
            </li>
            <li class="data_list_item">
                <strong class="data_list_item_title">平均精回数</strong>
                <strong class="data_list_item_content">85<small>.ave</small></strong>
            </li>
            <li class="data_list_item">
                <strong class="data_list_item_title">合計支援金<small>※1</small></strong>
                <strong class="data_list_item_content">152<small>円</small></strong>
            </li>
            <li class="data_list_item">
                <strong class="data_list_item_title">消費カロリー<small>※2</small></strong>
                <strong class="data_list_item_content">25<small>Cal</small></strong>
            </li>
        </ul>
        <!--<span>総合射回数</span>-->
        <!--<span>本日の射回数</span>-->
        <!--<span>平均精回数</span>-->
        <!--<span>合計支援金</span>-->
        <!--<span>消費カロリー</span>-->
    </div>
    <style>
        .chart__tab{
            text-align: right;
            padding: 5px;
        }
        .chart__tab__item{
            cursor:pointer;
        }
    </style>
    
    
    <!--データ一覧-->
    <div>
    <h3>11月のログ一覧</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>日付</td>
                <td>コメントコメント</td>
                <td>カテゴリー</td>
                <td><a href="/logs/1/edit" class="btn btn-success">編集</a>
                <a href="/logs/1" class="btn btn-danger">削除</a>
                </td>
                </tr>
            <tr>
            <tr>
                <th scope="row">1</th>
                <td>日付</td>
                <td>コメントコメント</td>
                <td>カテゴリー</td>
                <td><a href="/logs/1/edit" class="btn btn-success">編集</a>
                <a href="/logs/1" class="btn btn-danger">削除</a>
                </td>
                </tr>
            <tr>
            <tr>
                <th scope="row">1</th>
                <td>日付</td>
                <td>コメントコメント</td>
                <td>カテゴリー</td>
                <td><a href="/logs/1/edit" class="btn btn-success">編集</a>
                <a href="/logs/1" class="btn btn-danger">削除</a>
                </td>
                </tr>
            <tr>
            <tr>
                <th scope="row">1</th>
                <td>日付</td>
                <td>コメントコメント</td>
                <td>カテゴリー</td>
                <td><a href="/logs/1/edit" class="btn btn-success">編集</a>
                <a href="/logs/1" class="btn btn-danger">削除</a>
                </td>
                </tr>
            <tr>
        </tbody>
    </table>
    
    </div>
    
    
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
    
    

     </script>
     
     
     
     
        <!--説明-->
        <div class="w-75 m-auto pt-5">
            <div class="media">
                <div class="media-body card">
                    <h5 class="mt-0 mb-1"><b>今月の射回数</b></h5>
                    <p>今月のてすと様の射回数は、***252**　となっております。先月の**158***回数と比較しておよそ***15％***　増加いたしました。
                   また、平均射O回数は、****558***となっており、先月の**158***回数と比較しておよそ***15％***　増加いたしました。</p>
                </div>
                <img class="ml-3" src="{{ asset('image/chara.png') }}" alt="Generic placeholder image" style="width:150px;">
            </div>

        </div>
    
    
    >
</div>
        
        
<!--</div>-->
@endsection
