<template>
<div class="">
        
        
        <!--ホーム用のヘッダー-->
        <!--<HomeBar id="test" />-->
        
        
        <!--チャート-->
        <div class="row">
            <div class="col-10">
        
                <!--マップ-->
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1877635.1007461809!2d137.24227896228032!3d35.027883556738324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6019629a42fdc899%3A0xa6a1fcc916f3a4df!2z5a-M5aOr5bGx!5e0!3m2!1sja!2sjp!4v1576432477177!5m2!1sja!2sjp"
                    width="100%" height="550" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
                
                
                
                
                <!--チャート-->
                <div class="row">
                    <div class="col-7 card p-3 ">
                        <!--<span>データ(利用されたカテゴリーをランキングごとに表示)</span>-->
                        <span>データ　カテゴリー</span>
                        
                        <BarHorizontal 
                            id="location"
                            :dataSet="location_data"
                            :labels="location_data_label"
                        />
                            
                            
                    </div>
                    <div class="col-5 card p-0">
                        <span>データ　性別ごとの利用</span>
                        <Doughnut   
                            :borderWidth="90"  
                            :dataSetSex="sex_data"  
                            :labels="sex_data_label"   
                        />
                    </div>
                </div>
                
                
                
                
                <div class="row">
                
                    <div class="col-6 card ">
                             
                        <!--時間帯別利用利用推移チャート-->
                        <div class="row">
                            <div class="col-6">
                                <Bar   :dataTime="time_data"   :labels="time_data_label" />
                            </div>
                            <div class="col-6">
                                <span>時間帯別利用利用推移</span>
                            </div>
                        </div>
                        
                        <!--コインチャート-->
                        <div class="row">
                            <div class="col-6">
                                <span>時間帯別利用利用推移</span>
                            </div>
                            <div class="col-6">
                                <Lines   id="coin1"  :Coins="week_data"   :labels="week_data"  />
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-6 card ">
                        <div class="Home__CoinChart">
                            <Lines 
                                id="coin"
                                :Coins="week_data"
                                :labels="week_data"
                            />
                            <span class="Home__CoinChart__title">募金額推移</span>
                        </div>    
                    </div>
        
                </div>
            
            </div>
            
            <div class="col-2">
            </div>
        </div>
        
        <div class="w-50"><img src="/image/home-image.jpg"></img></div>
        
    
</div>
</template>
<style type="text/css">
.Home__CoinChart{
    position: relative;
    background-color: #68d99b;
}
.Home__CoinChart__title{
    position: absolute;
    top: 15px;
    left: 15px;
    color: white;
    font-size: 35px;
}
.bg__blue{
    background-color: lightskyblue;
}
</style>

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