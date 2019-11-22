<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom ">
    
        <!--<RouterLink to="/login">-->
            <span class="header__title" @click="onHome">おな 日記</span>
        <!--</RouterLink>-->
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
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
                <span @click="onLoginModal">ログイン</span>
                <RouterLink   to="/login">サインアップ</RouterLink>
            </span>
        </div>
    </nav>
    
    
    <!--モーダル-->
    <transition name="fade" >
        <LoginModal v-if="loginModal"@close="onCloseModal" />
    </transition >
    
    <!--モーダル-->
    <transition name="fade" >
        <LevelModal v-if="levelModal"@close="onCloseModal" />
    </transition >
   
</div>
</template>
<script>
import LoginModal from './modal/Login.vue'
import LevelModal from './modal/Level.vue'
export default {
    components: { LoginModal,LevelModal },
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
    created(){
    }
}
</script>