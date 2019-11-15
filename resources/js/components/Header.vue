<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom ">
        <a class="navbar-brand" href="#">おな日記</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="#"> 08:15 <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <span class="navbar-text">
                
                <RouterLink v-if="! currentUser" to="/login">ログイン</RouterLink>
                <RouterLink v-if="! currentUser" to="/login">サインアップ</RouterLink>
                
                <button  v-if="currentUser"class="btn btn-danger" @click="createLog">送信</button>
                <button  v-if="currentUser"class="btn btn-light" @click="logout">Logout</button>
            </span>
        </div>
    </nav>
   
</div>
</template>

<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく

export default {
    data(){
        return{
        }
    },
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },
    },
    methods: {
        logout(){
            axios.post(`/api/logout`).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.$store.commit('currentUser', null)
                }
            }).catch(err => {
                console.log(err);
            });

        },
        createLog(){
            }
    },
    created(){
    }
}
</script>