<template>
    <div>
       <!--ランキング-->
       <h5><b>location</b></h5>
       <div v-if="msgs">
           <div v-for="msg in msgs">{{ msg }}</div>
       </div>
       <div><button class="btn btn-primary" @click="onClickButton">送信</button></div>
    </div>
</template>

<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく

export default {
    data(){
        return{
            msgs: []
        }
    },
    methods: {
        onClickButton(){
            
            window.setTimeout(this.hanoi(3,'A','B','C'), 500)
            // window.setTimeout(this.hanoi2(3), 500)
        },
        hanoi( n, from, to, task ){
            if(n > 0 ){
                
                // this.msgs.push(`n=${n-1}の円盤  ${from} => ${to} へ移動 `)
                
                this.hanoi(n-1, from, task, to )
                
                this.msgs.push(`n=${n-1}の円盤  ${from} => ${to} へ移動 `)
                this.hanoi(n-1, task, to, from)
            }
        },
        //n回繰り返す
        hanoi2(n){
            if(n > 0){
                this.hanoi2(n-1)
                this.msgs.push(`n=${n-1}の円盤 `)
            }
        }
    },
    created(){
    }
}
</script>