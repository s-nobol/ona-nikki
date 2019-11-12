<template>
    <div>
       <!--バブルチャート-->
       
        <canvas id="BubbleChart" ></canvas>
       
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
            var BubbleChart = document.getElementById('BubbleChart').getContext('2d');
            var BubbleChart = new Chart(BubbleChart, {
                type: 'bubble',
                data: {
                    datasets: [{
                        data: [{"x":10 ,"y":17, "r":30} ],
                        backgroundColor:[ "rgb(141,163,223)" ],
                    }]
                },
                // サンプルデータ
                // data: {
                //     datasets: [{
                //         data: [{"x":10 ,"y":10, "r":30} ,],
                //         backgroundColor:[ "rgb(141,163,223)" ],
                //     },{
                //         data: [{"x":18 ,"y":50, "r":10} ,],
                //         backgroundColor:[ "rgb(41,63,123)" ],
                //     },{
                //         data: [{"x":15 ,"y":20, "r":30} ,],
                //         backgroundColor:[ "rgb(14,63,23)" ],
                //     },{
                //         data: [{"x":25 ,"y":30, "r":50} ,],
                //         backgroundColor:[ "rgb(14,63,23)" ],
                //     },{
                //         data: [{"x":85 ,"y":90, "r":30} ,],
                //         backgroundColor:[ "rgb(14,63,23)" ],
                //     }]
                // },
                
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
