<template>
    <div>
       <!--帯グラフ-->
       
       
        <canvas id="BarChart" ></canvas>
       
    </div>
</template>

<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクトリに素材ごとのチャートをいれておく


export default {
    props: {
        dataSet: {
            type: Array,
            require  : false,
            default: () => []
          },
         loading: Boolean,
    },
    methods: {
        // チャートの作成
        create_chart(){

            var BarChart = document.getElementById('BarChart').getContext('2d');
            var BarChart = new Chart(BarChart, {
                type: 'bar',
    
                data: {
                    labels: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月', ],
                    datasets: [{
                        label: '月別集計',
                        borderColor: ['rgba(255, 74, 74, 0.9)'],
                        backgroundColor: 'rgba(255, 74, 74, 0.4)',
                        data: this.dataSet
                    }]
                },  
                options: {    
                    scales: {                          //軸設定
                        yAxes: [{                      //y軸設定
                            display: true,             //表示設定
                            ticks: {                      //最大値最小値設定
                                min: 0,                   //最小値
                                max: 50,                  //最大値
                                fontSize: 8,             //フォントサイズ
                                stepSize: 10               //軸間隔
                            },
                        }],
                    }
                }
            });
        },
    },
    watch: {
      dataSet: function(dataSet){
          this.create_chart()
      }
    }
}
</script>
