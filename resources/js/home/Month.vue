<template>
<div>
    <div v-if="month_data_label" class="card about__continer__bg">
    
        <h2 class="text-center mb-5"><b>{{ year }}年{{ month }}月のデータ</b></h2>
        
        <div class="about__continer">
        
            
            <!--利用推移-->
            <div class="row mb-5">
            
            
                <div class="col-8">
                    <!--月別集計-->
                    <h5><b>month</b></h5>
                    
                    <BarLine 
                        :barDataSet="month_data" 
                        :lineDataSet="month_data" 
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
                    <h4>性別ごとの利用割合 {{ sex_data_sum }}人</h4>
                    <Doughnut
                        :dataSet="sex_data"
                        :labels="sex_data_label"
                    />
                </div>
                
                
            </div>
            
            
            <!--カテゴリー別割合-->
            <div class="row mb-5">
            
                <div class="col-5">
                    <h4>カテゴリーの比率</h4>
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
                            <h5 class="mt-0">O月のカテゴリーについて</h5>
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
                    <h4>募金額推移 合計{{ coin_data_sum }}円</h4>
                    <LineChart
                        id="month"
                        :Coins="coin_data"
                        :labels="coin_data_label"
                    />
                </div>
                    
            </div>
            
            
            
            <div class="text-center">
                <span>合計射精回数　555回</span>
                <span>合計利用人数　15人</span>
                <span>合計募金額　532円</span>
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
            
            
            // 月別利用データ
            month_data: [],
            month_data_label: [],
            month_data_sum:[],
            month_data_ave: [],
            
            // 性別割合データ
            sex_data: [],
            sex_data_label:[],
            sex_data_sum:[],
            
            // 性別割合データ
            category_data:[],
            category_data_label:[],
            
            
            // 募金推移データ
            coin_data:[],
            coin_data_label:[],
            coin_data_sum:[],
        }
    },
    methods: {
         get_data(){
            
            axios.get(`/api/home/logs/${this.year}/${this.month}`).then(response => {
                console.log('month',response); 
                if(response.status === 200){
                    
                    this.month_data = response.data.month_count
                    this.month_data_label = response.data.month_label 
                    this.month_data_sum = this.sum(this.month_data) 
                    this.month_data_ave = response.data.month_count_ave
                    
                    this.sex_data = response.data.sex_data
                    this.sex_data_label = response.data.sex_data_label
                    this.sex_data_sum = this.sum(this.sex_data) 
                    
                    this.category_data = response.data.category_data
                    this.category_data_label = response.data.category_data_label
                    
                    this.coin_data = response.data.coin_data
                    this.coin_data_label = response.data.coin_data_label
                    this.coin_data_sum = this.sum(this.coin_data) 
                    
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
        }
        
    },
    created(){
        this.get_data()   
    }
}
</script>