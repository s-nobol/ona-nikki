<template>
    <div>
       <!--帯グラフ-->
        <canvas :id="id" ></canvas>
    </div>
</template>
<style type="text/css">
.remon{
    background-color: green;
}
.apple{
    background-color: red;
}
</style>
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
        
        // 背景色
        dataBackgroundColor: {
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
            sexBackgroundColor: 'rgba(63, 55, 110, 0.1)'
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
                        backgroundColor: this.sexBackgroundColor,
                        // backgroundColor: 'rgba(255, 74, 74, 0.8)',
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
        
        // バックグランドの変更
        chengeColor(name){
            if(name==="location"){
                this.sexBackgroundColor = "mediumseagreen"
                return false
            }
            if(name==="age"){
                this.sexBackgroundColor = "rgba(255, 74, 74, 0.9)"
                return false
            }
            if(name==="category"){
                this.sexBackgroundColor = this.dataBackgroundColor
                return false
            }
        }
    },
    watch: {
        labels: function(labels){
            console.log("BarHorizontalChart")
            if(this.chart){this.chart.destroy()}
            
            
            if(this.id){
                this.chengeColor(this.id)
            }
            
            this.create_chart()
        }
    },
}
</script>

      