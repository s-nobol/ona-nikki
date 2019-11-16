<template>
    <div>
       <!--チャートを入力-->
       <h5><b>year</b></h5>
       
       
       <div class="card ">
           <h4>{{ year }} 年月別射精回数グラフ(自分のデータとみんなのデータを比較)</h4>
           <img src="/image/chart.jpg"></img>
       </div>
       
       
       
       
       
       <!--今月と先月の比較-->
        <div class="row ">
            <div class="col-3 card StatusCard">
            
                <div class="StatusCard__title">
                    <span class="">最高射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>回</small></span>
                </div>
            </div>
            
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>最低射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>￥{{ msg }}<small>%</small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>合計消費カロリー</span>
                    <strong>{{ msg }}cal</strong>
                </div>
                <div class="StatusCard__content">
                    <small>15位</small><i class="fas fa-arrow-right "></i><small>8位</small>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>累計支援金額</span>
                    <strong>Lv.{{ msg }}</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>.Lv</small></span>
                </div>
            </div>
        </div>
        
        <!--今月と先月の比較-->
        <div class="row">
            <div class="col-8 card ">
               <h5><b>みんなと比較（棒グラフ）</b></h5>
                 <img src="/image/chart.jpg"></img>
                 
                 <div>
                   <h5><b>比較データ詳細除法）</b></h5>
                 </div>
            </div>
            <div class="col-4 p-0 ">
                <div class="card p-5">
                   <h5><b>支援金比較（円グラフ）</b></h5>
                </div>
                <div class="card p-5">
                   <h5><b>支援金比較（円グラフ）</b></h5>
                </div>
            </div>
        </div>
        
        <div>
            <img src="/image/ona-nikki5.jpg"></img>
        </div>
       
       <Bar :dataSet="count" />
       <Radar :dataSet="count" />
    </div>
</template>

<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく


import Bar from '../charts/Bar.vue'
import Bubble from '../charts/Bubble.vue'
import Doughnut from '../charts/Doughnut.vue'
import Radar from '../charts/Radar.vue'
export default {
    components: { Bar,Bubble ,Doughnut ,Radar},
    data(){
        return{
            count: [],
            month: [],
            doughnut: [],
            msg: '150'
        }
    },
    methods: {
        get_chart(){
            console.log("チャートの取得")
            axios.get(`api/logs/year/2018`, this.NoticeEditForm).then(response => {
              
                console.log(response);
                this.count = response.data.count
                this.month = response.data.month
                
                this.doughnut = response.data
             
                // this.create_chart()
            }).catch(err => {
                    alert(err)
            });
        },
    },
    created(){
        this.get_chart()
    }
}
</script>
