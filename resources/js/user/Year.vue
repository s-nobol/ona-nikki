<template>
    <div>
       
       
       <div class="card ">
       <!--チャートを入力-->
       <h5><b>year</b></h5>
           <h4>{{ year }} 年月別射精回数グラフ(自分のデータとみんなのデータを比較)</h4>
           <!--<img src="/image/chart.jpg"></img>-->
            
            <LineChart 
                :dataSet="month_data_count"
                :dataSet2="other_user_month_data_count"
                :labels="month_data_label"
            />
                    
            <!--後日検討-->
            <!--<div class="row">-->
            <!--    <div class="col-10">-->
            <!--    </div>-->
            <!--    <div class="col-2">-->
            <!--    </div>-->
            <!--</div>-->
       </div>
   
        <div class="row">
            <div class="card col-4 ">
            
                <div class="chart_title">
                    <span ><i class="fas fa-plus"></i></span>
                    <span>課金指数</span>
                    <span class="float-right"><i class="fas fa-minus-circle"></i></span>
                </div>
                
                <div class="chart_content">
                <Bar
                    :dataSet="time_data"
                    :labels="time_data_label"
                    />
                </div>
                    
            </div>
            <div class="card col-4">
            
                <div class="chart_title">
                    <span ><i class="fas fa-plus"></i></span>
                    <span>年間割合</span>
                    <span class="float-right"><i class="fas fa-minus-circle"></i></span>
                </div>
                
                <div class="chart_content">
                    <Doughnut 
                        :dataSet="month_data_label" class="Doughnut_Chart"
                    />
                </div>
                
            </div>
            <div class="card col-4">
            
                <div class="chart_title">
                    <span ><i class="fas fa-plus"></i></span>
                    <span>時間帯別割合</span>
                    <span class="float-right"><i class="fas fa-minus-circle"></i></span>
                </div>
                
                <div class="chart_content">
                    <Bar
                        id="time"
                        :dataSet="time_data"
                        :labels="time_data_label"
                        />
                </div>
            </div>
        </div>
       
       
       <!--今月と先月の比較-->
        <div class="row ">
            <div class="col-3 card StatusCard">
            
                <div class="StatusCard__title">
                    <span class="">最高射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>回</small></span>
                </div>
            </div>
            
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>最低射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>￥{{ msg }}<small>%</small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>合計消費カロリー</span>
                    <strong>{{ msg }}cal</strong>
                </div>
                <div class="StatusCard__content">
                    <small>15位</small><i class="fas fa-arrow-right "></i><small>8位</small>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>累計支援金額</span>
                    <strong>Lv.{{ msg }}</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>.Lv</small></span>
                </div>
            </div>
        </div>
        
        <div>
            <img src="/image/ona-nikki5.jpg"></img>
        </div>
       
    </div>
</template>
<style type="text/css">
    .Doughnut_Chart{
        /*width:500px;*/
    }
.chart_title{
    padding: 10px;
    background-color: #fafafa;
    color:gray;
}
.chart_content{
    padding: 10px;
}
</style>
<script>
import LineChart from '../charts/Line.vue'
import Bar from '../charts/Bar.vue'
import Doughnut from '../charts/Doughnut.vue'
export default {
    components: { LineChart,Bar,Doughnut , },
    props: {
         year: String,
    },
    data(){
        return{
            count: [],
            month: [],
            month_data_label:[],
            month_data_count:[],
            other_user_month_data_count: [],
            doughnut: [],
            time_data: [],
            time_data_label:[],
            msg: '150'
        }
    },
    methods: {
        get_chart(){
            console.log("チャートの取得")
            axios.get(`/api/mypage/logs/${this.year}`, ).then(response => {
              
                console.log(response);
                this.month_data_count = response.data.month_data_count
                this.month_data_label = response.data.month_data_label
                this.other_user_month_data_count = response.data.otherlogs
                this.time_data = response.data.time_data
                this.time_data_label = response.data.time_data_label
                // otherlogs
            })
        },
    },
    created(){
        this.get_chart()
    }
}
</script>
