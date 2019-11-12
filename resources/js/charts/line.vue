<template>
    <div>
       <!--線グラフ-->
       
       
        <canvas id="Bar_Chart" ></canvas>
       
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
    },
    methods: {
        // チャートの作成
        create_chart(){

            var Bar_Chart = document.getElementById('Bar_Chart').getContext('2d');
            var myChart = new Chart(Bar_Chart, {
                type: 'bar',
    
                data: {
                    labels: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月', ],
                    datasets: [{
                        label: '月別集計',
                        backgroundColor: 'rgba(255, 74, 74, 0.9)',
                        data: this.dataSet
                    }]
                },
            });
        },
    },
    watch: {
        dataSet: function(dataSet){
            this.create_chart()
        }
    }
}
</script>
