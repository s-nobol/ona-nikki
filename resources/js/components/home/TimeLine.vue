<template>
<div class="card">


        <h4 class="p-3 border-bottom "><b>みんなの記録</b></h4>
        
        <!--パートA-->
        <!--<div class="p-3">-->
        <!--    <div v-for="item in dataSet">-->
        <!--        <span >{{ item.name }}氏</span>-->
        <!--        <span >{{ item.coin }}円貢献しました</span>-->
        <!--    </div>-->
        <!--</div>-->
        
        <!--パートB-->
        <div class="p-3 ">
            <div v-for="user in dataSet">
            
            
                <div class="row p-0 "> 
                    <div class="col-2 test">
                        <img v-if="user.image" src="/image/noimage.jpg" ></img>
                        <img v-else="user.image" src="/image/noimage.jpg" ></img>
                    </div> 
                    
                    <div class="col-6 p-0">
                        <span>{{ user.name }}</span>
                        <!--<span>Lev.{{ user.level }}</span>-->
                    </div>
                    
                    <div class="col-2  p-0">
                        <span>募金</span>
                    </div>
                    <div class="col-2  p-0">
                        <span>{{ user.coin }}円</span>
                    </div>
                    <!--<div class="col-4 ">-->
                    <!--    <span>{{ Math.round( (now_time - new Date(user.created_time)) / 3600000 )}} 時間前</span>-->
                        <!--<span>{{ Math.round( (now_time - new Date(user.created_time)) / 60000 )}} 分前</span>-->
                    <!--</div>-->
                
                </div>
            </div>
        </div>
        
</div>
</template>
<style type="text/css">
.test img{
    width: 30px;
    border-radius: 25px;
}
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
    data(){
        return{
            now_time: new Date()
        }
    },
    created(){
        
        console.log(new Date() - new Date('2019-12-28'))
    }
    
}
</script>
