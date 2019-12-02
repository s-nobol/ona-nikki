<template>
    <div>
        <!--日付ごとチャート-->
        <div v-if="dataSet" class="date">
            <span v-for=" data in dataSet" class="date_item">{{ data }}</span>
        </div>
        
        
    <!--縦7/ 横15-->
    <!--# # # # # # # # # # # # -->
        <!--# # # # # # # # # # # # -->
        <!--# # # # # # # # # # # # -->
        <!--# # # # # # # # # # # # -->
        <!--# # # # # # # # # # # # -->
        <!--# # # # # # # # # # # # -->
    </div>
</template>
<style type="text/css">
.date_item{
    display:inline-block;
    /*padding: 2px;*/
    margin: 2px;
    width: 15px;
    height: 15px;
    color:whitesmoke;
    background-color: whitesmoke;
}    
</style>
<script>
export default {

    props: {
        id: {
            type: String,
            require  : false,
            default: 'BarChart',
        },
        dataSet: {
            type: Array,
            require  : false,
            default: () => []
        },
        labels: {
            type: Array,
            require  : false,
            default: () => []
        },
    },
    data(){
        return{
            }
    },
    methods: {
    },
    watch: {
        labels: function(labels){
            console.log("date_chart")
        }
    },
}
</script>