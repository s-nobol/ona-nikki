<template>
<div class="card about__continer__bg">



    <!--<h2 class="about__title mb-5"><b>性別について </b></h2>-->
                
    <h3 class="about__title">
        <b>性別ごとの利用者グラフ</b>
    </h3>
    
    
    <div class="about__continer">
        <div class="row  mb-5">
            <div class="col-12 p-0 m-0">
                <Pie
                    :dataSetSex="sex_data"
                    :borderWidth="10"
                    :labels="sex_data_label"
                    />
            </div>
        </div>
        
        <div class="w-lg-50 m-auto ">
            <div class="media">
                <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                <div class="media-body">
                    <span>
                    <h5 class="mt-0">性別について</h5>
                    <!--人数比率-->
                    オナ日記のデータでは、{{ sex_data_label[0] }}性の賢者様{{ sex_data[0] }}人、
                    {{ sex_data_label[1] }}性の賢者様{{ sex_data[1]  }}人
                    と比較的{{ sex_data_label[0] }}性の賢者様による利用が多い結果となりました。
                    
                    </span>
                </div>
            </div>
        </div>
        
        
        <!--性別ごとの利用割合（いらない？）-->
        <h3 class="mt-5 about__title">
            <b>男女別利用者</b>
        </h3>
        
        <div class="row mb-sm-5">
           <div class="col-sm-6">
               <!--男*年齢横グラフ-->
                <canvas id="man" ></canvas>
           </div>
           <div class="col-sm-6">
               <!--女*年齢横棒グラフ-->
                <canvas id="woman" ></canvas>
           </div>
        </div>
        
        
        <!--年齢別の利用すいい棒グラフ-->
        <div class="row ">
            <div class="w-lg-50 m-auto">
                <h3 class="mt-5 about__title">
                    <b>年齢ごとの利用者グラフ</b>
                </h3>
                <bar 
                    backgroundColor="gainsboro"
                    :dataTime="age_data"
                    :labels="age_data_label"
                />
            </div>
        </div>
        
        <div class="w-lg-50 m-auto">
            <div class="media">
                <div class="media-body">
                    <span>
                    <h5 class="mt-0">年齢について</h5>性別ごとの利用比率を見ると男性の賢者様は、{{ man_data_max }}が多く、
                    女性の賢者様は、{{ woman_data_max }}の利用人者が多い結果となりました。<br>
                    
                    また、年齢ごとの比較によると{{ age_data_max  }}の利用人数が一番多く、
                    {{ age_data_mini }}の利用者が最も少ない結果となりました。
                    </span>
                </div>
                <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
            </div>
        </div>
        
    </div>
</div>
</template>
<script>
import Pie from '../charts/Pie.vue'
import Doughnut from '../charts/Doughnut.vue'
import Bar from '../charts/Bar.vue'
export default {
    components: { Doughnut, Bar,Pie },
    data(){
        return{
            
            sex_data:[],
            sex_data_label:[],
            
            man_data: [],
            man_data_label: [],
            man_data_max: null,
            
            woman_data: [],
            woman_data_label: [],
            woman_data_max: null,
            
            age_label: [ '10代','20代','30代','40代','50代', '60代', 'その他'],
            // age_label: [],
            
            age_data: [],
            age_data_label: [],
            age_data_max: null,
            age_data_mini: null,
        }
    },
    methods: {
        get_data(){
            axios.get(`/api/sex`).then(response => {
                console.log('sex',response);
                this.sex_data = response.data.data
                this.sex_data_label = response.data.data_label
                
                this.man_data = response.data.man_data
                this.man_data_label = response.data.man_data_label
                this.man_data_max = this.get_max_data_label(this.man_data, this.man_data_label )
                
                this.woman_data = response.data.woman_data
                this.woman_data_label = response.data.woman_data_label
                this.woman_data_max = this.get_max_data_label(this.woman_data, this.woman_data_label )
                
                this.age_data = response.data.age_data
                this.age_data_label = response.data.age_data_label
                this.age_data_max = this.get_max_data_label(this.age_data, this.age_data_label )
                this.age_data_mini = this.get_mini_data_label(this.age_data, this.age_data_label )
                
                // this.pie_chart()
                this.man_chart()
                this.woman_chart()
            })
        },
        
        // pie_chart(){
        //     var PieChart = document.getElementById('pie').getContext('2d');
        //      var chart = new Chart(PieChart, {
        //         type: 'pie',
    
        //         data: {
        //             labels: this.data_label,
        //             datasets: [{
        //                 // label: '月別集計',
        //                 borderColor: ['white',],
        //                 backgroundColor:  ['deepskyblue',  'tomato', 'rgba(63, 55, 110, 0.1)',],
        //                 data: this.data
        //             }]
        //         },  
        //         options: {
        //              legend: {
        //                 display: false
        //              }
        //         }
        //     });
        // },
        man_chart(){
            var ManChart = document.getElementById('man').getContext('2d');
             var chart = new Chart(ManChart, {
                type: 'horizontalBar',
    
                data: {
                    labels: this.age_label,
                    datasets: [{
                        // label: this.age_label,
                        borderColor: ['white',],
                        backgroundColor:  'deepskyblue',
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
                        backgroundColor:  'tomato',
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
        
        // グラフで一番多い数を検出する
        get_max_data(data){
            return Math.max.apply(null, data);
        },
         // グラフで一番多い数を検出する
        get_max_data_label(data, data_label){
            var max = 0
            var max_i = 0
            for(var i = 0; i< data.length; i++){
                if(data[i]>max){
                    max = data[i]
                    max_i= i
                }
            }
            return data_label[max_i];
        },
        // 最低値
        get_mini_data_label(data, data_label){
            var mini = 0
            var mini_i = 0
            for(var i = 0; i< data.length; i++){
                if(data_label[0]){
                    mini = data_label[0]
                }
                if(data[i]>mini){
                    mini = data[i]
                    mini_i = i
                }
            }
            return data_label[mini_i];
        }
    },
    
    
    created(){
        this.get_data()
    }
}
</script>