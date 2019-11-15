<template>
    <div>
       <!--チャートを入力-->
       
       <div>mypage_month</div>
       
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
