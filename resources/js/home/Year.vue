<template>
    <div>
       <!--ランキング-->
       <!--<h5><b>year</b></h5>-->
       
       
       <!--<div class="card ">-->
       <!--    <h4>{{ year }} 年月別射精回数グラフ</h4>-->
       <!--    <img src="/image/chart.jpg"></img>-->
       <!--</div>-->
       
       <!--<div class="row">-->
       <!--    <div class="col-4  card StatusCard">-->
       <!--        <span class="StatusCard__title">総合射精回数</span>-->
       <!--        <span class="StatusCard__content">1544<small>回</small></span>-->
       <!--    </div>-->
       <!--    <div class="col-4  card StatusCard">-->
       <!--        <span class="StatusCard__title">月別平均射精回数</span>-->
       <!--        <span class="StatusCard__content">1588<small>回</small></span>-->
       <!--    </div>-->
       <!--    <div class="col-4  card StatusCard">-->
       <!--        <span class="StatusCard__title">総合射精回数</span>-->
       <!--        <span class="StatusCard__content">15<small>回</small></span>-->
       <!--    </div>-->
       <!--</div>-->
       <!--<div class="row">-->
       <!--    <div class="col-4  card StatusCard">-->
       <!--        <span class="StatusCard__title">総合射精回数</span>-->
       <!--        <span class="StatusCard__content">1544<small>回</small></span>-->
       <!--    </div>-->
       <!--    <div class="col-4  card StatusCard">-->
       <!--        <span class="StatusCard__title">月別平均射精回数</span>-->
       <!--        <span class="StatusCard__content">1588<small>回</small></span>-->
       <!--    </div>-->
       <!--    <div class="col-4  card StatusCard">-->
       <!--        <span class="StatusCard__title">総合射精回数</span>-->
       <!--        <span class="StatusCard__content">15<small>回</small></span>-->
       <!--    </div>-->
       <!--</div>-->
       
       <!--性別ごとの統計（いらない？）-->
       <!--<div class="row">-->
       <!--    <div class="col-8">-->
               <!--男女別の月ごとの利用統計-->
       <!--        <img src="/image/chart.jpg"></img>-->
       <!--    </div>-->
       <!--    <div class="col-4">-->
       <!--        <div class="man card p-5">-->
       <!--            <span></span>-->
       <!--        </div>-->
       <!--        <div class="woman card p-5">-->
       <!--            <span></span>-->
       <!--        </div>-->
               
       <!--    </div>-->
       <!--</div>-->
       
       <!--性別ごとの統計（いらない？）-->
       <!--<div class="row">-->
       <!--    <div class="col-6">-->
               <!--男女別の月ごとの利用統計-->
       <!--        <img src="/image/chart.jpg"></img>-->
       <!--    </div>-->
       <!--    <div class="col-6">-->
       <!--        <div class="man card p-5">-->
       <!--            <span>男</span>-->
       <!--        </div>-->
       <!--        <div class="woman card p-5">-->
       <!--            <span>女</span>-->
       <!--        </div>-->
               
       <!--    </div>-->
       <!--</div>-->
       
       
        
        <div v-if="monthDatas" class="HomeMonth">
            <div v-for=" (monthdata, index)  in monthDatas" 
                :key="index"　  
                @click="onClickMonth(monthdata.month)"
                class="HomeMonth__item card">
                
                <!--棒グラフ-->
                <YearBar  　
                :month="monthdata.month" 
                :dataSet="monthdata.data" 
                :labels="monthdata.label" />
                
                <div>
                    <span>{{ monthdata.month }}月のデータ</span>
                </div>
            
            </div>
            
                
        </div>
    </div>
</template>
<style type="text/css">
.StatusCard{
    color:gray;
}
.HomeMonth__item{
    width: 32.5%;
    display: inline-block;
    padding: 10px;
    margin: 2px;
    cursor:pointer;
}
</style>

<script>


import YearBar from '../charts/YearBar.vue'
export default {
    components: { YearBar,  },
    props: {
         year: String,
    },
    data(){
        return{
            data: [1,2,3,4],
            monthDatas: [],
        }
    },
    
    methods: {
        get_data(){
            
            axios.get(`/api/logs/${this.year}`).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.monthDatas = response.data.month_data
                }
            })
        },
        onClickMonth(month){
            this.$router.push(`/logs/${this.year}/${month}`)
        },
    },
    watch: {
        $route() {
            this.monthDatas = []
            this.get_data()
            immediate: true
        }
    },
    mounted(){
        this.get_data()
    }
}
</script>