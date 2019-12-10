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
            <div class=" container alert"  >{{ message }}</div>
        </div>
        </transition >
        
        
        <div class="row ">
            <!--サイドバー-->
            <div class="col-2">
                <Sidebar />
            </div>
            
            <!--メイン-->
            <main  class="col-10 pl-4 pr-4 pt-1">
                <div class="main__continer">
                    <RouterView />
                </div>
            </main>
        </div>
        
            
            
        <!--モーダル-->
        <transition name="fade" >
            <LoginModal v-if="loginModal" @close="onCloseModal" />
        </transition >
        
        
        <!--モーダル-->
        <transition name="fade" >
            <LevelModal v-if="levelModal" @close="onCloseModal" 
                :id="log_id"
                :value="value"
                :sizeing="sizeing"
                :before_level="before_level" 
                :before_point="before_point"
                :after_level="after_level" 
                :after_point="after_point"
                :after_experience_point="after_experience_point"
            />
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
            
            // レベルアップ
            log_id: null,
            value: 0,
            sizeing: 0 ,
            before_point: 0 ,
            before_level: 0,
            after_point: 0 ,
            after_level: 0,
            after_experience_point: 0,
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
            axios.post(`/api/logs`).then(response => {
                console.log(response)
                if(response.status === 200){
                    
                    // 現在のポイント
                    this.log_id = response.data.log.id
                    this.value = response.data.value_point 
                    this.sizeing =  response.data.sizeing
                    this.before_level =  response.data.before_level
                    this.before_point =  response.data.before_point 
                    this.after_level =  response.data.user.level
                    this.after_point =  response.data.user.point 
                    this.after_experience_point =  response.data.user.experience_point 
                    
                    this.levelModal = true
                }
                if(response.status === 404){
                    this.$store.commit('message',{
                        type: 'danger',
                        content: response.data.message,
                    })
                }
                
            })
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
        
        // ブラウジングログ起動
        currentUser(){
            // 初回ログインの時は外す(ログイン時にメッセージあり)
            if(this.message){return false}
            if(this.currentUser && this.currentUser.browsing_log){
                    this.createLog()
            }
        }
    },
}
</script>