<template>
    <div>
        <div v-if="month_data_label" class="card p-4">
        
            
            <!--月別集計-->
            <h5><b>month</b></h5>
            
            <BarLine 
                :labels="month_data_label"
                :barDataSet="month_data_count" 
                :lineDataSet="month_data_ave" 
            />
            
            <!--<div class="row">-->
            <!--    <div class="col-9">-->
            <!--    </div>-->
            <!--    <div class="col-3">-->
            <!--        <div>-->
            <!--            <span>合計射精回数</span>-->
            <!--        </div>-->
            <!--        <div>-->
            <!--            <span>合計射精回数</span>-->
            <!--        </div>-->
            <!--        <div>-->
            <!--            <span>平均射精回数</span>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            
            
        </div>
    </div>
</template>

<script>
import Bar from '../charts/Bar.vue'
import BarLine from '../charts/BarLine.vue'
export default {
    components: { Bar, BarLine },
    props: {
         year: String,
         month: String
    },
    data(){
        return{
            // 月別データ
            month_data_label: [],
            month_data_count: [],
            month_data_ave: [],
            
        }
    },
    methods: {
         get_data(){
            
            axios.get(`/api/logs/${this.year}/${this.month}`).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.month_data_count = response.data.month_count
                    this.month_data_ave = response.data.month_count_ave
                    this.month_data_label = response.data.month_label 
                }
            })
            
        },
        
    },
    created(){
        this.get_data()   
    }
}
</script>