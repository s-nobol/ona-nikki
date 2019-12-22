<template>
<div class="Map">
    <div class="Map__item Map-hokkaido">北海道</div>
    <div class="Map__item Map-tohoku">東北</div>
    <div class="Map__item Map-kanto">関東</div>
    <div class="Map__item Map-tyubu">中部</div>
    <div class="Map__item Map-kansai">関西</div>
    <div class="Map__item Map-tyugoku">中国</div>
    <div class="Map__item Map-shikoku">四国</div>
    <div class="Map__item Map-kyusyu">九州</div>
    <img src="/image/map.png"></img>
</div>
</template>
<style type="text/css">
.Map{
    position: relative;
}    
.Map__item{
    display: inline-block;
    background-color: rgba(255,75,75,0.7);
    color: white;
    border-radius: 30px;
    padding: 10px;
}
.Map-hokkaido{
    position:absolute;
    top: 13%;
    right: 23%;
    /*background-color: blue;*/
}
.Map-tohoku{
    position:absolute;
    top: 40%;
    right: 32%;
    /*background-color: gray;*/
}
.Map-kanto{
    position:absolute;
    top: 65%;
    right: 38%;
    /*background-color: gray;*/
}
.Map-tyubu{
    position:absolute;
    top: 58%;
    right: 48%;
    /*background-color: gray;*/
}
.Map-kansai{
    position:absolute;
    top: 70%;
    right: 60%;
    /*background-color: gray;*/
}
.Map-tyugoku{
    position:absolute;
    top: 66%;
    right: 73%;
    /*background-color: gray;*/
}
.Map-shikoku{
    position:absolute;
    top: 77%;
    right: 70%;
    /*background-color: gray;*/
}
.Map-kyusyu{
    position:absolute;
    top: 80%;
    right: 85%;
    /*background-color: gray;*/
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
    watch: {
        
        // データが更新されたら起動
        all_count: function(all_count){
            
            // this.hokkaido_count / all_count => で北海道の割合を求められる
        }
    },
}
</script>
