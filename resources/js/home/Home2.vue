<template>
<div class="">
        
        
        <!--ホーム用のヘッダー-->
        <HomeBar id="test" />
        
        
        
 
        <div class="row "> 
            <div class="col-9 ">
                
                
            
                <!--メインチャート-->
                <div class="card">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <h3 class="d-inline-block">日別利用推移</h3>
                        
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
                    <Lines 
                        id="line1"
                        :dataSet="time_data"
                        :labels="time_data_label"
                    />
                </div>
                
                
                <!--サブチャート-->
                <div class="row">
                    <div class="col-7 card">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <h4 class="d-inline-block"><b>6か月の比較</b></h4>  
                            
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
                        <Bar 
                            id="bar"
                            :dataSet="time_data"
                            :labels="time_data_label"
                        />
                    </div>
                    
                    
                
                    <!--一か月の利用頻度（円グラフ）-->  
                    <div class="col-5 card">         
                        <h4 class="text-center p-2"><b>一か月の利用比率</b></h4>  
                 
                        <div class="Mypage__Doughnut">
                            <Doughnut 
                                :borderWidth="80"
                                :dataSetSex="sex_data"
                                :labels="sex_data_label"
                            />
                            <span class="Mypage__Doughnut__title">25 <small>%</small></span>
                        </div>
                        <div class="text-center mt-4">
                            <span class="Chart__label"></span> <span>使用日数　15日</span>
                            <span class="Chart__label"></span> <span>非利用日数　10日</span>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                
                    <div class="col-3 card p-3 text-center">
                        <h4 class="text-center mt-3"><b>弟子入り数</b></h4>
                        <h1 class="mt-1"><b>1,523</b><small>aces</small></h1>
                        <span>Followers</span>
                    </div>
                    
                    <div class="col-6 card">
                        <h4 class="text-center"><b>カテゴリー別グラフ</b></h4>
                        <BarHorizontal 
                            id="category"
                            :dataSet="category_data"
                            :dataBackgroundColor="category_data_color"
                            :labels="category_data_label"
                        />
                    </div>
                    
                    <div class="col-3 card  text-center">
                        <span class=" p-1">募金額推移</span>
                        <!--<Lines -->
                        <!--    id="coin"-->
                        <!--    :Coins="week_data"-->
                        <!--    :labels="week_data"-->
                        <!--/>-->
                    </div>
                    
                </div>
                
                
                
                
                
                <!--<div class="row">-->
                
                <!--    <div class="col-5 card ">-->
                <!--        <h5 class="p-5"></h5>-->
                <!--    </div>-->
                    
                <!--    <div class="col-7 card">-->
                <!--        <h5 class="p-5"></h5>-->
                <!--    </div>-->
                    
                    
                <!--</div>-->
                
                
                
                
                <!--レスポンシブで表示されるようにする-->
                <!--<div class="card">-->
                <!--    <Table  :dataSet="new_data" />-->
                <!--</div>-->
                    
                <div>
                    <img src="/image/mypage-image.jpg"></img>
                </div>
                
                    
            </div>
            
            
            <!--サイドバー-->
            <div class="col-3 pl-3">
        
                        
                <!--タイムライン-->
                <TimeLine 
                :dataSet="new_data"
                />
            
                <!--Twitterフィード-->
                <TwitterFeed />
                
                    
            </div>
        </div>
    
        
        
        
        <!--<div>-->
        <!--<img src="/image/home-image.jpg"></img>-->
        <!--</div>-->
        
    
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
            
            // カテゴリー別データ
            category_data:[],
            category_data_label:[],
            category_data_color: [],
            
            //now_data
            new_data: [],
            
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
            
                // カテゴリー別データ
                this.category_data = response.data.category_data
                this.category_data_label = response.data.category_data_label
                this.category_data_color = response.data.category_data_color
                
                //now_data
                this.new_data = response.data.new_data
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