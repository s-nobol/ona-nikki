<template>
    <div class="container">
       <!--チャートを入力-->
       
       
        <!--<canvas id="Bar_Chart" ></canvas>-->
       <Bar :dataSet="count" />
    </div>
</template>

<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく


// import Bar from '../../charts/Bar.vue'
import Bar from '../charts/Bar.vue'
export default {
    components: { Bar },
    data(){
        return{
            count: [1,2],
            month: [],
        }
    },
    methods: {
        get_chart(){
            console.log("チャートの取得")
            axios.get(`api/logs/year/2018`, this.NoticeEditForm).then(response => {
              
                console.log(response);
                this.count = response.data.count
                this.month = response.data.month
                // this.create_chart()
            }).catch(err => {
                    alert(err)
            });
        },
        
        // チャートの作成
        create_chart(){

            var Bar_Chart = document.getElementById('Bar_Chart').getContext('2d');
            var myChart = new Chart(Bar_Chart, {
                type: 'bar',
    
                data: {
                    labels: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月', ],
                    datasets: [{
                        label: '月別集計',
                        backgroundColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.count
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
    created(){
        this.get_chart()
    }
}
</script>
