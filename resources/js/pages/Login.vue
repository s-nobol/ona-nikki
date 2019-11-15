<template>
<div>
    <div class="container">
        <!--ログイン処理のみ実行-->
        <form class="card "  @submit.prevent="login"> 
        
            <div>
                <label for="login-email">Email</label><br>
                <input type="text" v-model="loginForm.email" >
            </div>
            <div>
                <label for="login-password">Password</label><br>
                <input type="password" v-model="loginForm.password">
            </div>
            <div class="form__button">
                <button type="submit" class="button button--inverse">login</button>
            </div>
            
        </form>
        
        <div v-if="currentUser">{{ currentUser }}
        </div>
    </div>
</div>
</template>

<script>

export default {
    data(){
        return{
            loginForm: {
                email: '123@example.com',
                password: '123123123'
            },
            errors: {
                email: [],
                password: [],
            },
        }
    },
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },
    },
    methods: {
        login(){
            axios.post(`api/login`, this.loginForm).then(response => {
                
                console.log('ログイン成功', response);
                if(response.status === 200){
                    this.$store.commit('currentUser', response.data)
                }
            }).catch(err => {
                console.log(err);
            });
            

        }
    },
}
</script>