<template>
<div >
    <div class="model" @click.self="$emit('close')">
        <div class="model__content modal-dialog ">
        
            <div class="levelForm modal-content">
            
                <h5 class="mb-3">
                    <!--<i class="fas fa-exclamation-triangle fa-lg"></i>-->
                    ステータスが編集されていません
                </h5>
                
                <form @submit.prevent="onEditUser" class="text-left">
                    
                    
                    <div v-if="errors" class="errors text-danger">
                        <div v-if="errors.age">
                           <span v-for="msg in errors.age"  class="errors_item">{{ msg }}</span>
                        </div>
                        <div v-if="errors.sex">
                           <span v-for="msg in errors.sex" :key="msg" class="errors_item">{{ msg }}</span>
                        </div>
                        <div v-if="errors.location">
                           <span v-for="msg in errors.location" :key="msg" class="errors_item">{{ msg }}</span>
                        </div>
                        <div v-if="errors.career">
                           <span v-for="msg in errors.career" :key="msg" class="errors_item">{{ msg }}</span>
                        </div>
                    </div>
                
                    <!--年齢-->
                    <div class="AlertModal">
                        <label for="login-age" class="AlertModal__label">年齢</label>
                        <select v-model="currentUser.age" :value="currentUser.age">
                            <option value="10代">10代</option>
                            <option value="20代">20代</option>
                            <option value="30代">30代</option>
                            <option value="40代">40代</option>
                            <option value="50代">50代</option>
                            <option value="60代">60代</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                    
                    <!--性別-->
                    <div class="AlertModal">
                        <label for="login-sex" class="AlertModal__label">性別</label>
                        <input type="radio" id="man"  v-model="currentUser.sex" value="男"/>
                        <label for="man">男</label>
                        
                        <input type="radio" id="woman"  v-model="currentUser.sex" value="女"/>
                        <label for="woman">女</label>
                        
                        <input type="radio" id="other"   v-model="currentUser.sex" value="その他"/>
                        <label for="other">その他</label>
                    </div>
                    
                    
                    <!--地域-->
                    <div class="AlertModal">
                        <label for="login-location" class="AlertModal__label">住所</label>
                        <select v-model="currentUser.location" :value="currentUser.location">
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
                    
                    
                    <!--送信-->
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-danger ">
                            <strong>送信</strong>
                        </button>
                    </div>
                    
                    <!--送信-->
                    <!--<div class="LoginForm__button ">-->
                    <!--    <button type="submit" class="button button--inverse ">-->
                    <!--        <strong>送信</strong>-->
                    <!--    </button>-->
                    <!--</div>-->
                    
                    
                </form>
                
            </div>
            
        </div>
  </div>
  

  
</div>
</template>
<style type="text/css">
.AlertModal{
    padding:2px 0px;
}
.AlertModal__label{
    margin-right: 15px;
}
</style>
<script>
// テスト用のLevel.vue

// import UserForm from '../user/UserForm.vue'
export default {
    components: {  },
    data(){
        return{
            errors: null
        }
    },
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    methods: {
        onEditUser(){ 
            this.errors = null
            axios.put(`/api/users/${this.currentUser.id}/status_update`, this.currentUser).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.$store.commit('currentUser', response.data)
                    this.$store.commit('message',{
                        type: 'edit',
                        content: 'ユーザーが情報が更新されました',
                    })
                    this.$emit('close')
                }
                if(response.status === 422){
                    this.errors = response.data.errors
                }
                
            })
        },
        onClose(){
        // alert("ステータスを編集してください。")
            this.$emit('close')
        }
    },
    mounted(){
    }
    
}
</script>