<template>
<div v-if="currentUser" class=" col-lg-9 p-0">
    <form v-if="user"   @submit.prevent="userEdit(user.id)" class="profile_form card p-5">
    
        
        <div class="row mb-3">
            <div class="col-5">
            </div>
            <div v-if="errors" class="errors text-danger col-7">
                <div v-if="errors.name" >
                   <span v-for="msg in errors.name" class="errors_item">{{ msg }}</span>
                </div>
                <div v-if="errors.email">
                   <span v-for="msg in errors.email"  class="errors_item">{{ msg }}</span>
                </div>
                <div v-if="errors.age">
                   <span v-for="msg in errors.age"  class="errors_item">{{ msg }}</span>
                </div>
                <div v-if="errors.sex">
                   <span v-for="msg in errors.sex" :key="msg" class="errors_item">{{ msg }}</span>
                </div>
                <div v-if="errors.location">
                   <span v-for="msg in errors.location" :key="msg" class="errors_item">{{ msg }}</span>
                </div>
                <div v-if="errors.browsing_log">
                   <span v-for="msg in errors.browsing_log" :key="msg" class="errors_item">{{ msg }}</span>
                </div>
                <div v-if="errors.receive_email">
                   <span v-for="msg in errors.receive_email" :key="msg" class="errors_item">{{ msg }}</span>
                </div>
            </div>
        </div>
        <!--<div class="text-center pl-5 pr-5  pb-5"> -->
        <!--    <img class="profile_image" src="/image/myuser.jpg" alt="ユーザー画像">-->
        <!--</div>-->
        
        <!--名前-->
        <div class="row mb-3">
            <div class="col-5">
                <span>名前</span>
            </div>
            <div class="col-7">
                <input type="text" name="name" v-model="user.name"/>
            </div>
        </div>
        
        
        
        <!--メールアドレス-->
        <div class="row mb-3">
            <div class="col-5">
                <span>メールアドレス</span>
            </div>
            <div class="col-7">
                <input type="text" name="email" v-model="user.email"/>
            </div>
        </div>
        
        
        <!--年齢-->
        <div class="row mb-3">
            <div class="col-5">
                <span>年齢</span>
            </div>
            <div class="col-7">
                <select v-model="user.age" :value="user.age">
                    <option value="10代">10代</option>
                    <option value="20代">20代</option>
                    <option value="30代">30代</option>
                    <option value="40代">40代</option>
                    <option value="50代">50代</option>
                    <option value="60代">60代</option>
                    <option value="その他">その他</option>
                </select>
            </div>
        </div>
        
        
        
        <!--性別-->
        <div class="row mb-3">
            <div class="col-5">
                <span>性別</span>
            </div>
            <div class="col-7">
                <input type="radio" id="man"  v-model="user.sex" value="男"/>
                <label for="man">男</label>
                
                <input type="radio" id="woman"  v-model="user.sex" value="女"/>
                <label for="woman">女</label>
                
                <input type="radio" id="other"   v-model="user.sex" value="その他"/>
                <label for="other">その他</label>
            </div>
        </div>
        
        
        
        <!--住所-->
        <div class="row mb-3">
            <div class="col-5">
                <span>住所</span>
            </div>
            <div class="col-7">
                <select v-model="user.location" :value="user.location">
                  <option value="北海道エリア">北海道エリア</option>
                  <option value="東北エリア">東北エリア</option>
                  <option value="関東エリア">関東エリア</option>
                  <option value="関東エリア">中部エリア</option>
                  <option value="関西エリア">関西エリア</option>
                  <option value="中国エリア">中国エリア</option>
                  <option value="四国エリア">四国エリア</option>
                  <option value="九州エリア">九州エリア</option>
                </select>
            </div>
        </div>
        
        
        <!--ブラウジングログ-->
        <div class="row mb-3">
            <div class="col-5">
                <span>ブラウザの起動と同時にログ</span>
            </div>
            <div class="col-7">
                <input type="checkbox" name="browsing_log"  v-model="user.browsing_log"/>
            </div>
        </div>
        
        
        <!--メールアドレスの同意-->
        <div class="row mb-3">
            <div class="col-5">
                <span>メールアドレスの同意</span>
            </div>
            <div class="col-7">
                <input type="checkbox" name="receive_email"  v-model="user.receive_email"/>
            </div>
        </div>
        
        
        <!--メールアドレスの同意-->
        <div class="row mb-3">
            <div class="col-5">
                <span>アカウントポリシーについて</span>
            </div>
            <div class="col-7">
                同意する
            </div>
        </div>
        
        
        <!--ボタン-->
        <div class="text-center">
            <button class="btn btn-primary">送信</button>
        </div>
        
        
    </form>
</div>
</template>
<style type="text/css">
.profile_form{
    /*width: 75%;*/
}
.profile_form input{
    padding: 5px;
    /*width: 50%;*/
}
.profile_form select{
    padding: 5px;
}
.profile_form span{
    display: inline-block;
    padding: 5px;
}
.col-5{ 
    text-align: right;
    padding-right: 15px;
}
</style>

<script>
export default {
    data(){
        return{
            
            user: [],
            mode: null,
            errors: [],
        }
    },
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    methods: {
        userEdit(id){
            this.errors = null
            axios.put(`/api/users/${id}`, this.user ).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.$store.commit('currentUser', response.data)
                    this.$store.commit('message',{
                        type: 'edit',
                        content: 'ユーザーが情報が更新されました',
                    })
                }
                if(response.status === 422){
                    this.errors = response.data.errors
                }
            })
        },
    },
    
    watch: {
        currentUser(){
            this.user = this.currentUser
        }
    },
    created(){
        this.user = this.currentUser
    }
}
</script>