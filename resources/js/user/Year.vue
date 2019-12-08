<template>

<div>
    <div v-if="month_data_label" class="card about__continer__bg">
    
        <h2 class="text-center mb-5"><b>{{ year }}年のデータ</b></h2>
        
        <div class="about__continer">
        
            
            <!--利用推移-->
            <div class="row mb-5">
            
            
                <div class="col-8">
                    <!--月別集計-->
                    <h5><b>月別利用推移</b></h5>
                    
                    <BarLine 
                        :labels="month_data_label"
                        :barDataSet="month_data_count" 
                        :lineDataSet="month_data_ave" 
                    />
                </div>
                
                <div class="col-4">
                    <div class="media">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">利用推移について</h5>
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
            
            
            <!--性別割合-->
            <div class="row mb-5">
            
                <!--性別ごとの利用推移-->
                <div class="col-7">
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">利用者の割合</h5>
                            テストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテスト
                            先月と比較してXXXX％の伸びました
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-5">
                    <h4>年間利用割合（一年間のうちどれだけ利用したか？）</h4>
                    <Doughnut
                        :dataSet="sex_data"
                        :labels="sex_data_label"
                    />
                </div>
                
                
            </div>
            
            
            <!--カテゴリー別割合-->
            <div class="row mb-5">
            
                <div class="col-5">
                    <h4>カテゴリーの比率（棒グラフ）</h4>
                    <BarHorizontal 
                        :dataSet="category_data"
                        :labels="category_data_label"
                    />
                </div>
                
                <!--カテゴリーの比率-->
                <div class="col-7">
                    <div class="media">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">カテゴリーについて</h5>
                            テストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテスト
                            先月と比較してXXXX％の伸びました
                            </span>
                        </div>
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                    </div>
                </div>
                
            </div>
            
            
            <!--募金推移    -->
            <div class="row mb-5">
            
            
                <div class="col-7">
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">募金額推移 について</h5>
                            テストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテスト
                            先月と比較してXXXX％の伸びました
                            </span>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-5">
                    <h4>募金額推移（棒グラフ）</h4>
                    <LineChart
                        id="month"
                        :Coins="coin_data"
                        :labels="coin_data_label"
                    />
                </div>
                    
            </div>
            
            
            
            <div class="text-center">
                <span>合計射精回数　555回</span>
                <span>合計消費カロリー　555cal</span>
                <span>合計募金額　532円</span>
            </div>
            
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
