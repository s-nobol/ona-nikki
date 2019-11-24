<template>
    <div class="container">
       <!--リーダーチャートグラフ-->
       
       
        <canvas id="RadarChart" ></canvas>
       
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

            var RadarChart = document.getElementById('RadarChart').getContext('2d');
            var RadarChart = new Chart(RadarChart, {
                type: 'radar',
    
                data: {
                	labels: ["月曜", "火曜", "水曜", "木曜", "金曜", "土曜", "日曜"],
                		datasets: [{
                			label: "運動量",
                			backgroundColor: 'rgba(255, 74, 74, 0.9)',
                			pointBackgroundColor: 'rgba(255, 74, 74, 0.9)',
                			data: [40, 50, 60, 70, 80, 90, 100]
                		},]
                },  
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
