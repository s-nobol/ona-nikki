<template>
<div class="sidebar">
    <!--サイドバー-->
    <!--<div>サイドバー</div>-->
    
    
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
            
            
            <li class="list-group-item">
                <RouterLink  to="/mypage/notify" class="sidebar__item" >
                    <i class="fas fa-envelope fa-lg"></i>
                    <span>お知らせ</span>
                </RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/ranking" class="sidebar__item" >
                    <i class="fas fa-crown fa-lg"></i>
                    <span>ランキング</span>
                </RouterLink>
            </li>
            
            
            <li class="list-group-item pl-5">
                <span @click="logout">ログアウト</span>
            </li>
            
        </ul>
    </div>
    
    
    <div class="bg__red p-4">
        <b>2018年版</b>
    </div>
    
    
        <ul class="list-group">   
            
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
                    <span>年齢・性別</span>
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
            
        </ul>
        
          
        
        <!--<ul class="list-group">   -->
        <!--    <li class="list-group-item" v-for="item in homeItems" >-->
        <!--        <RouterLink  -->
        <!--            :to="item.url"-->
        <!--            class="sidebar__item "-->
        <!--            :class="{ 'select_item' : $route.name == item.key }" >-->
                    
                    
        <!--            <i  v-if="item.iconClass"  :class="item.iconClass"></i>-->
        <!--            <span  v-if="item.iconClass" >{{ item.name }}</span>-->
        <!--            <span v-else class="ml_50px">{{ item.name }}</span>-->
                    
        <!--        </RouterLink>                -->
        <!--    </li>-->
        <!--</ul>-->
            
</div>
</template>
<style type="text/css">
.sidebar{}
/*@media screen and (max-width:991px){*/
/*.sidebar{*/
/*    display: none;*/
/*}*/
/*}*/

/*.sidebar__item{*/
/*    display: inline-block;*/
/*    color: black;*/
/*    width:100%;*/
/*    height: 100%;*/
/*}*/
/*.sidebar__item:hover{*/
/*    color: black;*/
/*    text-decoration: none;*/
/*}*/
/*.ml_50px{*/
/*    margin-left: 52px;*/
/*}*/
/*.list-group-item{ */
    
/*    padding: 0px; */
/*    height: 50px;*/
/*    line-height:50px;*/
/*    cursor: pointer;*/
/*    transition-duration:0.3s;*/
/*}*/
/*.list-group-item:hover{*/
/*    background-color:  whitesmoke;*/
/*    text-decoration: none;*/
/*}*/
/*.list-group-item i{ */
/*    display: inline-block;*/
/*    width: 50px;*/
/*    text-align: center;*/
/*    color: gray;*/
/*}*/
/*.select_item{*/
/*    background-color: whitesmoke;*/
/*}*/
/*.sidebar__item_message_button{*/
/*    margin-left: 15px;*/
/*    padding: 4px 8px;*/
/*    background-color: #ff4a4a;*/
/*    color: white;*/
/*    border-radius: 50px;*/
/*}*/
</style>
<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく

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