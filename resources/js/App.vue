<template>
    <div>
        <header>
            <Header />
        </header>
        
        
        <div class="row ">
            <!--サイドバー-->
            <div class="col-2">
                <Sidebar />
            </div>
            
            <!--メイン-->
            <main  class="col-8">
                 <RouterView />
            </main>
        
            <!--サイドバー-->
            <div class="col-2">
                <Rightbar />
            </div>
        </div>
        
        
        
        <footer>
                <div>日本全国オワコンプロジェクト111</div>
        </footer>
    </div>
</template>

<script>

import Header from './components/Header.vue'
import Sidebar from './components/Sidebar.vue'
import Rightbar from './components/Rightbar.vue'

export default {
    components: { Header, Sidebar ,Rightbar },
    data(){
        return{
        }
    },
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
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
        
        $route () {
            this.$store.commit('error/setCode', null)
        }
    },
}
</script>