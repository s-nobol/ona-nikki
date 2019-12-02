<template>
    <div>
       
       
        
        <div v-if="monthDatas" class="HomeMonth">
            <div v-for=" (monthdata, index)  in monthDatas" 
                :key="index"　  
                @click="onClickMonth(monthdata.month)"
                class="HomeMonth__item card">
                
                
                <div>
                    <h3><b>{{ monthdata.month }}月のデータ</b></h3>
                </div>
            
                <div>
                    <span>利用数　15人</span>  
                </div>
                <div>
                    <span>累計射精回数　148回</span>
                </div>
                
                <!--棒グラフ-->
                <YearBar  　
                :month="monthdata.month" 
                :dataSet="monthdata.data" 
                :labels="monthdata.label" />
                
            
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
    padding: 15px;
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