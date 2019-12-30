<template>
    <div >
    
    
 
        <div class="row "> 
            <div class="col-lg-9">
                
                <!--ユーザーばー-->
                <UserBar 
                    :total_all="all_count"
                    :total_month="month_count"
                    :total_calorie="calorie_count"
                    :total_donation="donation_count"
                />
                
            
                <!--メインチャート-->
                <div class="card">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <h3 class="d-inline-block">
                        <span v-if="tab === 'month' ">月別</span>
                        <span v-if="tab === 'year' ">年間</span>
                        <span v-if="tab === 'all' ">すべての</span>
                        利用推移</h3>
                        
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item ">
                                    <span @click="selectTab('month')" class="mainchart__item">今月</span>
                                </li>
                                <li class="nav-item ">
                                    <span @click="selectTab('year')" class="mainchart__item">年間</span>
                                </li>
                                <li class="nav-item ">
                                    <span @click="selectTab('all')" class="mainchart__item">すべて</span>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <Lines 
                        id="line1"
                        :dataSet="data"
                        :labels="data_label"
                    />
                </div>
                
                
                <!--サブチャート-->
                <div class="row">
                
                
                    <!--過去6か月の比較-->
                    <div class="col-sm-7 card">
                        <nav class="navbar navbar-expand-lg navbar-light pt-3">
                            <h4 class="d-inline-block"><b>6か月の比較</b></h4>  
                            
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item ">
                                        <span class="Chart__label bg__red"></span>
                                        <span>ユーザー</span>
                                    </li>
                                    <li class="nav-item ">
                                        <span class="Chart__label bg__gray"></span>
                                        <span>みんな</span>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <Bar 
                            id="bar"
                            :dataSet="six_month_data"
                            :dataTime="other_month_data"
                            :labels="six_month_data_label"
                        />
                    </div>
                    
                    
                
                    <!--一か月の利用頻度（円グラフ）-->  
                    <div class="col-sm-5 card">         
                        <h4 class="text-center p-3"><b>一か月の利用比率</b></h4>  
                 
                        <div class="Mypage__Doughnut">
                            <Doughnut 
                                :borderWidth="70"
                                :dataSet="active_data"
                                :labels="active_data"
                            />
                            <span class="Mypage__Doughnut__title">{{ active_ratio }} <small>%</small></span>
                        </div>
                        <div class="text-center mt-4">
                            <span class="Chart__label bg__gray"></span> 
                            <span>非利用日数　{{ today - month_data_label.length }}日</span>
                            <span class="Chart__label bg__red"></span> 
                            <span>使用日数 {{ month_data_label.length }}日</span>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                
                    <div class="col-sm-4 card p-3 text-center">
                        <!--<span>何らかのグラフ・データ</span>-->
                        <h4 class="text-center mt-5"><b>弟子入り数</b></h4>
                        
                        <h1 class="mt-1"><b>{{ follower_count }}</b><small>pupil</small></h1>
                        <span>Followers</span>
                    </div>
                    
                    <div class="col-sm-5 card p-3 ">
                        <h4 class="text-center"><b>カテゴリー別グラフ</b></h4>
                        <BarHorizontal 
                            id="category"
                            :dataSet="category_data"
                            :dataBackgroundColor="category_data_color"
                            :labels="category_data_label"
                        />
                    </div>
                    
                    <div class="col-sm-3 card p-3 text-center">
                        <span class="rounded-pill bg__red p-1">平均利用時間</span>
                        <h2 class="d-inline-block"><b>25</b>hour</h2>
                    </div>
                    
                </div>
                
                
                <!--レスポンシブで表示されるようにする-->
                <!--<div class="card">-->
                <!--    <Table  :dataSet="new_data" />-->
                <!--</div>-->
                    
                <!--<div>-->
                <!--    <img src="/image/mypage-image.jpg"></img>-->
                <!--</div>-->
                
                    
            </div>
            
            
            <!--サイドバー-->
            <div class="col-lg-3 pl-3">
        
                    <!--カレンダー-->
                    <div class=" card ">
                        <CalendarTest  
                        :dataSet="day_data"
                        />
                    </div>
                    
                    
                    
                    <!--レベル・ユーザーステータスになるもの-->
                    <div class=" card p-2 text-center">
                        <h3 class=""><b>Lev.{{ currentUser.level }}</b></h3>
                        <small>次のレベルまであと{{ currentUser.experience_point - currentUser.point }}pint</small>
                    </div>
                    
                    
                    
                    
                    <!--ユーザーテーブル-->
                    <nav class="navbar navbar-expand-lg navbar-light p-0 mb-2">
                        <span>最新記録</span>
                        
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item "><span>（5件）</span></li>
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
                                                <i class="fas fa-sun mr-2"></i>{{ item.category_name }}
                                            </span>
                                            <span>募金 {{ item.coin }}円</span>
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
.mainchart__item{
    cursor: pointer;
}
</style>
<script>

