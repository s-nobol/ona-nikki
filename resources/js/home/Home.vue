<template>
    <div>
        
        <div class="row ">
            <div class="col-3 card bg_indigo ">
                <h3>今日の合計射精回数</h3>
            </div>
            <div class="col-3 card bg-success">
                <h3>今日の平均射精回数</h3>
            </div>
            <div class="col-3 card bg-primary text-white">
                <h3>男性の利用者</h3>
                <span v-if="sex_data">{{sex_data[0]}}</span>
            </div>
            <div class="col-3 card bg__red">
                <h3>女性の利用者</h3>
                <span v-if="sex_data">{{sex_data[1]}}</span>
            </div>
        </div>
    
        <!--ランキング-->
        <div class="card">
           
            <div class="row ">
                <div class="col-4 ">
                    <div>
                        <!--<h5><b>横グラフ</b></h5>-->
                        <BarHorizontal 
                            :dataSet="location_data"
                            :labels="location_data_label"
                        />
                    </div>
                    <div>
                        <span>男女別割合</span>
                        <Doughnut 
                            :dataSet="sex_data"
                            :labels="sex_data_label"
                        />
                    </div>
                </div>
                <div class="col-7 pt-5 pb-5">
                   <img src="/image/map.png" class="map__image"></img>
                </div>
            </div>
        </div>
        
        <!--利用ユーザー　最新5件-->
        <div class="row ">
            <div class="col-4 card p-4">
                <span>総合ランキング</span>
                <Ranker 
                    :dataSet="ranking_data"
                />
            </div>
            
            <div class="col-4 card p-5">
                <span>利用ユーザー　最新5件</span>
            </div>
            
            <div class="col-4 card p-5">
                <span>利用ユーザー　最新5件</span>
            </div>
        </div>
        <!--利用ユーザー　最新5件-->
        <div class="row ">
            <div class="col-8 card ">
                <h4>7日間の伸び率（折れ線グラフ）</h4>
                <Lines 
                    :dataSet="week_data"
                    :labels="week_data_label"
                />
            </div>
            <div class="col-4 card ">
                <h4>利用が多い時間帯（棒グラフ）</h4>
                <Bar
                    :dataSet="time_data"
                    :labels="time_data_label"
                />
            </div>
        </div>
        
    
    
    </div>
</template>
<style type="text/css">
    .map__image{
        width: 100%;
    }
    .bg_indigo{
        background-color: mediumseagreen;
        color:white;
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
export default {
    components: { Bar, BarLine ,Doughnut, Lines, BarHorizontal, Table ,Ranker},
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
                console.log(response);
                this.data = response.data.data
                this.data_label = response.data.data_label
                this.location_data = response.data.location_data
                this.location_data_label = response.data.location_data_label
                this.sex_data = response.data.sex_data
                this.sex_data_label = response.data.sex_data_label
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