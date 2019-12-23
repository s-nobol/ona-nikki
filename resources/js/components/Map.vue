<template>
<div class="Map">
    
    <div class="Map__item Map-hokkaido" id="map_item"  @click="selectItem('北海道')">北海道</div>
    <div class="Map__item Map-tohoku"   id="map_item"  @click="selectItem('東北')">東北</div>
    <div class="Map__item Map-kanto"    id="map_item"  @click="selectItem('関東')">関東</div>
    <div class="Map__item Map-tyubu"    id="map_item"  @click="selectItem('中部')">中部</div>
    <div class="Map__item Map-kansai"   id="map_item"  @click="selectItem('関西')">関西</div>
    <div class="Map__item Map-tyugoku"  id="map_item"  @click="selectItem('中国')">中国</div>
    <div class="Map__item Map-shikoku"  id="map_item"  @click="selectItem('四国')">四国</div>
    <div class="Map__item Map-kyusyu"   id="map_item"  @click="selectItem('九州')">九州</div>
    <img src="/image/map2.png" id="map" v-on:load="load"></img>
</div>
</template>
<style type="text/css">
.Map{
    position: relative;
}    
.Map__item{
    cursor: pointer;
    display: inline-block;
    /*display: none;*/
    background-color: rgba(255,75,75,0.7);
    color: white;
    border-radius: 30px;
    padding: 10px;
    
}
.Map-hokkaido{
    position:absolute;
    top: 13%;
    right: 23%;
}
.Map-tohoku{
    position:absolute;
    top: 40%;
    right: 32%;
}
.Map-kanto{
    position:absolute;
    top: 65%;
    right: 38%;
}
.Map-tyubu{
    position:absolute;
    top: 58%;
    right: 48%;
}
.Map-kansai{
    position:absolute;
    top: 70%;
    right: 60%;
}
.Map-tyugoku{
    position:absolute;
    top: 66%;
    right: 73%;
}
.Map-shikoku{
    position:absolute;
    top: 77%;
    right: 70%;
}
.Map-kyusyu{
    position:absolute;
    top: 80%;
    right: 85%;
}
</style>
<script>

export default {
    props: {
        id: { type: String, required: false, default: 'name' },
        hokkaido_count: { type: Number, required: false, default: 0 },
        tohoku_count: { type: Number, required: false, default: 0 },
        kanto_count: { type: Number, required: false, default: 0 },
        tyubu_count: { type: Number, required: false, default: 0 },
        kansai_count: { type: Number, required: false, default: 0 },
        tyugoku_count: { type: Number, required: false, default: 0 },
        shikoku_count: { type: Number, required: false, default: 0 },
        kyusyu_count: { type: Number, required: false, default: 0 },
        all_count: { type: Number, required: false, default: 0 },
    },
    data(){
        return{
            loading: false
        }
    },
    methods:{
        selectItem(name){
            this.$emit('clickMap', name)
        },
        
        // 画像の読み込み後起動
        load: function() {
            // document.getElementById("map_item").style.display ="inline-block";
        },
    },
    mounted(){
        this.loading = true
        // 画像の読み込みが完了したら表示
        // コールバック設定
    },
    watch: {
        
        // データが更新されたら起動
        all_count: function(all_count){
            
            // this.hokkaido_count / all_count => で北海道の割合を求められる
        }
    },
}
</script>
