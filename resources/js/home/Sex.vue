<template>
<div class="card about__continer__bg">



    <!--<h2 class="about__title mb-5"><b>性別について </b></h2>-->
                
    <h3 class="about__title">
        <b>性別ごとの利用者グラフ</b>
    </h3>
    
    
    <div class="about__continer">
        <div class="row  mb-5">
                <canvas id="pie" ></canvas>
        </div>
        
        <div class="w-50 m-auto ">
            <div class="media">
                <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                <div class="media-body">
                    <span>
                    <h5 class="mt-0">性別について</h5>
                    テストテストテストテストテストテストテスト
                    テストテストテストテストテストテストテストテスト
                    テストテストテストテストテストテストテストテスト
                    テストテストテストテストテスト
                    </span>
                </div>
            </div>
        </div>
        
        
        <!--性別ごとの利用割合（いらない？）-->
        <h3 class="mt-5 about__title">
            <b>年代ごとの利用者グラフ</b>
        </h3>
        
        <div class="row mb-5">
           <div class="col-6">
               <!--男*年齢横グラフ-->
                <canvas id="man" ></canvas>
           </div>
           <div class="col-6">
               <!--女*年齢横棒グラフ-->
                <canvas id="woman" ></canvas>
           </div>
        </div>
        
        
        <!--年齢別の利用すいい棒グラフ-->
        <div class="row ">
            <div class="col-6 m-auto">
                    
               <bar 
               :dataSet="age_data"
               :labels="age_data"
               />
            </div>
        </div>
        
        <div class="w-50 m-auto">
            <div class="media">
                <div class="media-body">
                    <span>
                    <h5 class="mt-0">年齢について</h5>
                    テストテストテストテストテストテストテスト
                    テストテストテストテストテストテストテストテスト
                    テストテストテストテストテストテストテストテスト
                    テストテストテストテストテスト
                    </span>
                </div>
                <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
            </div>
        </div>
        
    </div>
</div>
</template>
<style type="text/css">
    .myimage{
        width: 100px;
    }
</style>
<script>
import Bar from '../charts/Bar.vue'
export default {
    components: { Bar, },
    data(){
        return{
            data:[],
            data_label:[],
            
            man_data: [],
            man_data_label: [],
            
            woman_data: [],
            woman_data_label: [],
            
            age_label: [ '10代','20代','30代','40代','50代', '60代', 'その他'],
            
            age_data: [],
            age_data_label: []
        }
    },
    methods: {
        get_data(){
            axios.get(`/api/sex`).then(response => {
                console.log(response);
                this.data = response.data.data
                this.data_label = response.data.data_label
                
                this.man_data = response.data.man_data
                this.man_data_label = response.data.man_data_label
                this.woman_data = response.data.woman_data
                this.woman_data_label = response.data.woman_data_label
                
                this.age_data = response.data.age_data
                this.age_data_label = response.data.age_label
                
                this.pie_chart()
                this.man_chart()
                this.woman_chart()
            })
        },
        
        pie_chart(){
            var PieChart = document.getElementById('pie').getContext('2d');
             var chart = new Chart(PieChart, {
                type: 'pie',
    
                data: {
                    labels: this.data_label,
                    datasets: [{
                        // label: '月別集計',
                        borderColor: ['white',],
                        backgroundColor:  ['deepskyblue',  'tomato', 'rgba(63, 55, 110, 0.1)',],
                        data: this.data
                    }]
                },  
                options: {
                     legend: {
                        display: false
                     }
                }
            });
        },
        man_chart(){
            var ManChart = document.getElementById('man').getContext('2d');
             var chart = new Chart(ManChart, {
                type: 'horizontalBar',
    
                data: {
                    labels: this.age_label,
                    datasets: [{
                        // label: this.age_label,
                        borderColor: ['white',],
                        backgroundColor:  ['deepskyblue',  'tomato', 'rgba(63, 55, 110, 0.1)',],
                        data: this.man_data
                    }]
                },  
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                        		ticks: {
                                reverse: true,
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        woman_chart(){
            var WomanChart = document.getElementById('woman').getContext('2d');
             var womanchart = new Chart(WomanChart, {
                type: 'horizontalBar',
    
                data: {
                    labels: this.age_label,
                    datasets: [{
                        // label: this.age_label,
                        borderColor: ['white',],
                        backgroundColor:  ['deepskyblue',  'tomato', 'rgba(63, 55, 110, 0.1)',],
                        data: this.woman_data
                    }]
                },  
                options: {
                    legend: {
                        display: false
                    },
                }
            });
        },
    },
    
    
    created(){
        this.get_data()
    }
}
</script>