<template>
<div class="">
        
        <div >
            <div class="card_item card">
                <div class="row ">
                    <div class="col-3 text-center">
                        <i class="fas fa-globe-americas fa-3x "></i>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >合計射精回数</span> 
                            <h4 class="card-title ">
                                <b>1580</b><small>回</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        
            
            <div class="card_item card">
                <div class="row ">
                    <div class="col-3 text-center">
                        <i class="fas fa-globe-americas fa-3x"></i>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >合計射精回数</span> 
                            <h4 class="card-title">
                                <b>548</b><small>回</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        
            
            <div class="card_item card bg__blue">
                <div class="row ">
                    <div class="col-3 text-center">
                    <i class="fas fa-male fa-3x "></i>                    
                    </div>
                    <div class="col-9">
                        <div class="card-body ">
                            <span >男性利用数</span> 
                            <h4 class="card-title ">
                                <b>578</b><small>回</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        
            
            <div class="card_item card bg__woman">
                <div class="row ">
                    <div class="col-3 text-center">
                        <i class="fas fa-female fa-3x "></i>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >女性利用数</span> 
                            <h4 class="card-title ">
                                <b>78</b><small>回</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="card_item card bg__green">
                <div class="row ">
                    <div class="col-3 text-center ">
                    <i class="fas fa-yen-sign  fa-3x"></i>                    
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <span >合計支援金</span> 
                            <h4 class="card-title ">
                                <b>688</b><small>円</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
        
        
        <div class="row ">
            <div class="col-9">
                    
                    
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
            
                 <div class="row ">
                    <!--ここになにか　いれるかも？-->
                    <div class="col-6 card p-4">
                        <span>ここ一週間の利用者推移</span>
                        <Lines 
                            :dataSet="week_data"
                            :labels="week_data_label"
                        />
                    </div>
                    
                    <div class="col-6 card p-4">
                        <span>カロリ-別推移</span> 
                        <Lines 
                            id="cal"
                            :dataSet="week_data"
                            :labels="week_data_label"
                        />
                    </div>
                 </div>
            
            </div>
            
            
            
            <!--サイドバー-->
            <div class="col-3 ">
                <h4 class="card p-3">それでいい</h4>
                <div class="card p-3">
                      <h4 class="">タイムライン</h4>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                    <span>Twitterタイムライン</span>
                </div>
                <!--<Rightbar />    -->
                <div class="card">
                    <h4 class="ranking_card">総合ランキング</h4>
                    <div class="pr-4 pl-4">
                       <Ranker 
                            :dataSet="ranking_data"
                        />
                    </div>
                </div>
                
                <div class="card p-4">
                    <span>時間帯別利用利用推移</span>
                    <Bar
                        :timeData="time_data"
                        :labels="time_data_label"
                    />
                </div>
                
                
            </div>
        </div>
    
        
        
        
        
        
        <!--利用ユーザー　最新5件-->
        <div class="row">
            <div class="col-3 card ">
                    <h4 class="ranking_card">総合ランキング</h4>
                <div class="pr-4 pl-4">
                   <Ranker 
                        :dataSet="ranking_data"
                    />
                </div>
            </div>
           
            <div class="col-3 card p-5">
                <span>利用ユーザー　年齢比率</span>    <Lines 
                id="calories"
                :Calories="week_data"
                :labels="week_data"
            />      
            <Lines 
                id="coin"
                :Coins="week_data"
                :labels="week_data"
            />
            </div>
            
            <div class="col-6 card p-5">
                <span>利用ユーザー　最新5件</span>
        
            </div>
        </div>
        
        
        
    
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
export default {
    components: { Bar, BarLine ,Doughnut, Lines, BarHorizontal, Table, Ranker},
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