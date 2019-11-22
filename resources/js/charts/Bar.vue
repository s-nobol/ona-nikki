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
        labels: {
            type: Array,
            require  : false,
            default: () => []
        },
    },
    methods: {
        // チャートの作成
        create_chart(){

            var BarChart = document.getElementById('BarChart').getContext('2d');
            var BarChart1 = new Chart(BarChart, {
                type: 'bar',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: '月別集計',
                        borderColor: ['rgba(255, 74, 74, 0.9)'],
                        backgroundColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.dataSet
                    }]
                },  
                // laberuの非表示
                options: { 
                    legend: {
                        display: false
                     }, 
                     tooltips: {
                        enabled: false
                     },
                    scales: {                          //軸設定
                        // yAxes: [{                      //y軸設定
                        //     display: true,             //表示設定
                        //     ticks: {                      //最大値最小値設定
                        //         min: 0,                   //最小値
                        //         max: 50,                  //最大値
                        //         fontSize: 8,             //フォントサイズ
                        //         stepSize: 10               //軸間隔
                        //     },
                        // }],
                    },
                    // scales: {
                    //     xAxes: [{
                    //         display: false,
                    //         stacked: false,
                    //         gridLines: {
                    //             display: true
                    //         }
                    //     }],
                    //     yAxes: [{
                    //         display: false,
                    //         gridLines: {
                    //             drawBorder: false
                    //         }
                    //     }]
                    // },
                      
                }
            });
        },
    },
    watch: {
      dataSet: function(dataSet){
          this.create_chart()
        //   console.log("bar_chart",this.dataSet())
      }
    },
    mounted(){
        //   console.log("bar_chart",this.dataSet)
          console.log("bar_chart",this.labels)
          this.create_chart()
    }
}
</script>

      