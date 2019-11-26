<template>
    <div>
       <!--帯グラフ-->
        <canvas :id="id" ></canvas>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            require  : false,
            default: 'BarHorizontalChart',
        },
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
    data(){
        return{
            chart: null
            }
    },
    methods: {
        // チャートの作成
        create_chart(){
            var BarChart = document.getElementById(this.id).getContext('2d');
            this.chart = new Chart(BarChart, {
                type: 'horizontalBar',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: '月別集計',
                        borderColor: 'rgba(255, 74, 74, 0.8)',
                        backgroundColor: 'rgba(255, 74, 74, 0.8)',
                        data: this.dataSet
                    }]
                },  
                // laberuの非表示
                options: { 
                    legend: {
                        display: false
                     }, 
                     tooltips: {
                        enabled: true
                     },
                    scales: {
                        xAxes: [{
                            display: false,
                            stacked: false,
                            gridLines: {
                                display: true
                            }, 
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                color:'white',
                                offsetGridLines: true,
                                // drawBorder: false
                            }
                        }]
                    },
                      
                }
            });
        },
    },
    watch: {
        labels: function(labels){
            console.log("BarHorizontalChart")
            if(this.chart){this.chart.destroy()}
            this.create_chart()
        }
    },
}
</script>

      