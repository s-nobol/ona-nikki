<template>
    <div>
        <!--チャートを入力-->
        <div class="card">
            <ul class="Statusbar">
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">今月の射精回数</span>
                    <span class="Statusbar__item__content">
                        {{ month_data_total }}
                        <small>回</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">本日の射回数</span>
                    <span class="Statusbar__item__content">
                        {{ 2 }}
                        <small>回</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">平均精回数</span>
                    <span class="Statusbar__item__content">
                        {{ 15 }}
                        <small>Ave</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">合計支援金</span>
                    <span class="Statusbar__item__content">
                        {{ month_data_total * 5  }}
                        <small>円</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">消費カロリー</span>
                    <span class="Statusbar__item__content">
                        {{ month_data_total * 48 }}
                        <small>cal</small>
                    </span>
                </li>
            </ul>
        </div>
    
        
        <!--今月のデータグラフ-->
        <div class="card">
            <h1><i class="fas fa-braille fa-lg"></i><i class="fas fa-th"></i>グラフ(棒・折れ線)</h1>
            <div>
                <span @click="selectTab('month')">今月</span>
                <span @click="selectTab('year')">年間</span>
                <span @click="selectTab('all')">すべて</span>
            </div>
            <div class="tab">
                <Bar 
                :dataSet="data"
                :labels="data_label"
                />
            </div>
        </div>
        
        
               
        <!--今月と先月の比較-->
        <div class="row ">
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>月別射精回数</span>
                    <strong>{{ last_month_data_total }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ (month_data_total / last_month_data_total  -1 ) * 100 }}<small>%</small></span>
                </div>
            </div>
            
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>平均射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>%</small></span>
                </div>
            </div>
            
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>利用日数</span>
                    <strong>{{ last_month_data_label.length }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ (month_data_label.length / last_month_data_label.length  -1 ) * 100 }}
                    <small>%<i class="fas fa-level-up-alt"></i></small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>ランキング</span>
                    <strong>Lv.{{ msg }}</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>位</small></span>
                </div>
            </div>
        </div>
        
               
        <!--今月と先月の比較-->
        <div class="row">
            <div class="col-3 card StatusCard">
            
                <div class="StatusCard__title">
                    <span class="">消費カロリー指数</span>
                    <strong>先月{{ last_month_data_total * 48 }}cal</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ month_data_total * 48 }}<small>cal</small></span>
                </div>
            </div>
            
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>支援金</span>
                    <strong>先月￥{{ last_month_data_total * 5 }}円</strong>
                </div>
                <div class="StatusCard__content">
                    <span>￥{{  month_data_total * 5  }}<small>円</small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>ランキング</span>
                    <strong>{{ msg }}</strong>
                </div>
                <div class="StatusCard__content">
                    <small>15位</small><i class="fas fa-arrow-right "></i><small>8位</small>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>レベル</span>
                    <strong>Lv.{{ msg }}</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>.Lv</small></span>
                </div>
            </div>
        </div>
               
        <!--3つのグラフ-->
        <div class="row">
            <div class="col-4 card">
               
                <div class="Chart_title">
                    <span><i class="fas fa-chart-bar fa-lg"></i>平均利用日数推移</span>
                    <span>{{ active_data[0] }} 日</span>
                </div>
                <div class="Chart_content ">
                </div>
       
            </div>
            <div class="col-4 card">
                <div class="Chart_title">
                    <span><i class="fas fa-chart-pie fa-lg"></i>利用日数</span>
                    <span>{{ active_data[0] }} 日</span>
                </div>
                <div class="Chart_content ">
                    <div class="DoughnutChart">
                        <Doughnut 
                            :dataSet="active_data"
                            />
                        <span class="DoughnutChart__content">{{ active_data[0]  }} </span>
                    </div>
                </div>
            </div>
            <div class="col-4 card">
                <div class="Chart_title">
                    <span><i class="fas fa-cloud-sun fa-lg"></i>時間帯別利用グラフ</span>
                </div>
                <div class="Chart_content ">
                    <Bar 
                        id="time"
                        :dataSet="time_data"
                        :labels="time_data_label"
                    />
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-6 card">
                <div class="Chart_title">
                    <span><i class="fas fa-sitemap fa-lg"></i>カテゴリー別利用データ</span>
                    <span> ( {{ category_data.length }} ) </span>
                </div>
                <div class="Chart_content">
                    <BarHorizontal 
                        :dataSet="category_data"
                        :labels="category_data_label"
                    />
                </div>
            </div>
            <div class="col-6 card">
                <div class="Chart_title">
                    <span>最新のデータ</span>
                    <!--<span>{{ active_data[0] }} 日</span>-->
                </div>
                <div class="Chart_content ">
                    <Table  :dataSet="new_data" />
                </div>
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
</style>
<script>

import Bar from '../charts/Bar.vue'
import BarLine from '../charts/BarLine.vue'
import Doughnut from '../charts/Doughnut.vue'
import BarHorizontal from '../charts/BarHorizontal.vue'
import Table from '../components/Table.vue'
export default {
    components: { Bar, BarLine ,Doughnut, BarHorizontal, Table },
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
            
            new_data: [] //最新の5件のデータ
            
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
              
                console.log(response);
                
                // 月別データ
                this.month_data = response.data.month_data
                this.month_data_label = response.data.month_data_label
                
                // 先月のデータ
                this.last_month_data = response.data.last_monnt_data
                this.last_month_data_label = response.data.last_month_data_label
                
                // 時間別データ
                this.time_data = response.data.time_data
                this.time_data_label = response.data.time_data_label
                
                this.month_data_total = this.get_sum(this.month_data)
                this.last_month_data_total = this.get_sum(this.last_month_data)
                
                this.active_data = this.get_active_data(this.month_data_label.length)
                
                // カテゴリーデータ
                this.category_data = response.data.category_data
                this.category_data_label = response.data.category_data_label
                
                // 最新5件のデータ
                this.new_data = response.data.new_data
                console.log("マイページ",this.month_data_total , this.last_month_data_total, this.active_data)
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
        }
        
    },
    created(){
        this.get_data(this.tab)
        this.get_chart()
    }
}
</script>
