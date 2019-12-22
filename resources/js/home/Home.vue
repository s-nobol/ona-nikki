<template>
<div class="">
        
        
        <!--ホーム用のヘッダー-->
        <HomeBar 
            :total_month="month_count"
            :total_day="day_count"
            :total_man="man_count"
            :total_woman="woman_count"
            :total_donation="donation_count"
        
        />
        
        <!--チャート-->
        <div class="row">
            <div class="col-9">
            
                
                
                <!--マップ-->
                <!--<div class="card">-->
                <!--    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1877635.1007461809!2d137.24227896228032!3d35.027883556738324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6019629a42fdc899%3A0xa6a1fcc916f3a4df!2z5a-M5aOr5bGx!5e0!3m2!1sja!2sjp!4v1576432477177!5m2!1sja!2sjp"-->
                <!--    width="100%" height="550" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
                <!--</div>-->
                
            
                
                <div class="card">
                    
                    <div class="row pt-5 pb-5">
                    
                        <!--ロケーション-->
                        <div class="col-5">
                            <h4 class="text-center"><b>地域ごとの集計</b></h4>  
                            <BarHorizontal 
                                id="locatio4n"
                                :dataSet="location_data"
                                :labels="location_data_label"
                            />
                            
                            
                            <h4 class="text-center mt-5"><b>地域ごとの集計</b></h4>
                            <div class="pl-5 pr-5">
                            <Doughnut 
                                :borderWidth="80"
                                :dataSetSex="sex_data"
                                :labels="sex_data_label"
                            />
                            </div>
                            <div class="text-center mt-4">
                                <span class="Chart__label"></span> <span>男性利用　{{ man_count }}人</span>
                                <span class="Chart__label"></span> <span>女性利用　{{ woman_count }}人</span>
                            </div>
                        </div>
                        
                        <!--マップ-->
                        <div class="col-7 p-4">
                            <Map />
                        </div>
                    </div>
                </div>
                
                
                
                <!--チャート1-->
                <div class="row">
                
                    <div class="col-4 card p-3 text-center">
                        <h4 class="text-center mt-4"><b>弟子入り数</b></h4>
                        <h1 class="mt-1"><b>1,523</b><small>aces</small></h1>
                        <span>Followers</span>
                    </div>
                    
                    <div class="col-5 card">
                        <h4 class="text-center p-2"><b>カテゴリー別推移</b></h4> 
                            <BarHorizontal 
                                id="category2"
                                :dataSet="category_data"
                                :dataBackgroundColor="category_data_color"
                                :labels="category_data_label"
                            />
                    </div>
                    
                    
                    <div class="col-3 card p-3 text-center">
                        <h4 class="text-center mt-4"><b>弟子入り数</b></h4>
                        <h1 class="mt-1"><b>1,523</b><small>aces</small></h1>
                        <span>Followers</span>
                    </div>
                </div>
                
                
                
                
                <!--チャート2-->
                <div class="row">
                    <div class="col-6 card ">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <h4 class="d-inline-block"><b>7日間の利用推移</b></h4>  
                            
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item ">
                                        <span class="Chart__label"></span>
                                        <span>ユーザー</span>
                                    </li>
                                    <li class="nav-item ">
                                        <span class="Chart__label"></span>
                                        <span>みんな</span>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                           <BarHorizontal 
                                id="category2"
                                :dataSet="category_data"
                                :dataBackgroundColor="category_data_color"
                                :labels="category_data_label"
                            />
                        <!--<Lines -->
                        <!--    id="week"-->
                        <!--    :dataSet="week_data"-->
                        <!--    :labels="week_data"-->
                        <!--/>-->
                    </div>
                    
                    
                    
                    <div class="col-6 card p-0">
                        <!--<h4 class="text-center p-2"><b>性別ごとの利用比率</b></h4>-->
                        <h4 class="text-center p-2"><b>7日間の利用推移</b></h4>  
                        
                        <!--<div class="Mypage__Doughnut">-->
                        <!--    <span class="Mypage__Doughnut__title">25 <small>%</small></span>-->
                        <!--</div>-->
                        <Lines 
                            id="week"
                            :dataSet="week_data"
                            :labels="week_data"
                        />
                    </div>
                </div>
                
                
                
                
                
                
                
            </div>
            
            
            
            <!--サイドバー-->
            <div class="col-3 pl-4">
            
            
                <!--タイムライン-->
                <TimeLine />
            
                <!--Twitterフィード-->
                <TwitterFeed />
                
                
                <!--サブ・タイムライン-->
                <!--<TimeLine />-->
              
                <div class="Home__CoinChart">
                    <h4 class="text-center text-white"><b>募金額推移</b></h4>  
                    <Lines 
                        id="coin"
                        :Coins="donation_data"
                        :labels="donation_data_label"
                    />
                    <!--<span class="Home__CoinChart__title">募金額推移</span>-->
                </div>   
            </div>
        </div>
        
        <!--<div class="w-50">-->
        <!--    <img src="/image/home-image.jpg"></img>-->
        <!--</div>-->
        
    
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


import Map from '../components/Map.vue'
import HomeBar from '../components/home/HomeBar.vue'
import TimeLine from '../components/home/TimeLine.vue'
import TwitterFeed from '../components/home/TwitterFeed.vue'
export default {
    components: {HomeBar, Bar, BarLine ,Doughnut, Lines, BarHorizontal,
    Map,
        Table, Ranker,TimeLine,TwitterFeed},
    data(){
        return{
            day_count: 0,
            month_count: 0,
            man_count: 0,
            woman_count: 0,
            donation_count: 0,
            
            
            data: [],
            data_label: [],
            
            location_data:[],
            location_data_label: [],
            
            sex_data:[],
            sex_data_label: [],
            
            
            
            // 7日間データ
            week_data: [],
            week_data_label: [],
            
            
            
            // カテゴリー別データ
            category_data:[],
            category_data_label:[],
            category_data_color: [],
            
            
            // 募金データ
            donation_data: [],
            donation_data_label: [],
        }
    },
    methods: {
        get_data(){
            axios.get(`/api/home`).then(response => {
                console.log('home',response);
                
                // データ
                this.data = response.data.data
                this.data_label = response.data.data_label
                this.day_count = this.get_sum(this.data)
                
                // 地域別
                this.location_data = response.data.location_data
                this.location_data_label = response.data.location_data_label
                
                //性別
                this.sex_data = response.data.sex_data
                this.sex_data_label = response.data.sex_data_label
                this.set_sex_date(this.sex_data, this.sex_data_label)
                
                //時間別
                this.time_data = response.data.time_data
                this.time_data_label = response.data.time_data_label
                
                this.week_data = response.data.week_data
                this.week_data_label = response.data.week_data_label
                
                // 募金額推移
                this.donation_data = response.data.donation_data
                this.donation_data_label = response.data.donation_data_label
                this.donation_count = this.get_sum(this.donation_data)
            
                // カテゴリー別割合
                this.category_data = response.data.category_data
                this.category_data_label = response.data.category_data_label
                this.category_data_color = response.data.category_data_color
                
                
                this.month_count = response.data.month_data_count
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
        
        // 性別ごとの集計
        set_sex_date(sex_data, sex_data_label){
            if(sex_data_label[0] === "男" ){
                this.man_count = sex_data[0]
                this.woman_count = sex_data[1]
            }else if(sex_data_label[0] === "女" ){
                this.man_count = sex_data[1]
                this.woman_count = sex_data[0]
            }
        },
        
    },
    created(){
        this.get_data()
    }
}
</script>