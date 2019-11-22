<template>
    <div>
       <!--Yearページ専用のChart-->
        <canvas  :id="month" ></canvas>
       
    </div>
</template>

<script>
export default {
    props: {
        month: {
            type: Number,
            require  : true,
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
    methods: {
        // チャートの作成
        create_chart(){

            var BarChart = document.getElementById(`${this.month}`).getContext('2d');
            var BarChart1 = new Chart(BarChart, {
                type: 'line',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        borderColor: ['rgba(255, 74, 74, 0.9)'],
                        backgroundColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.dataSet
                    }]
                },  
                // laberuの非表示
                options: { 
                    legend: {
                        display: false
                     }, 
                     tooltips: {
                        enabled: false
                     },
                    scales: {
                        xAxes: [{
                            display: false,
                            stacked: false,
                            gridLines: {
                                display: true
                            }
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: {
                                drawBorder: false
                            }
                        }]
                    },
                      
                }
            });
        },
    },
    // watch: {
    //   dataSet: function(dataSet){
    //       this.create_chart()
    //   }
    // },
    mounted(){
        //   console.log("bar_chart",this.labels)
          this.create_chart()
    }
}
</script>

      