@extends('app')

@section('content')

<div>
    <!--<h2>マイページ</h2> -->
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
        <span class="chart__tab__item">グラフの種類: </span>
        <span class="chart__tab__item">月別</span>
        <span class="chart__tab__item">年間</span>
        <span class="chart__tab__item">全期間</span>
        <span class="chart__tab__item">折れ線</span>
    </div>
    <div>自分の記録とみんなの記録比較（折れ線グラフ）</div>
    <canvas id="bar_Chart"></canvas>
    
    <div class="w-75 m-auto">
    <div>グラフ項目（）</div>
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
    
    
    <!--ジャンル-->
    <div class="row">
        <div class="col-4">
            <div>ユーザーとみんなの比較（棒グラフ）</div>
        </div>
        <div class="col-4">

        </div>
        <div class="col-4">
            <div>ユーザーの消費カロリー</div>
        </div>
    </div>

    
    <!--ジャンル-->
    <div class="row">
        <div class="col-4">
            <h5>棒グラフ(利用比率時間　月ごと)</h5>
            <canvas id="bar_Chart2"></canvas>
            <div>比率　15％</div>
        </div>
        <div class="col-4">
            <h5>円形グラフ(カテゴリー　カテゴり一覧)</h5>
            <canvas id="pie_Chart2" ></canvas>
            <div>比率　15％</div>
        </div>
        <div class="col-4">
            <h5>棒グラフ(利用比率時間)</h5>
            <canvas id="bar_Chart3"></canvas>
            <div>比率　15％</div>
        </div>
    </div>
    

    
    <!--ジャンル-->
    <div class="row">
        <div class="col-6">
            <h5>円形グラフ(カテゴリー　カテゴり一覧)</h5>
            <canvas id="pie_Chart" ></canvas>
            <div>比率　15％</div>
        </div>
        <div class="col-6">
            <h5>円形グラフ(カテゴリー　カテゴり一覧)</h5>
            <div>利用頻度データ</div>
            <div>総合データ</div>
            <div>利用時間帯データ</div>
            <div></div>
            <div></div>
            <div>データ1</div>
            <div>データ1</div>
        </div>
    </div>
    
        <div>上位のデータ5件一覧</div>
    

    
    <div><img src="{{ asset('image/ona-nikki5.jpg') }}"></img></div>
    <!--多い時間帯-->
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
        
    
        <div id="app">
            <chart-vue></chart-vue>
        </div>
        
        <!-- body タグの最後に足す-->
        <script src=" {{ mix('js/app.js') }} "></script>
    
    <script>
    
        var bar_Chart = document.getElementById('bar_Chart').getContext('2d');
        var myChart = new Chart(bar_Chart, {
             type: 'line',
            data: {
              labels: ['8月1日', '8月2日', '8月3日', '8月4日', '8月5日', '8月6日', '8月7日','8月1日', '8月2日', '8月3日', '8月4日', '8月5日', '8月6日', '8月7日'],
              datasets: [
                {
                  label: 'てすと',
                  data: [35, 34, 37, 35, 34, 35, 34, 29, 35, 34, 37, 35, 34, 35, 34, 25],
                  borderColor: "rgba(255, 74, 74, 1)", 
                  backgroundColor: "rgba(0,0,0,0)"
                },
                {
                  label: 'ユーザー',
                  data: [35, 37,34, 35, 37, 35, 34, 35, 34, 30, 35, 34, 37, 35, 37, 24],
                  borderColor: "rgba(9, 224, 142, 0.5)",
                  backgroundColor: "rgba(0,0,0,0)"
                }
              ],
            },
   options: {
      responsive: true,
   }
        });  
        // パイチャート
        var bar_Chart2 = document.getElementById('bar_Chart2').getContext('2d');
        var myChart2 = new Chart(bar_Chart2, {
            type: "bar",
            data:{
                labels:["1月","2月","3月","4月","5月","6月","7月"],
                datasets:[{
                  data:[4,5,9,14,15,24,30],
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
    
        // パイチャート
        // var horizontalBar_Chart = document.getElementById('horizontalBar_Chart').getContext('2d');
        // var myChart = new Chart(horizontalBar_Chart, {
        //     type: 'horizontalBar',

        //     data: {
        //         labels: ['イチゴ', 'りんご', 'みかん', 'なし', 'ぶどう', 'キウイ',],
        //         datasets: [{
        //             label: 'My First dataset',
        //             backgroundColor: 'rgba(255, 74, 74, 0.1)',
                    
        //             data: [0, 10, 5, 2, 20, 30, 45]
        //         }]
        //     },
        // });
        // パイチャート
        var pie_Chart = document.getElementById('pie_Chart').getContext('2d');
        var myChart = new Chart(pie_Chart, {
              type: 'doughnut',

            data: {
                labels: ['イチゴ', 'りんご', 'みかん', 'なし', 'ぶどう', 'キウイ',],
                datasets: [{
                    label: 'My First dataset',
                      backgroundColor: [
                        "rgb(255, 74, 74)",
                        "rgb(54, 162, 235)",
                        "rgb(255, 205, 86)",
                        "rgb(54, 162, 235)",
                      ],
                    
                    data: [50, 10, 5, 2, 20, 30, 45]
                }],
            },
            options:{
                 legend: {
            display: false
         }
            }
        });
        var bar_Chart3 = document.getElementById("bar_Chart3").getContext('2d');
        var myChart = new Chart(bar_Chart3, {
          type: 'bar',
          data: {
            labels: ["M", "T", "W", "R", "F", "S", "S"],
            datasets: [{
              label: 'apples',
              backgroundColor: 'rgba(255, 74, 74, 0.1)',
              data: [12, 19, 3, 17, 28, 24, 7]
            }, {
              label: 'oranges'
              ,backgroundColor: 'rgba(55, 74, 74, 0.1)',
              data: [30, 29, 5, 5, 20, 3, 10]
            }]
          }
        });
    </script>
</div>
        
        
@endsection
