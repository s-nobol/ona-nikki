<template>
    <div>
        <!--線グラフ-->
        <canvas id="Line_Chart" ></canvas>
    </div>
</template>

<script>
export default {
    props: {
        dataSet: {
            type: Array,
            require  : false,
            default: () => []
        },
        dataSet2: {
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

            var Line_Chart = document.getElementById('Line_Chart').getContext('2d');
             new Chart(Line_Chart, {
                type: 'line',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: '月別集計',
                        backgroundColor: 'rgba(255, 74, 74, 0.3)',
                        borderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBorderWidth: 2,
                        pointRadius:5,
                        data: this.dataSet2
                    },{
                        label: '月別集計',
                        backgroundColor: 'rgba(255, 74, 74, 0.3)',
                        borderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(255, 74, 74, 0.8)',
                        pointBorderWidth: 2,
                        pointRadius:5,
                        data: this.dataSet
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
            console.log("起動")
            this.create_chart()
        }
    }
}
</script>