import Bar from '../charts/Bar.vue'
import BarLine from '../charts/BarLine.vue'
import Lines from '../charts/Line.vue'
import Doughnut from '../charts/Doughnut.vue'
import BarHorizontal from '../charts/BarHorizontal.vue'
import Table from '../components/Table.vue'

// import Calendar from '../components/user/Calendar.vue'

// UserBar
import HomeBar from '../components/home/HomeBar.vue'
import UserBar from '../components/user/UserBar.vue'
import CalendarTest from '../components/user/CalendarTest.vue'

export default {
    components: { Bar, BarLine ,Doughnut, BarHorizontal,
    Table, HomeBar,Lines , UserBar,CalendarTest},
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    data(){
        return{
            tab: 'year',
            data: [],
            data_label: [],
            today: new Date().getDate(),
            
            // メインデータ
            data: [],
            data_label:[],
            
            // 月のデータ
            month_data: [],
            month_data_label:[],
            
            //過去6ヶ月のデータ
            six_month_data: [],
            six_month_data_label:[],
            other_month_data: [],
            
            month_data_total: 0,    　 //1カ月の利用回数
            last_month_data_total: 0, //先月の利用回数
            
            time_data: [],
            time_data_label: [],
            
            active_data: [], //利用頻度
            active_ratio: 0, //利用頻度
            
            
            new_data: [], //最新の5件のデータ
            day_data: [],
            
            
            
            // カテゴリー別データ
            category_data:[],
            category_data_label:[],
            category_data_color: [],
            
            // UserBar1のデータ
            all_count: 0,
            month_count: 0,
            calorie_count: 0,
            donation_count: 0,
            follower_count: 0,
            
        }
    },
    methods: {
        selectTab(name){
            this.data = []
            this.data_label = []
            this.tab = name 
            this.get_select_data(name)
        },
        get_select_data(name){
            axios.get(`api/mypage/${name}/data`).then(response => {
                console.log('mypage-select',response);
                this.data = response.data.data
                this.data_label = response.data.data_label
            })
        },
        get_data(){
            console.log("チャートの取得")
            axios.get(`api/mypage`).then(response => {
              
                console.log('mypage',response);
                
                // 月別データ
                this.month_data = response.data.month_data
                this.month_data_label = response.data.month_data_label
                
                // 過去6ヶ月のデータ
                this.six_month_data = response.data.six_month_data
                this.six_month_data_label = response.data.six_month_data_label
                this.other_month_data = response.data.other_month_data
                
                // 一か月の利用データ推移
                this.active_data = this.get_active_data(this.month_data_label.length)
                
                // カテゴリー別割合
                this.category_data = response.data.category_data
                this.category_data_label = response.data.category_data_label
                this.category_data_color = response.data.category_data_color
                
                // // 最新5件のデータ
                this.new_data = response.data.new_data
                
                // 日付のデータ
                this.day_data = this.get_change_date( response.data.day_data)
                
                this.all_count = response.data.all_count
                this.month_count = response.data.month_count
                this.calorie_count = response.data.month_count * 48.5
                this.donation_count = response.data.donation_count.count //ここだけ特殊
                this.follower_count =  response.data.follower_count 
                
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
            this.remain_day = this.today - data
            this.active_ratio = Math.round( data / this.today *100) 
            return [data, this.remain_day];
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
        this.get_select_data(this.tab)
        this.get_data()
    }
}
</script>
