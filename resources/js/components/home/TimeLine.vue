<template>
<div class="card p-3">


        <h4 class="">みんなの記録</h4>
        <div v-for="item in dataSet">
            <!--<span >{{ item.location }}</span>-->
            <span >{{ item.name }}氏</span>
            <span >{{ item.coin }}円貢献しました</span>
        </div>
        
</div>
</template>
<style type="text/css">
</style>
<script>

export default {
    props: {
        
        id: { type: String, required: false, default: 'name' },
        dataSet: {
            type: Array,
            require  : false,
            default: () => []
        },
        
    },
    
}
</script>
