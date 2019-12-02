<template>
    <div>
        <!--棒グラフと折れ線グラフ-->
        <canvas id="BarLine_Chart" ></canvas>
    </div>
</template>

<script>

export default {
    props: {
        labels: {
            type: Array,
            require  : false,
            default: () => []
        },
        barDataSet: {
            type: Array,
            require  : false,
            default: () => []
        },
        lineDataSet: {
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

            var BarLine_Chart = document.getElementById('BarLine_Chart').getContext('2d');
            this.chart = new Chart(BarLine_Chart, {
                type: 'bar',
    
                data: {
                    labels: this.labels,
                    datasets: [{ 
                        type: 'line',
                        label: '月別集計',
                        backgroundColor: 'rgba(255, 74, 74, 0.1)', 
                        pointBackgroundColor: "rgba(192,192,192,0.9)",
                        pointBorderColor: "rgba(75,192,192,1)",
                        borderColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.lineDataSet
                    },{ 
                        type: 'bar',
                        label: '月別集計',
                        backgroundColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.barDataSet
                    }]
                },
                  options: { 
                    legend: {
                        display: false
                     }, 
                    scales: {
                        xAxes: [{
                            display: true,
                            stacked: false,
                            gridLines: {
                                display: false
                            },
                            barPercentage: 0.5
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                drawBorder: false
                            }
                        }]
                    },
                      
                }
            });
        },
    },
    watch: {
        labels: function(labels){
            console.log("BarLine")
            if(this.chart){this.chart.destroy()}
            this.create_chart()
        }
    }
}
</script>
