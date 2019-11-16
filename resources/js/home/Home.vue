<template>
    <div>
    
        <!--ランキング-->
        <div class="card">
           
            <div class="row ">
                <div class="col-4 ">
                   <h5><b>地図</b></h5>
                   <h5><b>横グラフ</b></h5>
                </div>
                <div class="col-7 pt-5 pb-5">
                   <img src="/image/map.png" class="map__image"></img>
                </div>
            </div>
        </div>
        
        
        <div class="row ">
            <div class="col-4 card HomeStatusCard">
                <span>今日の合計射精回数</span>
            </div>
            <div class="col-4 card HomeStatusCard">
                <span>今日の平均射精回数</span>
            </div>
            <div class="col-4 card HomeStatusCard">
                <span>総合募金額</span>
            </div>
        </div>
        
        
        <div class="row ">
            <div class="col-8 card ">
                <span>総合ランキング</span>
            </div>
            <div class="col-4 card ">
                <span>日別ランキング</span>
            </div>
        </div>
        
        <div class="row ">
            <div class="col-6 card ">
                <h4>7日間の伸び率（折れ線グラフ）</h4>
            </div>
            <div class="col-6 card ">
                <h4>利用が多い時間帯（棒グラフ）</h4>
            </div>
        </div>
        
        
        
        <div class="row ">
            <div class="col-6 card ">
                <h4>利用が多い時間帯（棒グラフ）</h4>
            </div>
            <div class="col-3 card bg-primary">
                <h3>男性の割合</h3>
            </div>
            <div class="col-3 card bg__red">
                <h3>女性の割合</h3>
            </div>
        </div>
    
    
    </div>
</template>
<style type="text/css">
    .map__image{
        width: 100%;
    }
</style>

<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく

export default {
    data(){
        return{
        }
    },
    methods: {
    },
    created(){
    }
}
</script>