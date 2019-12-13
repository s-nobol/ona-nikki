<template>
    <div>
       <!--ランキング-->
       <!--<h5><b>ホーム</b></h5>-->
       
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

    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        }, 
    },
    methods: {
    },
    created(){
        if(this.currentUser){
            this.$router.push('/mypage')
        }else{
            this.$router.push('/home')
        }
        
    }
}
</script>