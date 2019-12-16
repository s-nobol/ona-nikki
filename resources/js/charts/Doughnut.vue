<template>
    <div >
        <!--ドーナツグラフ-->
        <canvas :id="id" ></canvas>
       
    </div>
</template>

<script>

export default {
    props: {
        id: {
            type: String,
            require  : false,
            default: 'DoughnutChart',
        },
        // エラーが出るので配列は一行まで
        dataSet: {
            type: Array,
            require  : false,
            default: () => []
        },
        dataSetSex: {
            type: Array,
            require  : false,
            default: () => []
        },
        labels: {
            type: Array,
            require  : false,
            default: () => []
        },
        
        //設定
        borderWidth: {
            type: Number,
            require  : false,
            default: 90
        },
    },
    data(){
        return{
            sexBackgroundColor: [ 'deepskyblue','tomato']
        }
    },
    methods: {
        // チャートの作成
        create_chart(){

            var DoughnutChart =  document.getElementById(this.id).getContext('2d');
             this.chart = new Chart(DoughnutChart, {
                type: 'doughnut',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        backgroundColor: ['rgba(255, 74, 74, 0.9)', 'rgba(220, 220, 220, 0.9)' ],
                        data: this.dataSet,
                        borderWidth: 1.1,
                        // borderAlign: 'inner',
                    },{
                        backgroundColor: this.sexBackgroundColor,
                        data: this.dataSetSex,
                        borderWidth: 1.8,
                        // borderAlign: 'inner',
                    }]
                }, 
                options: {  
                    cutoutPercentage: this.borderWidth,
                    legend: {
                        display: false
                    }
                }
            });
        },
    },
    watch: {
        labels: function(labels){
        
            //   もしSEXChartの時
            if(this.labels && this.labels[0] === "女"){
                this.sexBackgroundColor = ['tomato','deepskyblue']
            }
            
            if(this.chart){this.chart.destroy()}
            
            this.create_chart()
        }
    },
}
</script>
