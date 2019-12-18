<template>
    <div class="">
    
    
 
        <div class="row "> 
            <div class="col-9 ">
                
                <!--ユーザーばー-->
                <UserBar 
                    :total_all="1562"
                    :total_month="85"
                    :total_calorie="456"
                    :total_donation="789"
                />
                
            
                <!--メインチャート-->
                <div class="card">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <h3 class="d-inline-block">月別利用推移</h3>
                        
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
                        :dataSet="month_data"
                        :labels="month_data_label"
                    />
                </div>
                
                
                <!--サブチャート-->
                <div class="row">
                    <div class="col-7 card">
                         <!--<span>なんかのグラフ</span>-->
                        
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
                    
                    
                    
                    <div class="col-5 card">
                        <!--一か月の利用頻度（円グラフ）-->           
                        <h4 class="text-center p-2"><b>一か月の利用比率</b></h4>  
                 
                        <div class="Mypage__Doughnut">
                            <Doughnut 
                                :borderWidth="70"
                                :dataSet="time_data"
                                :labels="time_data_label"
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
                
                    <div class="col-4 card p-3 text-center">
                        <!--<span>何らかのグラフ・データ</span>-->
                        <h4 class="text-center mt-5"><b>弟子入り数</b></h4>
                        
                        <h1 class="mt-1"><b>1,523</b><small>aces</small></h1>
                        <span>Followers</span>
                    </div>
                    
                    <div class="col-5 card p-3 ">
                        <h4 class="text-center"><b>カテゴリー別グラフ</b></h4>
                        <BarHorizontal 
                            id="category"
                            :dataSet="category_data"
                            :dataBackgroundColor="category_data_color"
                            :labels="category_data_label"
                        />
                    </div>
                    
                    <div class="col-3 card p-3 text-center">
                        <span class="rounded-pill bg__red p-1">平均利用時間</span>
                        <h2 class="d-inline-block"><b>25</b>hour</h2>
                    </div>
                    
                </div>
                
                
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
        
                    <!--カレンダー-->
                    <div class=" card ">
                        <CalendarTest  
                        :dataSet="day_data"
                        />
                    </div>
                    
                    
                    
                    <!--レベル・ユーザーステータスになるもの-->
                    <div class=" card p-2 text-center">
                        <h3 class=""><b>Lev.58</b></h3>
                        <small>次のレベルまであと151pint</small>
                    </div>
                    
                    
                    
                    
                    <!--ユーザーテーブル-->
                    <nav class="navbar navbar-expand-lg navbar-light p-0 mb-2">
                        <span>最新記録</span>
                        
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item ">
                                    <span>（5件）</span>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    
                    
                    <div v-for="item in new_data" class=" card p-1">
                        
                        <div class="row p-0">
                        
                            <div class="col-9  p-0">  
                                    
                                <div class="media mt-0 ">
                                    <img v-if="currentUser.oauth_image" class="user_image" :src="currentUser.oauth_image" alt="ユーザー画像">
                                    <img v-if="! currentUser.oauth_image" class="user_image" src="/image/noimage.jpg" alt="ユーザー画像">
                       
                                    <div class="media-body">
                                        <div class="mt-1">
                                            <span class="new__date__item bg__red">
                                                <i class="fas fa-sun mr-2"></i>{{ item.category }}
                                            </span>
                                            <span>募金 50円</span>
                                        </div>
                                        <span>{{ item.created_at }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-3  p-0 ">
                                <button class="btn btn-success mt-2">編集</button>
                            </div>
                        </div>
                    </div>
                    
            </div>
        </div>
    
        
    </div>
</template>
<style type="text/css">
.Mypage__Doughnut{
    position: relative;
}
.Mypage__Doughnut__title{
    position: absolute;
    display: inline-block;
    font-size: 45px;
    top:50%;
    left: 50%;
    margin-left: -35px;
    margin-top: -35px;
}
.Chart__label{
    display: inline-block;
    width: 25px;
    height: 15px;
    background-color: whitesmoke;
}
.new__date__item{
    padding: 1px 5px;
    border-radius: 15px;
    
}
</style>
<script>

import Bar from '../charts/Bar.vue'
import BarLine from '../charts/BarLine.vue'
import Lines from '../charts/Line.vue'
import Doughnut from '../charts/Doughnut.vue'
import BarHorizontal from '../charts/BarHorizontal.vue'
import Table from '../components/Table.vue'
import Dateitem from './Date.vue'

// import Calendar from '../components/user/Calendar.vue'

// UserBar
import HomeBar from '../components/home/HomeBar.vue'
import UserBar from '../components/user/UserBar.vue'
import CalendarTest from '../components/user/CalendarTest.vue'

export default {
    components: { Bar, BarLine ,Doughnut, BarHorizontal,
    Table, Dateitem, HomeBar,Lines ,
    UserBar,CalendarTest},
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    data(){
        return{
            msg: '5',
            tab: 'year',
            data: [],
            data_label: [],
            
            
            month_data: [],
            month_data_label:[],
            last_month_data: [],
            last_month_data_label: [],
            
            month_data_total: 0,    　 //1カ月の利用回数
            last_month_data_total: 0, //先月の利用回数
            
            time_data: [],
            time_data_label: [],
            
            active_data: [], //利用頻度
            
            category_data: [],
            category_data_label: [],
            
            new_data: [], //最新の5件のデータ
            day_data: [],
            
            
            
            // カテゴリー別データ
            category_data:[],
            category_data_label:[],
            category_data_color: [],
            
        }
    },
    methods: {
        selectTab(name){
            this.data = []
            this.data_label = []
            this.tab = name 
            this.get_data(name)
        },
        get_data(name){
            // axios.get(`api/mypage/${name}/data`).then(response => {
            //     console.log(response);
            //     this.month_data = response.data.data
            //     this.month_data_label = response.data.data_label
            // })
        },
        get_chart(){
            console.log("チャートの取得")
            axios.get(`api/mypage`).then(response => {
              
                console.log('mypage',response);
                
                // 月別データ
                this.month_data = response.data.month_data
                this.month_data_label = response.data.month_data_label
                
                // 先月のデータ
                this.last_month_data = response.data.last_monnt_data
                this.last_month_data_label = response.data.last_month_data_label
                
                // 時間別データ
                this.time_data = response.data.time_data
                this.time_data_label = response.data.time_data_label
                
                
                
                // this.month_data_total = this.get_sum(this.month_data)
                // this.last_month_data_total = this.get_sum(this.last_month_data)
                
                // this.active_data = this.get_active_data(this.month_data_label.length)
                
                
                // // 最新5件のデータ
                this.new_data = response.data.new_data
                
                // カテゴリー別割合
                this.category_data = response.data.category_data
                this.category_data_label = response.data.category_data_label
                this.category_data_color = response.data.category_data_color
                
                // 募金額
                // this.coin_data = response.data.coin_data
                // this.coin_data_label = response.data.coin_data_label
                
                // this.day_data = response.data.day_data
                this.day_data = this.get_change_date( response.data.day_data)
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
        // どのくらい利用しているか？
        get_active_data(data){
            var days = 30 - data
            return [data, days];
        },
        
        get_change_date(data){
            var list =[]
            for (var i = 0; i< data.length; i++ ) {
                let time = new Date(data[i])
                list.push(time);
            }
            return list;
        }
        
    },
    created(){
        this.get_data(this.tab)
        this.get_chart()
    }
}
</script>
