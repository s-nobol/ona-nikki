<template>
<div>
        <!--ロケーションメイン-->
        <div v-if="! select" class="card">
           
            <h3 class="about__title mt-5 mb-3">
               <b>地域ごとの利用記録</b>
            </h3>
           
            <div class="w-50 m-auto">
                <Map @clickMap="chengeLocation" />
                   
                <div class="text-center mb-5">
                    <span v-for=" item in location" @click="onchangeSelect(item)" class="location_item ">{{ item }}</span>
                </div>
            </div>
        
        </div>
       
       
       
       <!--ロケーションメイン-->
        <transition name="fade" >
        <div v-if="select" class="card about__continer__bg ">
           
           <div class="text-right">
               <button class="btn btn-light" @click="select = null">戻る</button>
           </div>
           
           <div class="about__continer">
           
           
            <h3 class="about__title mb-5">
               <b>{{ select }}にお住まいの賢者様について</b>
               
            </h3>
           
           
           <div class="row mb-5">
               <div class="col-sm-6 ">
                   <img src="/image/kyushu.png" class="location_image"alt="">
               </div>
               
               <div class="col-sm-6">
               
                   <!--年代別グラフ-->
                   <h5>年齢と相関図</h5>
                   <BarHorizontal 
                        id="age"
                       :dataSet="age_data"
                       :labels="age_data_label"
                   />
                   
                   
                   <!--性別グラフ-->
                   <h5>性別ごとの利用割合</h5>
                   <div class="pl-3 pr-3">
                   <Doughnut 
                        :borderWidth="80"
                        :dataSetSex="sex_data"
                        :labels="sex_data_label"
                   />
                   </div>
               </div>
                   
                   
               <div class="col-lg-6 ">
               </div>
               <div class="col-lg-6 ">
                    <!--コメント-->
                    <div class="media">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">年齢について</h5>
                            {{ select }}地方に在住の賢者さまは、合計{{ sex_data_sum }}人です。
                            これは全国のユーザーの内15％を示しています。
                            また、性別ごとに比較すると{{ sex_data_label[0] }}性の賢者様{{ sex_data[0] }}人、
                            {{ sex_data_label[1] }}性の賢者様{{ sex_data[1] }}人で
                            {{ sex_data_label[0] }}性の賢者様の利用人数が多い結果となりました。
                            </span>
                        </div>
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                    </div>
               </div>
           </div>
            
           
            <h3 class="about__title mb-5">
               <b>全国との比較</b>
            </h3>
            
            
           <div class="row mb-5">
               <div class="col-lg-6">
                   <h5>利用者数の推移と平均利用率</h5>
                   <BarLine 
                       :lineDataSet="month_data_all"
                       :barDataSet="month_data"
                       :labels="month_data_label"
                   />
                   
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">利用者数の推移について</h5>
                            {{ select }}地方の月額平均利用回数は{{ month_data_avg }}回です。
                            全国の利用回数（{{ other_month_data_avg }}回）と比較すると
                            <span v-if="month_data_avg > other_month_data_avg ">やや多い</span>
                            <span v-if="month_data_avg < other_month_data_avg ">やや少ない</span>
                            結果となりました。
                            
                            </span>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="col-lg-6 display_lg-none">
                    <img src="/image/kyushu.png" class="location_image"alt="">
                </div>
                
                   
                
                
            </div>
                     
                     
                       
            <div class="text-center">
                <span v-for=" item in location" @click="onchangeSelect(item)" class="location_item ">{{ item }}</span>
            </div>
       
       </div>
       
       
   </div>
        </transition>
</div>
</template>
<style type="text/css">
.location_image{
    width:100%;
} 
.location_item{
    padding: 5px;
    cursor: pointer; 
}
</style>
<script>
import Map from '../components/Map.vue'
import BarHorizontal from '../charts/BarHorizontal.vue'
import Doughnut from '../charts/Doughnut.vue'
import BarLine from '../charts/BarLine.vue'
export default {
    components: {  BarHorizontal, Doughnut, BarLine, Map },
    data(){
        return{
            tab: 'task',
            location: [],
            locations: ['北海道エリア',
                 '東北エリア','関東エリア',
                '中部エリア','関西エリア',
                 '中国エリア','四国エリア',
                 '九州エリア',],
            select: null,
            
            msgs: [],
            
            //年齢ごとデータ
            age_data: [],
            age_data_label: [],
            
            //性別ごとデータ
            sex_data: [],
            sex_data_label: [],
            sex_data_sum: null,
            
            //月額平均データ
            month_data: [],
            month_data_label: [],
            month_data_all: [],
            month_data_avg: null,
            
            other_month_data:[],
            other_month_data_avg: null
        }
    },
    methods: {
        chengeLocation(name){
            alert("ロケーション変更"+name)
            this.onchangeSelect(name)
        },
        get_location(){
            axios.get(`/api/locations`).then(response => {
                console.log('地域の名前取得',response);
                this.location = response.data.location
            })
        },
        onchangeSelect(name){
            if(this.select && this.select === name ){
                return false
            }
            this.select = name
            axios.get(`/api/location/${name}`).then(response => {
                console.log('location',response);
                
                // 年齢
                this.age_data = response.data.age_data
                this.age_data_label = response.data.age_data_label
                
                // 性別
                this.sex_data = response.data.sex_data
                this.sex_data_label = response.data.sex_data_label
                this.sex_data_sum = this.get_sum(this.sex_data)
                
                // 月ごとのデータ
                this.month_data = response.data.month_data
                this.month_data_label = response.data.month_data_label
                this.month_data_all = response.data.month_data_all
                this.month_data_avg = this.get_ave(this.month_data)
                this.other_month_data_avg = this.get_ave(this.month_data_all)
                
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
            return Math.round( this.get_sum(data)/data.length );
        },
    }, 
    
    created(){
        this.get_location()
    }
}
</script>

<!--onClickButton(){-->
<!--    window.setTimeout(this.hanoi(3,'A','B','C'), 500)-->
<!--    // window.setTimeout(this.hanoi2(3), 500)-->
<!--},-->