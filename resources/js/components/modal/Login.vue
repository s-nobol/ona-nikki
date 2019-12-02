<template>
<div >
    <div class="model" @click.self="$emit('close')">
        <div class="model__content">
            <form  class="LoginForm" @submit.prevent="login">
        
                <h4 class="LoginForm__title">ログイン</h4>
                <div v-if="errors">
                    <span v-for="msg in errors.email" :key="msg" class="text-danger">該当するユーザーが見つかりません</span>
                </div>
            
            
                <!--メールアドレス-->
                <div>
                    <label for="login-email">Email</label><br>
                    <input type="text" v-model="loginForm.email" >
                </div>
                
                
                <!--パスワード-->
                <div>
                    <label for="login-password">Password</label><br>
                    <input type="password" v-model="loginForm.password">
                </div>
                
                
                <!--ログインボタン-->
                <div class="LoginForm__button ">
                    <button type="submit" class="button button--inverse ">
                        <strong>Login</strong>
                    </button>
                </div>
                
                
                <div class="text-center pt-3 pb-3 LoginForm__border">
                    <span>または</span>
                </div>
                
                <div class="LoginForm__google">
                    <button class="LoginForm__google__button">
                        <i class="fab fa-google fa-lg "></i><span>sign up with <strong>Google</strong></span>
                    </button>
                </div>
                <div class="LoginForm__twitter">
                    <button class="LoginForm__twitter__button" @click="twitterLogin">
                        <i class="fab fa-twitter fa-lg "></i><span>sign up with <strong>Twitter</strong></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</template>
<style type="text/css">

</style>
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
    methods: {
        login(){
            axios.post(`/api/login`, this.loginForm).then(response => {
                
                console.log('ログイン成功', response);
                
                if(response.status === 200){
                    this.$store.commit('currentUser', response.data)
                    this.$emit('close')
                    
                    
                    this.$store.commit('message',{
                        type: 'success',
                        content: 'ログインしました',
                    })
                }
                
                if(response.status === 422){
                    this.errors = response.data.errors
                }
            })
        },
        
        // ツイッターログイン
        twitterLogin(){
            axios.get(`api/login/twitter`, this.loginForm).then(response => {
                window.location.href = response.data
            })
        }
    },
    created(){
        
            console.log("login")
    }
    
}
</script>