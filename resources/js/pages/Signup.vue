<template>
<div>
        
        
            <form  class="SignupForm card" @submit.prevent="signup">
        
                <h4 class="LoginForm__title">新規登録</h4>
                
                <div v-if="errors" class="errors text-danger">
                    <!--<span v-for="msg in errors.email" :key="msg" class="text-danger">該当するユーザーが見つかりません</span>-->
                    
                    <div v-if="errors.name" >
                       <span v-for="msg in errors.name" :key="msg" class="errors_item">{{ msg }}</span>
                    </div>
                    <div v-if="errors.email">
                       <span v-for="msg in errors.email" :key="msg" class="errors_item">{{ msg }}</span>
                    </div>
                    <div v-if="errors.password">
                       <span v-for="msg in errors.password" :key="msg" class="errors_item">{{ msg }}</span>
                    </div>
                </div>
            
                <!--名前-->
                <div>
                    <label for="login-name">Name</label><br>
                    <input type="text" v-model="loginForm.name"  name="name">
                </div>
                
            
                <!--メールアドレス-->
                <div>
                    <label for="login-email">Email</label><br>
                    <input type="text" v-model="loginForm.email"  name="email">
                </div>
                
                
                <!--パスワード-->
                <div>
                    <label for="login-password">Password</label><br>
                    <input type="password" v-model="loginForm.password" name="password">
                </div>
                
                <!--パスワード-->
                <div>
                    <label for="login-password">Password-confirmation</label><br>
                    <input type="password" v-model="loginForm.password_confirmation" name="password_confirmation">
                </div>
                
            
                
                <!--サインアップボタン-->
                <div class="LoginForm__button ">
                    <button type="submit" class="button button--inverse ">
                        <strong>signup</strong>
                    </button>
                </div>
                
                
                <!--<div class="text-center pt-3 pb-3 LoginForm__border">-->
                <!--    <span>または</span>-->
                <!--</div>-->
                
                <!--<div class="LoginForm__google">-->
                <!--    <button class="LoginForm__google__button">-->
                <!--        <i class="fab fa-google fa-lg "></i><span>sign up with <strong>Google</strong></span>-->
                <!--    </button>-->
                <!--</div>-->
                <!--<div class="LoginForm__twitter">-->
                <!--    <button class="LoginForm__twitter__button" @click="twitterLogin">-->
                <!--        <i class="fab fa-twitter fa-lg "></i><span>sign up with <strong>Twitter</strong></span>-->
                <!--    </button>-->
                <!--</div>-->
            </form>
            
            <!--<div >-->
            <!--    <i class="fab fa-twitter" @click="twitterLogin">ツイッターログイン</i>-->
            <!--</div>-->
            
        
</div>
</template>

<style type="text/css">
.SignupForm{
    padding: 30px;
    width: 340px;
    margin: auto;
    margin-top: 50px;
}
.SignupForm label{
    font-weight: bold;
}
.SignupForm input{
    width:100%;
    padding: 5px;
}

.errors{
    margin: 5px 0px;
    padding: 0px;
}

</style>
<script>

export default {
    data(){
        return{
            loginForm: {
                // name: '123',
                // email: '123@example.com',
                // password: '123123123'
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: [],
        }
    },
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },
    },
    methods: {
        signup(){
            
            this.errors = []
            axios.post(`/api/register`, this.loginForm).then(response => {
                
                console.log('サインイン成功', response);
                if(response.status === 200){
                    this.$store.commit('currentUser', response.data)
                }
                if(response.status === 201){
                    this.$store.commit('currentUser', response.data) 
                    this.$store.commit('message',{
                        type: 'success',
                        content: 'ログインしました',
                    })
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
    watch: {
        currentUser(){
            if(this.currentUser){
                this.$router.push('/mypage')
            }
        }
    },
    created(){
        if(this.currentUser){
            this.$router.push('/mypage')
        }
    }
}
</script>