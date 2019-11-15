<template>
<div>
    <div class="container">
        
        <h4>ログイン</h4>
        <!--ログイン処理のみ実行-->
        <form class="card "  @submit.prevent="login">
        
        
            <div v-if="errors">
                <span v-for="msg in errors.email" :key="msg" class="text-danger">{{ msg }}</span>
                <span v-for="msg in errors.password" :key="msg" class="text-danger">{{ msg }}</span>
            </div>
        
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
            
            <div >
                <i class="fab fa-twitter" @click="twitterLogin">ツイッターログイン</i>
            </div>
        </form>
        
        
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
                if(response.status === 422){
                    this.errors = response.data.errors
                }
                
            }).catch(err => {
                console.log(err);
            });
        },
        
        
        twitterLogin(){
            axios.get(`api/login/twitter`, this.loginForm).then(response => {
                
                console.log(response);
                window.location.href = response.data
                
            }).catch(err => {
                console.log(err);
            });
        }
    },
}
</script>