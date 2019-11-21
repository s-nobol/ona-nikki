<template>
<div >
    <div class="model" @click.self="">
        <div class="model__content">
        
            <div class="levelForm">
                <div class="levelForm__title">
                    <h5><b>レベルが上がりました</b></h5>
                </div>
                <div class="levelForm__content">
                    <span class="levelForm__content__level before__level">Lv.15</span>
                    <span class="">→</span>
                    <span class="levelForm__content__level after__level">Lv.15</span>
                </div>
                
                <div class="levelForm__gerge">
                    
                </div>
                <div class="levelForm__Confirmation">
                    <button class="btn btn-danger" @click="$emit('close') ">確認しました</button>
                </div>
                
                <small>Levelあげには毎日のプロテインが欠かせません</small>
            </div>
            
        </div>
    </div>
</div>
</template>
<style type="text/css">
.levelForm{
    width:350px;
    padding: 30px;
    background-color: white;
    text-align: center;
}
.levelForm__content__level{
    font-weight: bold;
}
</style>
<script>

export default {
    data(){
        return{
        }
    },
    methods: {
        onCreate(){
            setTimeout(() => ( this.$emit('close') ), 10000)
        }
    },
    created(){
        this.onCreate()
    }
    
}
</script>