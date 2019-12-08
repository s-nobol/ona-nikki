<template>
<div>
        <!--ランキング-->
        <h5><b>location</b></h5>
        <!--<div v-if="msgs">-->
        <!--    <div v-for="msg in msgs">{{ msg }}</div>-->
        <!--</div>-->
        <!--<div><button class="btn btn-primary" @click="onClickButton">送信</button></div>-->
       
       <div class="">
           <span v-for=" item in location" @click="onchangeSelect(item)" class="location_item ">{{ item }}</span>
           <span v-for=" item in locations" @click="onchangeSelect(item)" class="location_item ">{{ item }}</span>
       </div>
       
       <div v-if="! select" class="card">
           <div class="w-50 m-auto pt-5">
               <img src="/image/map.png" class="location_image"></img>
               
               <div class="text-center">
                   <span>北海道　四国</span>
               </div>
           </div>
           
           まだ何も選択されていません
       </div>
       
       
       
       <!--ロケーションメイン-->
       <div v-if="select" class="card about__continer__bg">
       
           <div class="about__continer">
           
           
            <h3 class="about__title mb-5">
               <b>{{ select }}の自慰事情について</b>
            </h3>
           
           
           <div class="row mb-5">
               <div class="col-6 ">
                   <img src="/image/kyushu.png" class="location_image"alt="">
               </div>
               
               <div class="col-6">
                   <h5>年齢と相関図</h5>
                   <BarHorizontal 
                       :dataSet="age_data"
                       :labels="age_data_label"
                   />
                   <h5>性別ごとの利用割合</h5>
                   <Doughnut 
                       :dataSet="sex_data"
                       :labels="sex_data_label"
                   />
                <div class="media">
                    <div class="media-body">
                        <span>
                        <h5 class="mt-0">年齢について</h5>
                        テストテストテストテストテストテストテスト
                        テストテストテストテストテストテストテストテスト
                        テストテストテストテストテストテストテストテスト
                        テストテストテストテストテスト
                        </span>
                    </div>
                    <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                </div>
               </div>
           </div>
            
           <!--<h3 class="about__title mb-5">全国との比較</h3>-->
           
            <h3 class="about__title mb-5">
               <b>全国との比較</b>
            </h3>
            
            
           <div class="row ">
               <div class="col-6">
                   <h5>利用者数の推移と平均利用率</h5>
                   <!--<span>利用者数の推移と平均利用率</span>-->
                   <BarLine 
                       :lineDataSet="month_data_all"
                       :barDataSet="month_data"
                       :labels="month_data_label"
                   />
            <!--<div class="w-50 m-auto">-->
                    <div class="media">
                        <img class="align-self-start mr-3 myimage" src="/image/kairakuten.png" alt="">
                        <div class="media-body">
                            <span>
                            <h5 class="mt-0">利用者数の推移について</h5>
                            テストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテストテストテストテスト
                            テストテストテストテストテスト
                            </span>
                        </div>
                    </div>
                <!--</div>-->
                </div>
               
                <div class="col-6 ">
                    <img src="/image/kyushu.png" class="location_image"alt="">
                </div>
            </div>
               
           
       </div>
       
       
   </div>
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
import BarHorizontal from '../charts/BarHorizontal.vue'
import Doughnut from '../charts/Doughnut.vue'
import BarLine from '../charts/BarLine.vue'
export default {
    components: {  BarHorizontal, Doughnut, BarLine },
    data(){
        return{
            tab: 'task',
            location: [],
            locations: [
                 '北海道エリア',
                 '東北エリア',
                 '関東エリア',
                '中部エリア',
                 '関西エリア',
                 '中国エリア',
                 '四国エリア',
                 '九州エリア',
            ],
            select: null,
            
            msgs: [],
            age_data: [],
            age_data_label: [],
            sex_data: [],
            sex_data_label: [],
            
            month_data: [],
            month_data_label: [],
            month_data_all: []
        }
    },
    methods: {
        
        get_location(){
            axios.get(`/api/locations`).then(response => {
                console.log(response);
                this.location = response.data.location
            })
        },
        onchangeSelect(name){
            if(this.select && this.select === name ){
                return false
            }
            this.select = name
            axios.get(`/api/location/${name}`).then(response => {
                console.log(response);
                this.age_data = response.data.age_data
                this.age_data_label = response.data.age_data_label
                
                this.sex_data = response.data.sex_data
                this.sex_data_label = response.data.sex_data_label
                
                this.month_data = response.data.month_data
                this.month_data_label = response.data.month_data_label
                this.month_data_all = response.data.month_data_all
                
            })
        }
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
<!--hanoi( n, from, to, task ){-->
<!--    if(n > 0 ){-->
<!--        // this.msgs.push(`n=${n-1}の円盤  ${from} => ${to} へ移動 `)-->
<!--        this.hanoi(n-1, from, task, to )-->
<!--        this.msgs.push(`n=${n-1}の円盤  ${from} => ${to} へ移動 `)-->
<!--        this.hanoi(n-1, task, to, from)-->
<!--    }-->
<!--},-->