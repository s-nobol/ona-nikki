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
                        :barDataSet="month_data" 
                        :lineDataSet="month_data_ave" 
                        :labels="month_data_label"
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
                    <h4>年間利用割合 {{ day_data_count }}/365日</h4>
                    <Doughnut
                        :dataSet="day_data"
                        :labels="day_data_label"
                    />
                </div>
                
                
            </div>
            
            
            <!--カテゴリー別割合-->
            <div class="row mb-5">
            
                <div class="col-5">
                    <h4>カテゴリーの比率</h4>
                    <BarHorizontal 
                        id="category"
                        :dataSet="category_data"
                        :dataBackgroundColor="category_data_color"
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
                    <h4>募金額推移</h4>
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
import BarHorizontal from '../charts/BarHorizontal.vue'
import Doughnut from '../charts/Doughnut.vue'
export default {
    components: { LineChart,Bar,Doughnut , BarLine, Lines,BarHorizontal},
    props: {
         year: String,
    },
    data(){
        return{
            msg: '150',
            count: [],
            month: [],
            month_data:[],
            month_data_label:[],
            month_data_ave:[],
            other_user_month_data_count: [],
            doughnut: [],
            
            // 時間別
            time_data: [],
            time_data_label:[],
            
            // 日付
            day_data: null,
            day_data_label: null,
            day_data_count: null,
            
            
            // カテゴリー別データ
            category_data:[],
            category_data_label:[],
            category_data_color: [],
            
            
            // 募金推移データ
            coin_data:[],
            coin_data_label:[],
            coin_data_sum:[],
        }
    },
    methods: {
        get_chart(){
            console.log("チャートの取得")
            axios.get(`/api/mypage/logs/${this.year}`, ).then(response => {
              
                console.log('mypage-year',response);
                
                this.month_data = response.data.month_data
                this.month_data_label = response.data.month_data_label
                this.other_user_month_data_count = response.data.otherlogs
                
                
                //日付ごとのカウント
                this.day_data = response.data.day_data
                this.day_data_label = response.data.day_data_label
                this.day_data_count = response.data.day_data_count
                this.day_data = [ this.day_data_count, (365 - this.day_data_count)]
                
            
                // カテゴリー別割合
                this.category_data = response.data.category_data
                this.category_data_label = response.data.category_data_label
                this.category_data_color = response.data.category_data_color
                
                // 募金額
                this.coin_data = response.data.coin_data
                this.coin_data_label = response.data.coin_data_label
                // this.coin_data_sum = this.sum(this.coin_data) 
            })
        },
        // 配列の合計値をだす
        sum(data){
            return  data.reduce(function(prev, current, i, data) {
                return prev+current;
            });
        },
        // 配列の平均値
        ave(data){
            return this.get_sum(data)/data.length;
        },
        // どのくらい利用しているか？
        active_data(data){
            var days = 30 - data
            return [data, days];
        },
    },
    watch: {
        $route() {
            this.get_chart()
            immediate: true
        }
    },
    created(){
        this.get_chart()
    }
}
</script>
