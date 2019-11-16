<template>
    <div>
       <!--ランキング-->
       <h5><b>sex</b></h5>
       
       <div>
           <h4>円グラフ</h4>
           <div class="SexPage__title">
               <span>男</span>
               <span>女</span>
           </div>
           <div class="SexPage__content text-center">
               <img src="/image/chart.jpg"></img>
           </div>
       </div>
       
       
       
       <!--性別ごとの利用割合（いらない？）-->
       <h4>性別ごとの割合(折れ線グラフ)</h4>
       <div class="row">
           <div class="col-6">
               <!--男女別の月ごとの利用統計1年間-->
               <img src="/image/chart.jpg"></img>
           </div>
           <div class="col-6">
               <div class="man card p-5">
                   <span>男</span>
               </div>
               <div class="woman card p-5">
                   <span>女</span>
               </div>
               
           </div>
       </div>
       
       <!--性別ごとの利用時間帯（いらない？）-->
       <h4>性別ごとの利用時間（1～24時間）</h4>
       <div class="row">
           <div class="col-6">
               <div class="man card p-5">
                   <span>男</span>
               </div>
               <div class="woman card p-5">
                   <span>女</span>
               </div>
               
           </div>
           <div class="col-6">
               <!--男女別の月ごとの利用統計1年間-->
               <img src="/image/chart.jpg"></img>
           </div>
       </div>
       
    </div>
</template>

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