<template>
<div>
    <div v-if="month_data_label" class="card p-4">
    
        <h2 class="text-center"><b>{{ year }}年{{ month }}月のデータ</b></h2>
        
        
        <div class="row month_center">
            <div class="col-8">
                <!--月別集計-->
                <h5><b>month</b></h5>
                
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
        
        
        <div class="row month_center">
        
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
                <h4>性別ごとの利用割合（円グラフ）</h4>
                <Doughnut
                    :dataSet="sex_data"
                    :labels="sex_data_label"
                />
            </div>
            
            
        </div>
        
            
            
        
        <div class="row month_center">
        
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
        
        <div class="row month_center">
        
        
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
            <span>合計利用人数　15人</span>
            <span>合計募金額　532円</span>
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
            // 月別データ
            month_data_label: [],
            month_data_count: [],
            month_data_ave: [],
            
            sex_data: [],
            sex_data_label:[],
            
            category_data:[],
            category_data_label:[],
            
            
            coin_data:[],
            coin_data_label:[],
        }
    },
    methods: {
         get_data(){
            
            axios.get(`/api/logs/${this.year}/${this.month}`).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.month_data_count = response.data.month_count
                    this.month_data_ave = response.data.month_count_ave
                    this.month_data_label = response.data.month_label 
                    
                    this.sex_data = response.data.sex_data
                    this.sex_data_label = response.data.sex_data_label
                    
                    this.category_data = response.data.category_data
                    this.category_data_label = response.data.category_data_label
                    
                    this.coin_data = response.data.coin_data
                    this.coin_data_label = response.data.coin_data_label
                    
                }
            })
            
        },
        
    },
    created(){
        this.get_data()   
    }
}
</script>