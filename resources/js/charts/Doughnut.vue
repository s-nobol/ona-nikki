<template>
    <div>
        <!--ドーナツグラフ-->
        <canvas id="DoughnutChart" ></canvas>
       
    </div>
</template>

<script>

export default {
    props: {
        // エラーが出るので配列は一行まで
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

            var DoughnutChart = document.getElementById('DoughnutChart').getContext('2d');
            var DoughnutChart = new Chart(DoughnutChart, {
                type: 'doughnut',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        backgroundColor: ['rgba(255, 74, 74, 0.9)', 'rgba(220, 220, 220, 0.9)' ],
                        // backgroundColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.dataSet,
                        borderWidth: 1.1,
                        // borderAlign: 'inner',
                    }]
                }, 
                options: {  
                    cutoutPercentage: 90,
                    legend: {
                        display: false
                    }
                }
            });
        },
    },
    watch: {
      labels: function(labels){
          this.create_chart()
      }
    },
}
</script>
