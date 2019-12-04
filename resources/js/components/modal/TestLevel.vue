<template>
<div >
    <div class="model" @click.self="">
        <div class="model__content modal-dialog ">
        
            <div class="levelForm modal-content">
            
            
            
                <!--タイトル-->
                <div class="levelForm__title">
                    <h5><b>レベルが上がりました</b></h5>
                </div>
                
                <!--レベル-->
                <div class="levelForm__content">
                    <span class="levelForm__content__level before__level">{{ level }}</span>
                    <span class="">→</span>
                    <span class="levelForm__content__level after__level">Lv.15</span>
                </div>
                
                
                
                <!--ゲージ-->
                <div class="levelForm__gerge">
                    <div class="derge" id="point">
                        <div class="derge__bar"  id="point_bar">
                        </div>
                    </div>
                </div>
                
                
                <div class="levelForm__Confirmation mt-3">
                    <button class="btn btn-dark" @click="$emit('close')">close</button>
                    <button class="btn btn-dark" @click="resetLevel">reset</button>
                </div>
                
                
                <!--<div class="levelForm__Confirmation ">-->
                <!--    <button class="btn btn-danger" @click="$emit('close') ">確認しました</button>-->
                <!--</div>-->
                
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
.derge{
    width:300px;
    height:25px;
    background-color: whitesmoke;
}
.derge__bar{
    width: 0px;
    height: 25px;
    background-color: aquamarine;
}
</style>
<script>
// テスト用のLevel.vue
export default {
    props:{
        //追加するポイント
        value: {
            type: Number, default: 0,
        },
        sizeing: {
            type: Number,  default: 1,
        },
        //更新する前のユーザーレベル
        before_level: {
            type: Number,  default: 1,
        },
        //更新する前のユーザーポイント（　this.point を追加する）
        before_point: {
            type: Number,  default: 0,
        },
        //レベルアップ後の残りのポイント
        remain_point: {
            type: Number,  default: 0,
        },
    },
    data(){
        return{
            level: 1,
            point: 1,
            time: 0, //(いらないかも？)
            experience_point: 300,
            point_gerge: null,
        }
    },
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    methods: {
        createData(){
            this.level = this.before_level
            this.time = Math.round( this.value * this.sizeing )  //例  50 * 0.85  =>  43
            this.point =Math.round( this.before_point * this.sizeing )  //例 150 * 0.85  => 129
            
            this.point_gerge = document.getElementById("point_bar");
            this.point_gerge.style.width = `${this.point}px`; 
            
            //例 43 + 129 => 172  (43回くりかして172にさせる)
            setTimeout(() => ( this.Looping(this.time) ), 500)
        },
        
        
        // ポイントの回数分だけ実行させる
        Looping(Max_Time){
            for(var time = 0; time< Max_Time ; time++){
                 setTimeout(() => (  this.addPoint() ), 10*time)
            }
        },
        
        
        addPoint(){
            this.point ++   //ポイントを一づつ増やしていく
            this.point_gerge.style.width = `${this.point}px`;
            if( this.point >= this.experience_point){
                this.levelUp()
            }
        },
        
        // レベルアップしたときのみ起動
        levelUp(){
            this.level ++ 
            this.point = 0 
            this.point_gerge.style.width = `${this.point}px`;
            alert("レベルアップしました")
            
            // 残りのポイント分繰り返す
            var time = Math.round( this.remain_point * this.sizeing )
            this.Looping(time)
        },
    
    },
    mounted(){
        this.createData()
    }
    
    // 予定
    // props{
    //     value: 50
    //     sizeing: 0.86 
    //     before_point: 150
    //     before_level: 2
    // }
    
}
</script>