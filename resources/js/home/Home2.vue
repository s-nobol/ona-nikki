<template>
<div class="">
        
        <!--ホーム用のヘッダー-->
        <HomeBar id="test" />
        
        <div class="card_w-75">
        
        
            <div class="row">
                
                
                <div class="col-4 ">
                
                    <div class="card_">
                        <h5 class="mt-5 text-center">地域ごとのデータ</h5 >
                        <BarHorizontal 
                            id="location"
                            :dataSet="location_data"
                            :labels="location_data_label"
                        />
                    </div>
                    
                    <div class="card_">
                        <h5  class="mt-5 text-center">性別ごとの利用割合</h5 >
                        <Doughnut 
                            :borderWidth="80"
                            :dataSetSex="sex_data"
                            :labels="sex_data_label"
                        />
                    </div>
                </div>
                
                
                <!--マップ-->
                <div class="col-8  pl-5 pr-5 pt-3 pb-3">
                    <!--<div class="  pl-5 pr-5">-->
                       <img src="/image/map.png" class="location_image"></img>
                    <!--</div>-->
                </div>
        
            </div>
        </div>
        
        
        <!--利用ユーザー　最新5件-->
        <div class="row">
            <div class="col-5 card text-left">
                <span>Week＿Data</span>
                <Lines 
                    id="test"
                    :dataSet="week_data"
                    :labels="week_data"
                />
            </div>
            
            <div class="col-3 card">
                <span>天気？</span>
                  <Doughnut 
                        :borderWidth="80"
                        :dataSet="sex_data"
                        :labels="sex_data_label"
                    />
            </div>
            <div class="col-4 card">
                <span>募金推移</span>
                <!--<Lines -->
                <!--    id="coin2"-->
                <!--    :Coins="week_data"-->
                <!--    :labels="week_data"-->
                <!--/>-->
            </div>
           
        </div>
        
        <!--利用ユーザー　最新5件-->
        <div class="row">
            <div class="col-4 card p-5">
                <span>利用ユーザー　最新5件</span>
        
            </div>
            <div class="col-4 card p-5">
                <span>カテゴリー別利用グラフ</span>
                    <!--<h4 class="ranking_card">総合ランキング</h4>-->
                    <!--<div class="pr-4 pl-4">-->
                    <!--<Ranker :dataSet="ranking_data"   />-->
                    <!--</div>-->
                <BarHorizontal 
                    id="category"
                    :dataSet="location_data"
                    :labels="location_data_label"
                />
            </div>
            
            <div class="col-4 card p-5">
                <span>募金額推移</span>
                <Lines 
                    id="coin"
                    :Coins="week_data"
                    :labels="week_data"
                />
        
            </div>
        </div>
            
        
        
        
        
        <img src="/image/home-image.jpg"></img>
        
    
</div>
</template>

<script>
import Bar from '../charts/Bar.vue'
import BarLine from '../charts/BarLine.vue'
import Lines from '../charts/Line.vue'
import Doughnut from '../charts/Doughnut.vue'
import BarHorizontal from '../charts/BarHorizontal.vue'
import Table from '../components/Table.vue'
import Ranker from '../components/Ranker.vue'


import HomeBar from '../components/home/HomeBar.vue'
import TimeLine from '../components/home/TimeLine.vue'
import TwitterFeed from '../components/home/TwitterFeed.vue'
export default {
    components: {HomeBar, Bar, BarLine ,Doughnut, Lines, BarHorizontal, 
        Table, Ranker,TimeLine,TwitterFeed},
    data(){
        return{
            data: [],
            data_label: [],
            
            location_data:[],
            location_data_label: [],
            
            sex_data:[],
            sex_data_label: [],
            
            time_data:[],
            time_data_label: [],
            
            week_data: [],
            week_data_label: [],
            
            ranking_data: [],
        }
    },
    methods: {
        get_data(){
            axios.get(`/api/home`).then(response => {
                console.log('home',response);
                
                // データ
                this.data = response.data.data
                this.data_label = response.data.data_label
                
                // 地域別
                this.location_data = response.data.location_data
                this.location_data_label = response.data.location_data_label
                
                //性別
                this.sex_data = response.data.sex_data
                this.sex_data_label = response.data.sex_data_label
                
                //時間別
                this.time_data = response.data.time_data
                this.time_data_label = response.data.time_data_label
                
                this.week_data = response.data.week_data
                this.week_data_label = response.data.week_data_label
                
                this.ranking_data = response.data.ranking_data
            })
        },
        
        // 配列の合計値をだす
        get_sum(data){
            return  data.reduce(function(prev, current, i, data) {
                return prev+current;
            });
        },
        // 配列の平均値
        get_ave(data){
            return this.get_sum(data)/data.length;
        },
    },
    created(){
        this.get_data()
    }
}
</script>