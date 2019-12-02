<template>
<div>

    <div class="row">
        <div class="col-2  card " v-if="week_data">
        
        <!--<h2>カロリー指数</h2>-->
            <LineChart 
                id="calories"
                :Calories="week_data"
                :labels="week_data"
            />      
            <LineChart 
                id="coin"
                :Coins="week_data"
                :labels="week_data"
            />
        </div>
        <div class="col-3　p-4 card">
            
        <!--<h2>カロリーはこれでオケ！！</h2>-->
       
        </div>
    </div>

</div>
</template>
<style type="text/css">
.coin_card{
    /*background-color: rgba( 60, 179	, 113	, 0.6);*/
    background-color: white;
}

</style>

<script>

import LineChart from '../charts/Line.vue'
export default {
    components: {LineChart, },

    props: {
         string: String,
    },
    data() { 
        return{
            msg: 'おすすｓ',
            week_data: [],
            week_data_label: []
        }
    },
    methods:{
        str(){
           axios.get(`/api/home`).then(response => {
                console.log(response);
                
                this.week_data = response.data.week_data
                this.week_data_label = response.data.week_data_label
                
            })
        //     alert('stet')
        //     this.data_item = [1,2,6,5,4,7,8,5,2]
        //     this.data_item_label = ['A','B','C','D']
        }
    },
    created(){
        this.str()
    }
    
}
</script>