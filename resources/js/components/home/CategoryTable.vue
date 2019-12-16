<template>
<div class="card p-3">
       <div vfor="item in dataSet" class="row " >
       
       
            <!--アイコン-->
            <div class="col-2">
                <span><i class="fas fa-satellite-dish"></i></span>
            </div>
            
            <!--カテゴリー名-->
            <div class="col-4">
                <span>{{ item.name }}</span>
            </div>
            
            <!--ゲージ-->
            <div class="col-6">
                <span>何パーセントゲージが存在しているか？</span>
            </div>
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
    method:{
        categoryGerge(data){
            // すべてのカテゴリーデータの合計を出す
            var max_widht = data.max_widht; 
            // 合計データからカテゴリを割り引く
            for (var i = 0; i <  Things.length ; i++) {
                data[i].point = data[i].point / max_widht
            }
        }
    }
    
}
</script>
