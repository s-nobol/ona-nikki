<template>
    <div >
        <!--ドーナツグラフ-->
        <canvas id="PieChart" ></canvas>
       
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

            var PieChart = document.getElementById('PieChart').getContext('2d');
            var PieChart = new Chart(PieChart, {
                type: 'pie',
    
                data: {
                    labels: this.labels,
                    datasets: [{
                        backgroundColor: this.sexBackgroundColor,
                        data: this.dataSetSex,
                        borderWidth: 1.1,
                        // borderAlign: 'inner',
                    }]
                }, 
                options: {  
                    // cutoutPercentage: this.borderWidth,
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
                this.sexBackgroundColor = ['tomato','dodgerblue']
            }
            
            
            this.create_chart()
        }
    },
}
</script>
