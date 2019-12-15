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
                    <img v-if="user.oauth_image" class="user_image" :src="currentUser.oauth_image" alt="ユーザー画像">
                    <img v-if="! user.oauth_image" class="user_image" src="/image/noimage.jpg" alt="ユーザー画像">
                 
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