<template>
<div class="card">
   
    <!--ランキング-->
        <div class="rankig__page">
        
            <h2 class="ranking__title"><b>ランキング </b></h2>
           
            <div class="row mb-5">

                <div class="col-4 ranking__tab "  :class="{ 'select__ranking' : select === 'week' }">
                    <span @click="changeSelect('week')" class="ranking__tab__item" >今週</span>
                </div>
                
                <div class="col-4 ranking__tab" :class="{ 'select__ranking' : select === 'month' }" >
                    <span @click="changeSelect('month')"class="ranking__tab__item" >今月</span>
                </div>
                
                <div class="col-4 ranking__tab" :class="{ 'select__ranking' : select === 'all' }">
                    <span @click="changeSelect('all')" class="ranking__tab__item"  >トータル</span>
                </div>
           </div>
       
       
       <!--ランキングカード-->
       <div v-if="rankingUsers">
           <ul v-for="(user, index) in  rankingUsers" 
                class="ranking__card" >
           
               <!--ランキング番号-->
               <li class="rankig__card__number ">
                   <i v-if="index+1 < 4" class="fas fa-crown" :class="'rank__'+(index+1)"></i>
                   <span>{{ index+1 }}</span>
               </li>
               
               <!--ユーザー名-->
               <li class="rankig__card__user">
                   <img src="/image/myuser.jpg"></img>
                   <span class="ml-2">{{ user.name }} </span>
               </li>
               
               <!--ユーザーのログカウント-->
               <li class="rankig__card__count">
                   <span class="rankig__card__count__span">
                   {{ user.count }}
                   <small class="rankig__card__count__small">回</small>
                   </span>
               </li>
               
               <!--ポイント-->
               <li class="rankig__card__point">
                   <span >{{ user.point }} <small>EXP</small></span>
               </li>
           
           </ul>
       </div>
       
       
       
   </div>
</div>
</template>
<style type="text/css">
.ranking__tab{
    text-align: center;
}
.ranking__tab__item{
    cursor:pointer;
}
.select__ranking{
    border-bottom: 2px solid coral;
    padding-bottom:  15px;
    color: coral;
}
.rankig__page{
    width: 65%;
    margin: auto;
}
.ranking__title{
    margin: 50px;
    text-align: center;
}

/*ランキングカード・順番*/
.rank__1{color: gold;}
.rank__2{color: silver;}
.rank__3{color: #cc7a7a;}

/*ランキングカード*/
.ranking__card{
    list-style:none;
    height: 150px;
    margin-bottom: 30px;
    /*box-shadow: 0 2px 4px rgba(0,0,0,0.3);*/
    font-size: 0px;
    padding: 0px;
}
.ranking__card li{
    display: inline-block;
    vertical-align: middle;
}
.rankig__card__number {
    display: inline-block;
    line-height: 150px;
    width: 150px;
    font-size: 45px;
    text-align: center;
}
.rankig__card__user {
    vertical-align: middle;
    display: inline-block;
    font-size: 18px;
    width: 250px;
}
.rankig__card__user img {
    width: 80px;
    border-radius: 80px;
}
.rankig__card__user span {
    vertical-align: middle;
}
.rankig__card__count{
    text-align: center;
}
.rankig__card__count__span{
    display: inline-block;
    padding: 5px 10px;
    border-radius: 50px;
    font-size: 23px;
}
.rankig__card__count__small{
    font-size: 18px;
}
.rankig__card__point {
    display: inline-block;
    line-height: 150px;
    float: right;
    margin-right: auto;
    vertical-align: middle;
    font-size: 28px;
    /*width: 30%;*/
}
</style>
<script>
export default {
    data(){
        return{
            select: "week",
            rankingUsers: []
        }
    },
    methods: {
        getRankingUser(){
            axios.get(`/api/ranking/${this.select}`).then(response => {
                console.log('rankig',response); 
                if(response.status === 200){
                    this.rankingUsers = []
                    this.rankingUsers = response.data
                }
            })
        },
        changeSelect(name){
            if(this.select !== name) {
                console.log("変更")
                this.select = name
                this.getRankingUser()
            }
        },
    },
    created(){
        this.getRankingUser()
    }
}
</script>