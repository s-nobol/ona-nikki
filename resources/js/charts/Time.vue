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
            default: 'BarChart',
        },
        dataSet: {
            type: Array,
            require  : false,
            default: () => []
        },
        dataTime: {
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
            backgroundColor:[
                
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.8)',
                'rgba(255, 226, 111, 0.9)',
                'rgba(255, 226, 111, 0.9)',
                'rgba(255, 226, 111, 0.8)',
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.7)',
                'rgba(255, 226, 111, 0.7)',
                
                
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.8)',
                'rgba(2, 77, 179, 0.9)',
                'rgba(2, 77, 179, 0.9)',
                'rgba(2, 77, 179, 0.8)',
                'rgba(2, 77, 179, 0.7)',
                'rgba(2, 77, 179, 0.7)',
            ]
        }
    },
    methods: {
        // チャートの作成
        create_chart(){
            var BarChart = document.getElementById(this.id).getContext('2d');
             this.chart = new Chart(BarChart, {
                type: 'bar',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: '',
                        borderColor: 'white',
                        backgroundColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.dataSet
                    },{
                        label: '時間別',
                        borderColor: ['rgba(63, 55, 110, 0.9)'],
                        // backgroundColor: 'rgba(63, 55, 110,  0.9)',
                        backgroundColor: this.backgroundColor,
                        data: this.dataTime
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
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: {
                                drawBorder: false
                            },
                            ticks: {
                                beginAtZero: true,
                            }
                        }]
                    },
                      
                }
            });
        },
    },
    watch: {
        labels: function(labels){
            console.log("TimeChart")
            if(this.chart){this.chart.destroy()}
            this.create_chart()
        }
    },
}
</script>

       <!--backgroundColor:[-->
       <!--         'rgba(255, 226, 111, 0.9)',-->
       <!--         'rgba(255, 226, 111, 0.9)',-->
       <!--         'rgba(255, 226, 111, 0.9)',-->
       <!--         'rgba(255, 226, 111, 0.9)',-->
       <!--         'rgba(255, 226, 111, 0.9)',-->
                
       <!--         'rgba(208, 189, 118, 0.9)',-->
       <!--         'rgba(208, 189, 118, 0.9)',-->
       <!--         'rgba(208, 189, 118, 0.9)',-->
       <!--         'rgba(208, 189, 118, 0.9)',-->
       <!--         'rgba(208, 189, 118, 0.9)',-->
                
       <!--         'rgba(138, 142, 142, 0.9)',-->
       <!--         'rgba(138, 142, 142, 0.9)',-->
       <!--         'rgba(138, 142, 142, 0.9)',-->
       <!--         'rgba(138, 142, 142, 0.9)',-->
       <!--         'rgba(138, 142, 142, 0.9)',-->
                
       <!--         'rgba(68, 108, 162, 0.9)',-->
       <!--         'rgba(68, 108, 162, 0.9)',-->
       <!--         'rgba(68, 108, 162, 0.9)',-->
       <!--         'rgba(68, 108, 162, 0.9)',-->
       <!--         'rgba(68, 108, 162, 0.9)',-->
                
       <!--         'rgba(2, 77, 179, 0.9)',-->
       <!--         'rgba(2, 77, 179, 0.9)',-->
       <!--         'rgba(2, 77, 179, 0.9)',-->
       <!--         'rgba(2, 77, 179, 0.9)',-->
       <!--         'rgba(2, 77, 179, 0.9)',-->
       <!--     ]-->