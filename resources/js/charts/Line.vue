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
            default: 'LineChart',
        },
        dataSet: {
            type: Array,
            require  : false,
            default: () => []
        },
        Calories: {
            type: Array,
            require  : false,
            default: () => []
        },
        Coins: {
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
            chart: null,
            maxSize: 0,
            }
    },
    methods: {
        // チャートの作成
        create_chart(){
            var LineChart = document.getElementById(this.id).getContext('2d');
             this.chart = new Chart(LineChart, {
                type: 'line',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: '合計',
                        backgroundColor: 'rgba(255, 74, 74, 0.3)',
                        borderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBorderWidth: 2,
                        pointRadius:5,
                        data: this.dataSet2
                    },{
                        label: '合計',
                        backgroundColor: 'rgba(255, 74, 74, 0.3)',
                        borderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBorderWidth: 2,
                        pointRadius:5,
                        data: this.dataSet
                    },{
                        label: '支援金',
                        backgroundColor: 'mintcream',
                        borderColor: 'mediumaquamarine',
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'mediumaquamarine',
                        pointBorderWidth: 2,
                        pointRadius:3,
                        data: this.Coins
                    },{
                        label: 'カロリーのチャート',
                        backgroundColor: 'mistyrose',
                        borderColor: 'tomato',
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'tomato',
                        pointBorderWidth: 2,
                        pointRadius:3,
                        data: this.Calories
                    }]
                },  
                // laberuの非表示
                options: { 
                    legend: {
                        display: false
                     }, 
                     scales: {
                        xAxes: [{
                            display: false,
                            stacked: false,
                            gridLines: {
                                display: false
                            },
                            barPercentage: 0.5
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: {
                                drawBorder: false
                            },
                            ticks: {
                                beginAtZero: true,
                                // max: this.maxSize
                                suggestedMax: this.maxSize,
                            }
                        }]
                    },
                      
                }
            });
        },
        setMaxsize(){
            var max =  Math.max(...this.dataSet)
            this.maxSize = max * 1.1
            console.log("最大値は000です",this.maxSize)
        }
    },
    watch: {
        labels: function(labels){
            console.log("BarChart")
            if(this.chart){this.chart.destroy()}
            this.setMaxsize()
            this.create_chart()
        }
    },
}
</script>

      