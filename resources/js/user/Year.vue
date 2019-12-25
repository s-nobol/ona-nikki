<template>

<div>
    <div v-if="month_data_label" class="card about__continer__bg">
    
        <h2 class="text-center mb-5"><b>{{ year }}年のデータ</b></h2>
        
        <div class="about__continer">
        
            
            <!--利用推移-->
            <div class="row mb-5">
            
            
                <div class="col-lg-8">
                    <!--月別集計-->
                    <h5><b>月別利用推移</b></h5>
                    
                    <BarLine 
                        :barDataSet="month_data" 
                        :lineDataSet="month_data_ave" 
                        :labels="month_data_label"
                    />
                </div>
                
                <div class="col-lg-4">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                    <div class="media">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">利用推移について</h5>
                            {{ year }}年の合計利用回数は{{ month_data_sum }}回、月額利用回数は{{ Math.round(month_data_sum/12) }}回でした。
                            これは、全国の平均的なユーザー利用回数15回よりもやや多い数値となっております。
                            
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            <!--性別割合-->
            <div class="row mb-5">
            
            
                <!--性別ごとのグラフ-->
                <div class="col-lg-5 order-lg-2">
                    <h4>年間利用割合 {{ day_data_count }}/365日</h4>
                    <Doughnut
                        :dataSet="day_data"
                        :labels="day_data_label"
                    />
                </div>
                
                
                <!--性別ごとの利用推移-->
                <div class="col-lg-7 order-lg-1">
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">利用頻度について</h5>
                            {{ year }}年の合計利用日数は{{ day_data_count }}回です。
                            年間利用割合は{{ active_data_rate }}％でした。
                            これは、全国の平均的なユーザー利用回数15回よりもやや多い数値となっております。
                           
                            
                            </span>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            
            
            <!--カテゴリー別割合-->
            <div class="row mb-5">
            
                <div class="col-lg-5">
                    <h4>カテゴリーの比率</h4>
                    <BarHorizontal 
                        id="category"
                        :dataSet="category_data"
                        :dataBackgroundColor="category_data_color"
                        :labels="category_data_label"
                    />
                </div>
                
                <!--カテゴリーの比率-->
                <div class="col-lg-7">
                    <div class="media">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">カテゴリーについて</h5>
                            カテゴリーの比率は、
                            <span v-for="(item,index) in category_data">
                            {{ index + 1 }}位が{{ category_data_label[index] }} ({{ category_data[index] }}回)、
                            </span>
                            となっております。
                          
                            </span>
                        </div>
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                    </div>
                </div>
                
            </div>
            
            
            <!--募金推移    -->
            <div class="row mb-5">
            
            
                
                <!--募金グラフ-->
                <div class="col-lg-5 order-lg-2">
                    <h4>募金額推移</h4>
                    <LineChart
                        id="month"
                        :Coins="coin_data"
                        :labels="coin_data_label"
                    />
                </div>
                
                
                <!--募金グラフコメント-->
                <div class="col-lg-7 order-lg-1">
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <!--<h5 class="mt-0">募金額について</h5>-->
                            <h4>募金額推移 合計{{ coin_data_sum }}円</h4>
                            {{ year }}年の募金額は合計{{ coin_data_sum }}円となりました。
                            これは、先月の募金額1289円と比較して約{{ active_data_rate }}％ほど増加しています。
                            また、一月あたりの募金額は{{ Math.round( coin_data_sum/12 *10)/10 }}円となり、募金者の割合は増加傾向にあります。
                            </span>
                        </div>
                    </div>
                </div>
                    
            </div>
            
            
            
            <div class="text-center">
                <span class="mr-3">合計射精回数　{{ month_data_sum }}回</span>
                <span class="mr-3">合計消費カロリー　{{ month_data_sum*48.5 }}cal</span>
                <span class="mr-3">合計募金額 {{ coin_data_sum }}円</span>
            </div>
            
        </div>
        
    </div>
</div>
</template>
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
            count: [],
            month: [],
            
            month_data:[],
            month_data_label:[],
            month_data_sum:[],
            month_data_ave:[],
            other_user_month_data_count: [],
            doughnut: [],
            
            
            // 日付
            day_data: null,
            day_data_label: null,
            day_data_count: null,
            active_data:null,
            active_data_rate:null,
            
            
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
                this.month_data_sum = this.sum(this.month_data)
                
                //日付ごとのカウント
                this.day_data = response.data.day_data
                this.day_data_label = response.data.day_data_label
                this.day_data_count = response.data.day_data_count
                this.day_data = [ this.day_data_count, (365 - this.day_data_count)]
                this.active_data_rate = Math.round( this.day_data_count / 365 *100)
            
                // カテゴリー別割合
                this.category_data = response.data.category_data
                this.category_data_label = response.data.category_data_label
                this.category_data_color = response.data.category_data_color
                
                
                
                // 募金額
                this.coin_data = response.data.coin_data
                this.coin_data_label = response.data.coin_data_label
                this.coin_data_sum = this.sum(this.coin_data) 
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
