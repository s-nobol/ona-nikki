<template>
<div class="navigation">

    
    <div v-if="currentUser" >
        
        <div class="bg__red p-4"><b>{{ currentUser.name }}</b>　Lv.{{ currentUser.level }}</div>
        <ul class="list-group">
            <li class="list-group-item ">
            
            <i class="far fa-chart-bar fa-lg"></i>
            年代
            </li>
            
            <li class="list-group-item  ">
                <RouterLink  to="/mypage/logs/2018" class="sidebar__item" >
                    <span class="ml_50px">2018</span>
                </RouterLink>
            </li>
            
            <li class="list-group-item ">
                <RouterLink  to="/mypage/logs/2019" class="sidebar__item" >
                    <span class="ml_50px">2019</span>
                </RouterLink>
            </li>
            
            
            <li class="list-group-item">
                <RouterLink  to="/mypage/profile" class="sidebar__item" >
                    <i class="far fa-address-card fa-lg"></i>
                    <span>プロフィール</span>
                    <span v-if="! currentUser.status_check" class="sidebar__item_message_button">1</span>
                </RouterLink>
            </li>
            
            
            <li class="list-group-item">
                <RouterLink  to="/mypage" class="sidebar__item" >
                    <i class="fas fa-home fa-lg"></i>
                    <span>マイページ</span>
                </RouterLink>
            </li>
            
            
            <!--<li class="list-group-item">-->
            <!--    <RouterLink  to="/mypage/notify" class="sidebar__item" >-->
            <!--        <i class="fas fa-envelope fa-lg"></i>-->
            <!--        <span>お知らせ</span>-->
            <!--    </RouterLink>-->
            <!--</li>-->
            
            <!--<li class="list-group-item">-->
            <!--    <RouterLink  to="/ranking" class="sidebar__item" >-->
            <!--        <i class="fas fa-crown fa-lg"></i>-->
            <!--        <span>ランキング</span>-->
            <!--    </RouterLink>-->
            <!--</li>-->
            
            
            <li class="list-group-item pl-5">
                <span @click="logout">ログアウト</span>
            </li>
            
        </ul>
    </div>
    
    
    <div class="bg__red p-4 list-group-title" @click="$emit('close')">
        <b>2018年版</b>
    </div>
    
    
        <ul class="list-group list-group-content">   
            
            <li class="list-group-item">
                <i class="far fa-chart-bar fa-lg"></i>年代
            </li>
            
            
            <li class="list-group-item">
                <RouterLink  to="/logs/2018" class="sidebar__item " >
                    <span class="ml_50px">2018</span>
                </RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/logs/2019" class="sidebar__item" >
                    <span class="ml_50px">2018</span>
                </RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/home" class="sidebar__item " >
                    <span class="ml_50px">ホーム</span>
                </RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/sex" class="sidebar__item" >
                    <i class="fas fa-venus-mars  fa-lg"></i>
                    <span >年齢・性別</span>
                </RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/location" class="sidebar__item" >
                    <i class="fas fa-thumbtack fa-lg"></i>
                    <span>都道府県</span>                
                </RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/ranking" class="sidebar__item" >
                    <i class="fas fa-crown fa-lg"></i>
                    <span>ランキング</span>
                </RouterLink>
            </li>
            
            <li class="list-group-item">
                <!--<i class="fas fa-ban fa-lg"></i>-->
                <RouterLink  to="/policy" class="sidebar__item " >
                    <span class="ml_50px">プライバシーポリシー</span>  
                </RouterLink>
            </li>
            <li class="list-group-item">
                <!--<i class="fas fa-ban fa-lg"></i>-->
                <RouterLink  to="/about" class="sidebar__item " >
                    <span class="ml_50px">おな日記について</span>  
                </RouterLink>
            </li>
            
            <!--もしログインしていないとき-->
            <div v-if="! currentUser" >       
                <li class="list-group-item">
                    <!--<RouterLink  to="/about" class="sidebar__item " >-->
                        <span class="ml_50px" @click="login">ログイン</span>  
                    <!--</RouterLink>-->
                </li> 
                <li class="list-group-item">
                    <RouterLink  to="/signup" class="sidebar__item " >
                        <span class="ml_50px">新規登録</span>  
                    </RouterLink>
                </li>
            </div>
        </ul>
        
            
</div>
</template>
<style type="text/css">
.navigation{  
    position: absolute;
    top: 75px;
    left: 0px;
    width: 250px;
    display: none;
    z-index: 50;
    height: 100%;
    overflow: hidden;
}
@media screen and (max-width:991px){
    .navigation{
        display: block;
    }
}
.list-group-title{
    width: 250px;
    overflow: hidden;
}
.list-group-content{
    overflow: hidden;
}
</style>
<script>
export default {
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },
    },
    data(){ 
        return{
            select: '現時点で状態を保存することができない',
            homeItems: [
                { name: 'ホーム', key:'home', url:'/home', iconClass: 'fas fa-home  fa-lg',  },
                { name: '年代', key:'', url:'', iconClass: 'far fa-chart-bar fa-lg'  },
                { name: '2019年',  key:'', url:'/logs/2019', iconClass: null },
                { name: '2018年',  key:'', url:'/logs/2018', iconClass: null },
                { name: '性別・年齢',  key:'sex', url:'/sex', iconClass: ' fas fa-street-view ' },
                { name: '都道府県',  key:'locatoin', url:'/location', iconClass: 'fas fa-globe-americas' },
                { name: 'おな日記について',  key:'about', url:'/about', iconClass: null },
            ],
            currentItems: [
                { name: 'プロフィール', key:'profile', url:'/mypage/profile', iconClass: 'fas fa-home  fa-lg',  },
                { name: 'マイページ', key:'mypage', url:'/mypage', iconClass: 'fas fa-envelope fa-lg'  },
                { name: 'おしらせ',  key:'notification', url:'/notification', iconClass: 'far fa-address-card  fa-lg' },
                { name: 'ログアウト',  key:'logout', url:'/logout', iconClass: null },
            ]
        }
    },
    methods:{
        onClickButton(item){
            this.select = item.key
            this.$router.push(item.url)
            console.log(this.select )
        },
        // ログインボタンを押す
        login(){
        //     alert("ログインボタンが押されました")
            this.$emit('login')
        },
        // 新規登録ボタンを押す
        signup(){
        },
        
        logout(){
            axios.post(`/api/logout`).then(response => {
                console.log('logout',response); 
                if(response.status === 200){
                    this.$store.commit('currentUser', null)
                }
            })
        },
    }
}
</script>