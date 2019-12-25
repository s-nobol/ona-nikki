<template>
<div>
    <div v-if="month_data_label" class="card about__continer__bg">
    
        <h2 class="text-center mb-5"><b>{{ year }}年{{ month }}月のデータ</b></h2>
        
        <div class="about__continer">
        
            
            <!--利用推移-->
            <div class="row mb-5">
            
            
                <div class="col-lg-8">
                    <!--月別集計-->
                    <h5><b>month</b></h5>
                    
                    <BarLine 
                        :barDataSet="month_data" 
                        :lineDataSet="month_data" 
                        :labels="month_data_label"
                    />
                </div>
                
                <div class="col-lg-4">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                    <div class="media">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">利用推移について</h5>
                            {{ year }}年{{ month }}月の合計利用回数は{{ month_data_sum }}回となりました。
                            また、当月の利用人数は{{ sex_data_sum }}人で
                            これは、一人当たり一か月に{{  Math.round( month_data_sum / sex_data_sum *10)/10}}
                            回自慰行為が行われていることを表しています。
                            <!--<br>-->
                            <!--また、全体平均と比較すると、15%ほど上昇しており-->
                            <!--例年よりやや多めの記録となっております。-->
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            <!--性別割合-->
            <div class="row mb-5">
            
                <!--性別グラフ-->
                <div class="col-lg-5 order-lg-2">
                    <h4 class="text-center">利用者の性別</h4>
                    
                    <!--<div class="Mypage__Doughnut text-center">-->
                        <Doughnut
                            :dataSetSex="sex_data"
                            :borderWidth="80"
                            :labels="sex_data_label"
                        />
                    <!--    <span class="Mypage__Doughnut__title">男</span>-->
                    <!--</div>-->
                </div>
                
                <!--性別ごとの利用推移-->
                <div class="col-lg-7 order-lg-1">
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">性別について</h5>
                            性別ごとの利用割合では、{{ sex_data_label[0] }}性の賢者様{{ sex_data[0] }}人、
                            {{ sex_data_label[1] }}性の賢者様{{ sex_data[1]  }}人
                            と比較的{{ sex_data_label[0] }}性の賢者様による利用が多い結果となりました。<br>
                            <!--またこれは、すべてのユーザーの内、{{ sex_data_sum }}％がオナ日記を利用していることになります。-->
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
                            となっており、平年並み並みの結果となりました。
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
                    <h4>募金額推移 合計{{ coin_data_sum }}円</h4>
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
                            <span v-if="month > 1">
                            <h5 class="mt-0">募金額推移 について</h5>
                            {{ year }}年{{ month }}月の募金額は合計{{ coin_data_sum }}円となりました。
                            これは、先月の募金額{{ last_month_coin_data_sum }}円と比較して約{{ coin_data_rate }}％
                            ほど<span v-if="coin_data_sum > last_month_coin_data_sum">増加</span><span v-if="coin_data_sum < last_month_coin_data_sum">現象</span>しています。
                            また、一人当たりの募金額は{{ coin_data_avg }}円となり、募金者の割合は増加傾向にあります。
                            </span>
                            <span v-if="month == 1">
                            <h5 class="mt-0">募金額推移 について</h5>
                            {{ year }}年{{ month }}月の募金額は合計{{ coin_data_sum }}円となりました。
                            また、一人当たりの募金額は{{ coin_data_avg }}円となります。
                            </span>
                        </div>
                    </div>
                </div>
                
            </div>
            
            
            
            <div class="text-center">
                <span>合計射精回数　{{ month_data_sum}}回</span>
                <span>合計利用人数　{{ sex_data_sum }}人</span>
                <span>合計募金額　{{ coin_data_sum }}円</span>
            </div>
            
        </div>
        
    </div>
</div>
</template>
<style type="text/css">
.month_center{
    width: 90%;
    margin: auto;
    margin-bottom: 50px;
} 
.media{
    margin-top: 50px;
}
</style>
<script>
import Bar from '../charts/Bar.vue'
import BarLine from '../charts/BarLine.vue'
import BarHorizontal from '../charts/BarHorizontal.vue'
import Doughnut from '../charts/Doughnut.vue'
import LineChart from '../charts/Line.vue'

export default {
    components: { Bar, BarLine, BarHorizontal, Doughnut, LineChart },
    props: {
         year: String,
         month: String
    },
    data(){
        return{
            user_all_avg: 0,
            
            // 月別利用データ
            month_data: [],
            month_data_label: [],
            month_data_sum:[],
            month_data_ave: [],
            
            // 性別割合データ
            sex_data: [],
            sex_data_label:[],
            sex_data_sum:[],
            sex_user_all:[],
            
            // カテゴリー別データ
            category_data:[],
            category_data_label:[],
            category_data_color: [],
            
            
            // 募金推移データ
            coin_data:[],
            coin_data_label:[],
            coin_data_sum:[],
            coin_data_avg:[],
            
            last_month_coin_data_sum: [],
            coin_data_rate: null
        }
    },
    methods: {
         get_data(){
            
            axios.get(`/api/home/logs/${this.year}/${this.month}`).then(response => {
                console.log('month',response); 
                if(response.status === 200){
                    
                    // 月別利用
                    this.month_data = response.data.month_count
                    this.month_data_label = response.data.month_label 
                    this.month_data_sum = this.sum(this.month_data) 
                    this.month_data_ave = response.data.month_count_ave
                    
                    // 性別割合
                    this.sex_data = response.data.sex_data
                    this.sex_data_label = response.data.sex_data_label
                    this.sex_data_sum = this.sum(this.sex_data) 
                    this.user_all_avg = Math.round( this.sex_data_sum / response.data.user_all *100)
                    
                    // カテゴリー別割合
                    this.category_data = response.data.category_data
                    this.category_data_label = response.data.category_data_label
                    this.category_data_color = response.data.category_data_color
                    
                    // 募金額
                    this.coin_data = response.data.coin_data
                    this.coin_data_label = response.data.coin_data_label
                    this.coin_data_sum = this.sum(this.coin_data)
                    this.coin_data_avg = Math.round( this.coin_data_sum /this.sex_data_sum *10 )/10
                    
                    // 先月のデータ
                    this.last_month_coin_data_sum = this.sum(response.data.last_month_coin_data)
                    this.coin_data_rate = Math.round( this.coin_data_sum /this.last_month_coin_data_sum *10 )/10
                    
                    
                    
                }
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
    created(){
        this.get_data()   
    }

}
</script>