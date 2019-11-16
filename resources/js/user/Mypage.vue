<template>
    <div>
        <!--チャートを入力-->
        <div class="card">
            <ul class="Statusbar">
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">今月の射精回数</span>
                    <span class="Statusbar__item__content">
                        {{ msg }}
                        <small>回</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">本日の射回数</span>
                    <span class="Statusbar__item__content">
                        {{ msg }}
                        <small>回</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">平均精回数</span>
                    <span class="Statusbar__item__content">
                        {{ msg }}
                        <small>Ave</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">合計支援金</span>
                    <span class="Statusbar__item__content">
                        {{ msg }}
                        <small>円</small>
                    </span>
                </li>
                <li class="Statusbar__item">
                    <span class="Statusbar__item__title">消費カロリー</span>
                    <span class="Statusbar__item__content">
                        {{ msg }}
                        <small>cal</small>
                    </span>
                </li>
            </ul>
        </div>
    
        
        <!--今月のデータグラフ-->
        <div class="card">
            <h1>グラフ(棒・折れ線)</h1>
           <Bar :dataSet="count" />
        </div>
        
        
               
        <!--今月と先月の比較-->
        <div class="row ">
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>総合射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>%<i class="fas fa-level-up-alt"></i></small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>月別射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>%</small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>平均射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>%</small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>総合射精回数</span>
                    <strong>{{ msg }}回</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>%</small></span>
                </div>
            </div>
        </div>
        
               
        <!--今月と先月の比較-->
        <div class="row ">
            <div class="col-3 card StatusCard">
            
                <div class="StatusCard__title">
                    <span class="">消費カロリー指数</span>
                    <strong>先月{{ msg }}cal</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>%</small></span>
                </div>
            </div>
            
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>支援金</span>
                    <strong>先月￥{{ msg }}円</strong>
                </div>
                <div class="StatusCard__content">
                    <span>￥{{ msg }}<small>%</small></span>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>ランキング</span>
                    <strong>{{ msg }}</strong>
                </div>
                <div class="StatusCard__content">
                    <small>15位</small><i class="fas fa-arrow-right "></i><small>8位</small>
                </div>
            </div>
            <div class="col-3 card StatusCard">
                <div class="StatusCard__title">
                    <span>レベル</span>
                    <strong>Lv.{{ msg }}</strong>
                </div>
                <div class="StatusCard__content">
                    <span>{{ msg }}<small>.Lv</small></span>
                </div>
            </div>
        </div>
               
        
        <div class="row">
            <div class="col-4 card">
                <h4>月別平均回数グラフ(棒・折れ線)</h4>
                       
               <Radar :dataSet="count" />
       
            </div>
            <div class="col-4 card">
                <h4>グラフ(棒・折れ線)</h4>
            </div>
            <div class="col-4 card">
                <h4>時間帯別利用グラフ(棒1-24時)</h4>
            </div>
        </div>
       
       <!--最新の15件-->
       <div class="card">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">日付</th>
                    <th scope="col">エリア</th>
                    <th scope="col">コメント</th>
                    <th scope="col">カテゴリー</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>日付</td>
                    <td>内容</td>
                    <td>内容</td>
                    <td>内容</td>
                    <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
            msg: '5',
            count: [],
            month: [],
            doughnut: [],
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
