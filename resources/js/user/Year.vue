<template>
    <div>
       
       
       <!--<div class="card ">-->
       <!--チャートを入力-->
       <!--<h5><b>year</b></h5>-->
       <!--    <h4>{{ year }} 年月別射精回数グラフ(自分のデータとみんなのデータを比較)</h4>-->
           <!--<img src="/image/chart.jpg"></img>-->
            
       <!--     <LineChart -->
       <!--         :dataSet="month_data_count"-->
       <!--         :dataSet2="other_user_month_data_count"-->
       <!--         :labels="month_data_label"-->
       <!--     />-->
                    
       <!--</div>-->
       
        <div class="card">
            <h1>2019年のデータ</h1>
        </div>
        <!--メインA-->
        <div class="card">
            
            
            <h1>ログ（後日モーダルに変更する）</h1>
            
            
           <h4>{{ year }}年の記録</h4>
        
            <div class="row "> 
            
                <div class="col-7  p-5">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <h3 class="d-inline-block">月別利用推移（比較）</h3>
                        
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item ">
                                    <span @click="selectTab('month')">今月</span>
                                </li>
                                <li class="nav-item ">
                                    <span @click="selectTab('year')">年間</span>
                                </li>
                                <li class="nav-item ">
                                    <span @click="selectTab('all')">すべて</span>
                                </li>
                            </ul>
                        </div>
                    </nav>
                
                    
                    <LineChart 
                        :dataSet="month_data_count"
                        :dataSet2="other_user_month_data_count"
                        :labels="month_data_label"
                    />
                    
                </div>
                <div class="col-5  p-5">
                    <h5>2019年合計射精回数</h5>
                        <span>15</span>
                    <h5>2019年平均射精回数</h5>
                        <span>145</span>
                    <h5>2019年合計消費カロリー</h5>
                        <span>145</span>
                    <h5>2019年合計支援金</h5>
                        <span>8515</span>
                    <h5>2019年今月の射精回数</h5>
                    <span>(可変するように設定する)</span>
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">ログコメント</h5>
                            テストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテスト
                            </span>
                        </div>
                    </div>

                    
                </div>
            </div>
                
            
            <div class="row">
    
                <div class="col-7">                         <div class="media">
                            <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                            <div class="media-body">
                                <span>
                                <h5 class="mt-0">ログコメント</h5>
                                テストテストテストテストテストテストテスト
                                テストテストテストテストテストテストテストテスト
                                テストテストテストテストテストテストテストテスト
                                テストテストテストテストテスト
                                </span>
                            </div>
                        </div></div>
                <div class="col-5">
                
                        <Doughnut 
                            :dataSet="time_data"
                            :labels="time_data_label"
                        />
                </div>
            </div>
            
            <div class="row">
                <div class="col-4">
                
                    
                        <span>ラインチャート（月別課金推移）</span>
                        <Bar 
                            id="line"
                            :dataSet="time_data"
                            :labels="time_data_label"
                        /> 
                        <span>ラインチャート（消費カロリー推移）</span>
                        <BarLine 
                            :dataSet="time_data"
                            :lineDataSet="time_data"
                            :labels="time_data_label"
                        />
                </div>
    
                <div class="col-7">                         
                    <div class="media">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">ログコメント</h5>
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
            
            
            
            <div class="row">
            
                <!--なんかのグラフ-->
                <div class="col-4">
                    <div class="card">
                    </div>
                </div>
                
                <!--合計支援金-->
            <!--    <div class="col-4">-->
            <!--        <div class="card">-->
            <!--            <h4>円グラフ（365日の内どれくらい利用したか？）</h4>-->
                        
                        <!--<Doughnut -->
                        <!--    :dataSet="time_data"-->
                        <!--    :labels="time_data_label"-->
                        <!--/>-->
            <!--            <div class="col-6">当月日数</div>-->
            <!--            <div class="col-6">利用日数</div>-->
            <!--        </div>-->
            <!--    </div>-->
                
            <!--    <div class="col-4">-->
            <!--        <div class="card  bg-success">-->
                        
            <!--            <span>ラインチャート（月別課金推移）</span>-->
            <!--            <Bar -->
            <!--                id="line"-->
            <!--                :dataSet="time_data"-->
            <!--                :labels="time_data_label"-->
            <!--            />-->
            <!--        </div>-->
                    
            <!--        <div class="card bg-danger">-->
                             
            <!--            <span>ラインチャート（消費カロリー推移）</span>-->
            <!--            <Lines -->
            <!--                :dataSet="time_data"-->
            <!--                :dataSet2="time_data"-->
            <!--                :labels="time_data_label"-->
            <!--            />-->
            <!--        </div>-->
            <!--    </div>-->
            </div>
           
        
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
import BarLine from '../charts/BarLine.vue'
import LineChart from '../charts/Line.vue'
import Lines from '../charts/Line.vue'
import Bar from '../charts/Bar.vue'
import Doughnut from '../charts/Doughnut.vue'
export default {
    components: { LineChart,Bar,Doughnut , BarLine, Lines},
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
