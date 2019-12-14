<template>
    <div class="">
    
    
        
        <!--ヘッダー-->
        <div class="row MyBar">
        
            <div class="col-3 card p-3 MyBar__item">
                <h5 class="MyBar__title"><b>データ今月の射精回数</b></h5>
                <span  class="MyBar__content">{{ msg }}</span>
                <span  class="MyBar__content2">先月との比較　24%</span>
            </div>
            
            <div class="col-3 card p-3 MyBar__item ">
                <h5 class="MyBar__title"><b>データ平均射精回数</b></h5>
                <span  class="MyBar__content">{{ msg }}</span>
                <span  class="MyBar__content2">先月との比較　24%</span>
            </div>
            
            <div class="col-3 card p-3 MyBar__item">
                <h5 class="MyBar__title"><b>データ消費カロリ-</b></h5>
                <span  class="MyBar__content">{{ msg }}</span>
                <span  class="MyBar__content2">先月との比較　24%</span>
            </div>
            
            <div class="col-3 card p-3 MyBar__item ">
                <h5 class="MyBar__title"><b>データ合計支援金</b></h5>
                <span  class="MyBar__content">{{ msg }}</span>
                <span  class="MyBar__content2">先月との比較　24%</span>
            </div>
        </div>
        
        <!--メインA-->
        <div class="card">
            <div class="row "> 
            
                <div class="col-9  p-5">
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
                
                
                     <Bar 
                        :dataSet="data"
                        :labels="data_label"
                        />
                </div>
                <div class="col-3  p-5">
                    <h5>合計射精回数</h5>
                        <span>15</span>
                    <h5>合計支援金</h5>
                        <span>145</span>
                    <h5>合計支援金</h5>
                        <span>8515</span>
                    <h5>今月の射精回数</h5>
                    <h5>今月の射精回数</h5>
                    <span>(可変するように設定する)</span>
                </div>
            </div>
        </div>
        
        
        
        <div class="row">
            <div class="col-4">
                
                <!--日付のデータ-->
                <div class=" card p-5">
                    <span>日付のデータ</span>
                    <Dateitem 
                        :dataSet="month_data"
                        :labels="month_data_label" 
                     />
                </div>
                
                
                <!--カレンダー-->
                <div  class="card_p-4">
                
                    <!--<Calendar v-if="day_data"-->
                    <!--    :labels="day_data"-->
                    <!--    />-->
                </div>
                
            </div>
            
            
            <div class="col-4 ">
            
            
                <!--一か月の利用頻度（円グラフ）-->
                <div class=" card ">                    
                    <h4><b>円グラフ（一か月の利用頻度</b></h4>  
                    <Doughnut 
                        :dataSet="time_data"
                        :labels="time_data_label"
                    />
                    <div class="col-6">当月日数</div>
                    <div class="col-6">利用日数</div>
                </div>
                
                
                <!--カテゴリーグラフ-->
                <div class=" card p-5">
                    <h4><b>時間帯別利用指数</b></h4>      
                    <Bar 
                        id="time"
                        :dataSet="time_data"
                        :labels="time_data_label"
                    />
                </div>
            </div>
            
            
            <div class="col-4 ">
                <div class=" card ">
                        <Table  :dataSet="new_data" />
                    </div>
                    
                <!--<div class=" card ">-->
                <!--    <h4><b>Timeグラフ（24時間の頻度）</b></h4>-->
                <!--    <Bar -->
                <!--        id="time"-->
                <!--        :dataSet="time_data"-->
                <!--        :labels="time_data_label"-->
                <!--    />-->
                <!--</div>-->
            </div>
        </div>
    
        
    </div>
</template>
<style type="text/css">
.Chart_title{
    padding: 12px;
    background-color: #fafafa;
    color:gray;
    font-weight: bold;
    border-bottom: 1px solid whitesmoke ;
}
.Chart_title i{
    margin-right: 15px;
}
.Chart_content{
    padding: 10px;
}
.MyBar{}
.MyBar__item{
    color:gray;
}
.MyBar__content{
    text-align: right;
    font-size: 35px;
    font-weight: bold;
    color: black;
    /*position:relative;*/
}
.MyBar__content2{
    text-align: right;
}
</style>
<script>

import Bar from '../charts/Bar.vue'
import BarLine from '../charts/BarLine.vue'
import Doughnut from '../charts/Doughnut.vue'
import BarHorizontal from '../charts/BarHorizontal.vue'
import Table from '../components/Table.vue'
import Dateitem from './Date.vue'

// import Calendar from '../components/user/Calendar.vue'


export default {
    components: { Bar, BarLine ,Doughnut, BarHorizontal, Table, Dateitem,  },
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
            day_data: []
            
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
            axios.get(`api/mypage/${name}/data`).then(response => {
                console.log(response);
                this.data = response.data.data
                this.data_label = response.data.data_label
            })
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
                
                // // カテゴリーデータ
                // this.category_data = response.data.category_data
                // this.category_data_label = response.data.category_data_label
                
                // // 最新5件のデータ
                // this.new_data = response.data.new_data
                
                // console.log("マイページ",this.month_data_total , this.last_month_data_total, this.active_data)
                
                // this.day_data = []
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
            for (var i = data.length; i--; ) {
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
