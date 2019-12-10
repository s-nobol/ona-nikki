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

export default {
    props:{
        value_point: {
            type: Number,
            require: true,
            default: 0,
        },
        before_level: {
            type: Number,
            require: true,
            default: 1,
        },
        before_point: {
            type: Number,
            require: true,
            default: 0,
        },
        sizeing: {
            type: Number,
            require  : true,
            default: 1,
        },
    },
    data(){
        return{
            experience_point: 300,
            level: 1,
            point: 1,
            after_point: 0,
        }
    },
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    methods: {
        
        addPoint(){
            
            var MAX_TIME =Math.round( this.value_point *  this.sizeing  )
            
            // レベルアップするとき
            if(this.point + MAX_TIME > this.experience_point){
                this.after_point = this.point + MAX_TIME - this.experience_point
                MAX_TIME =  this.experience_point-this.point
            }
            this.time(MAX_TIME)
        },
        
        time(MAX_TIME){
            for(var time = 0; time< MAX_TIME ; time++){
                 setTimeout(() => (  this.gerge() ), 10*time)
            }
        },
        
        gerge(){
            this.point ++ 
            var point_bar = document.getElementById("point_bar");
            point_bar.style.width = `${this.point}px`; 
            
            if( this.point === this.experience_point){
                this.levelUp()
            }
        },
        
        // レベルアップしたときのみ起動
        levelUp(){
            this.level ++
            this.point = 0
            var point_bar = document.getElementById("point_bar");
            point_bar.style.width = `${this.point}px`; 
            var sizeing = this.experience_point / (this.currentUser.experience_point+50)
            alert("レベルアップしました")
            
            axios.post(`/api/users/${this.currentUser.id}/levelup`,  { point: this.after_point }).then(response => {
                console.log("レベルアップ",response)
                // userをcommit
            })
            this.time( this.after_point*sizeing )
        },
        
        // レベルリセット
        resetLevel(){
            axios.post(`/api/users/${this.currentUser.id}/resetlevel`).then(response => { })
        },
    },
    
    
    
    // 初めにポイントを入れておく
    mounted(){
        var point_bar = document.getElementById("point_bar");
        point_bar.style.width = `${this.before_point}px`; 
        
        this.level = this.before_level
        this.point = Math.round(this.before_point)
        
        
        setTimeout(() => ( this.addPoint() ), 500)
    }
    
}
</script>