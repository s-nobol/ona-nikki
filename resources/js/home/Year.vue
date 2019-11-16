<template>
    <div>
       <!--ランキング-->
       <h5><b>year</b></h5>
       
       
       <div class="card ">
           <h4>{{ year }} 年月別射精回数グラフ</h4>
           <img src="/image/chart.jpg"></img>
       </div>
       
       <div class="row">
           <div class="col-4  card StatusCard">
               <span class="StatusCard__title">総合射精回数</span>
               <span class="StatusCard__content">1544<small>回</small></span>
           </div>
           <div class="col-4  card StatusCard">
               <span class="StatusCard__title">月別平均射精回数</span>
               <span class="StatusCard__content">1588<small>回</small></span>
           </div>
           <div class="col-4  card StatusCard">
               <span class="StatusCard__title">総合射精回数</span>
               <span class="StatusCard__content">15<small>回</small></span>
           </div>
       </div>
       <div class="row">
           <div class="col-4  card StatusCard">
               <span class="StatusCard__title">総合射精回数</span>
               <span class="StatusCard__content">1544<small>回</small></span>
           </div>
           <div class="col-4  card StatusCard">
               <span class="StatusCard__title">月別平均射精回数</span>
               <span class="StatusCard__content">1588<small>回</small></span>
           </div>
           <div class="col-4  card StatusCard">
               <span class="StatusCard__title">総合射精回数</span>
               <span class="StatusCard__content">15<small>回</small></span>
           </div>
       </div>
       
       <!--性別ごとの統計（いらない？）-->
       <div class="row">
           <div class="col-8">
               <!--男女別の月ごとの利用統計-->
               <img src="/image/chart.jpg"></img>
           </div>
           <div class="col-4">
               <div class="man card p-5">
                   <span></span>
               </div>
               <div class="woman card p-5">
                   <span></span>
               </div>
               
           </div>
       </div>
       
       <!--性別ごとの統計（いらない？）-->
       <div class="row">
           <div class="col-6">
               <!--男女別の月ごとの利用統計-->
               <img src="/image/chart.jpg"></img>
           </div>
           <div class="col-6">
               <div class="man card p-5">
                   <span>男</span>
               </div>
               <div class="woman card p-5">
                   <span>女</span>
               </div>
               
           </div>
       </div>
       
       
        
        <div v-if="monthData" class="HomeMonth">
            <div v-for="data in monthData"  class="HomeMonth__item">
                <!--<RouterLink  :to="`/logs/${year}/${data}`">-->
                <span>{{ data }}月</span>
                <span>データ</span>
                <!--</RouterLink>-->
            </div>
        </div>
    </div>
</template>
<style type="text/css">
/*.HomeMonth{*/
/*}*/
/*.HomeMonth__item{*/
/*    display: inline-block;*/
/*    width: 25%;*/
/*}*/
.StatusCard{
    color:gray;
    /*font-weight: normal;*/
    /*height: 78px; */
    /*width:100%;*/
    /*background-color: white;*/
}
/*.StatusCard__title{*/
/*    padding: 5px;*/
/*}*/
/*.StatusCard__content{*/
/*    text-align: right;*/
/*    font-size:25px;*/
/*    line-height:20px;*/
/*}*/

</style>

<script>
export default {
    
    props: {
         year: String,
    },
    data(){
        return{
            data: [],
            monthData: [1,2,3,4,5,6,7,8,9,10,11,12,]
            
        }
    },
    
    methods: {
        get_data(){
            
            // json_data:{
            //     1:{
            //         data: [],
            //         month: "1月"
            //         count: 155,
            //         ave: 15.6,
            //         ave_cal: "カロリー別平均値",
            //         join_caount: "参加人数"
            //     }
            // }
        }
    },
    created(){
    }
}
</script>