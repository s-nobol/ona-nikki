<template>
    <div>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom ">
            
                <span class="header__title" @click="onHome">おな 日記</span>
                
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <span class="header__nowtime">{{ nowTime }}</span>
                        </li>
                    </ul>
                    <span v-if="currentUser"　class="navbar-text">
                        <button class="btn btn-danger" @click="createLog">送信</button>
                        <button class="btn btn-light" @click="logout">Logout</button>
                    </span>
                    <span v-else class="navbar-text">
                        <span @click="onLoginModal" class="login_button">ログイン</span>
                        <span @click="onSignup"class="login_button">サインアップ</span>
                    </span>
                </div>
            </nav> 
        </header>
        
        
        <!--フラッシュ-->
        <transition name="slide_down" >
        <div v-if="message" class="flash__form" :class="messageType">
            <div class=" container alert"  >{{ message }}{{ messageType}}</div>
        </div>
        </transition >
        
        
        <div class="row ">
            <!--サイドバー-->
            <div class="col-2">
                <Sidebar />
            </div>
            
            <!--メイン-->
            <main  class="col-10 pl-4 pr-4">
                 <RouterView />
            </main>
        </div>
        
            
            
        <!--モーダル-->
        <transition name="fade" >
            <LoginModal v-if="loginModal" @close="onCloseModal" />
        </transition >
        
        
        <!--モーダル-->
        <transition name="fade" >
            <LevelModal v-if="levelModal" @close="onCloseModal" />
        </transition >
        
        
        
        <footer>
            <div>日本全国オワコンプロジェクト111</div>
        </footer>
    </div>
</template>
<style type="text/css">
    
.fade-leave-active,.fade-enter-active{
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.slide_down-enter-active, .slide_down-leave-active {
    transition: all .5s;
}
.slide_down-enter, .slide_down-leave-to {
    height: 0;
}

</style>
<script>
import Sidebar from './components/Sidebar.vue'
import LoginModal from './components/modal/Login.vue'
import LevelModal from './components/modal/Level.vue'


export default {
    components: {Sidebar, LoginModal, LevelModal },
    data(){
        return{
            nowTime: new Date().getHours() + ':' +  new Date().getMinutes() ,
            loginModal: false,
            levelModal: false,
        }
    },
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
        message(){
            return this.$store.state.message
        },
        messageType(){
            return this.$store.state.message_type
        },
        // errorCode () {
        //     return this.$store.state.error.code
        // }
    },
      methods: {
        onHome(){
            this.$router.push("/")
        },
        logout(){
            axios.post(`/api/logout`).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.$store.commit('currentUser', null)
                }
            })
        },
        onSignup(){
            if(this.$router.name !== 'signup'){
                this.$router.push("/signup")
            }
        },
        createLog(){
            // axios.post(`/api/logs`).then(response => {
            //     console.log(response); 
            //     if(response.status === 200){
            //         this.$store.commit('currentUser', null)
            //     }
            // })
            this.levelModal = true
        },
        onLoginModal(){
            this.loginModal = true
        },
        onCloseModal() {
            this.loginModal = false
            this.levelModal = false
        },
    },
    watch: {
        errorCode: {
        // async handler (val) {
            
        //     // サーバーエラー1
        //     if (val === INTERNAL_SERVER_ERROR) {
        //         this.$router.push('/500')
                
        //     // ログインエラー
        //     } else if (val === UNAUTHORIZED) {
              
        //         await axios.get('/api/refresh-token')
        //         this.$store.commit('auth/setUser', null)
        //         this.$router.push('/401')
                
        //     // クライアントユーザーエラー
        //     } else if( val === 401 ){
        //         this.$router.push('/401')
        //     } else if(val === 403 ){
        //         this.$router.push('/403')
            
        //     // ページエラー
        //     } else if (val === NOT_FOUND) {
        //         this.$router.push('/not-found')
                
        //     }else{
        //     }
        //     this.$store.commit('error/setCode', null)
            
        // },
        // immediate: true
        },
    },
}
</script>