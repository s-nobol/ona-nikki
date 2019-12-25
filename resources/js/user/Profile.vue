<template>
<div v-if="currentUser">

    <!--<h2>プロフィール</h2>-->
    
    <div class="card">
       <div class="row p-3">
       
       
                <!--ユーザー名-->
                <div class="col-sm-3 Profile__image">
                    <img v-if="user.oauth_image" class="user_image" :src="currentUser.oauth_image" alt="ユーザー画像">
                    <img v-if="! user.oauth_image" class="user_image" src="/image/noimage.jpg" alt="ユーザー画像">
               
                   
                    <div class="Profile__user">
                        <span class="Profile__user__name">{{ currentUser.name }}</span>
                        <span class="Profile__user__edit" @click="mode =! mode">編集</span><br>
                        <span class="Profile__user__level">Lev.{{ currentUser.level }}</span>
                    </div>
                </div>
                
                
                <!--レベルゲージ-->
                <div class="col-sm-3 plr-2 Profile__gerge">
                    <small >これは次のレベルまであと {{ currentUser.experience_point }}pint</small>
                    <div class="user__gerge">
                        <div class="user__gerge__bar" id="gerge_bar">
                        </div>
                    </div>
                    <small>現在 {{ currentUser.point }}point</small>
                </div>
                
                
                <!--利用指数-->
                <div class="col-sm-3 plr-2">
                    
                </div>
                
                
                <div class="col-sm-3 plr-2 Profile__subtitle">
                    <div class="mt-2">{{ currentUser.name }}</div>
                    <div class="">{{ currentUser.email }}</div>
                </div>
            </div>
    </div>
    
    <div v-if="mode">
        <Profile_UserForm />
    </div>
    <div>
        <Profile_Logs />
    </div>

</div>
</template>
<script>
import Profile_UserForm from '../components/user/UserForm.vue'
import Profile_Logs from '../components/user/Logs.vue'
export default {
    components: { Profile_UserForm, Profile_Logs },
    data(){
        return{
            user: [],
            mode: null,
            errors: [],
            
            // カテゴリー
            categories: [],
            categories_color: [],
        }
    },
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    methods: {
        onGergeWidth(){
            if(this.currentUser){
                var point_gerge = document.getElementById("gerge_bar");
                var currentUser_gerge = this.currentUser.point /  this.currentUser.experience_point *100
                console.log("UserLogs",currentUser_gerge)
                point_gerge.style.width = `${currentUser_gerge}%`
            }
        },
        
        getDonation(){
            axios.get(`/api/users/logs/donation`).then(response => {
                console.log('user_donation',response); 
                if(response.status === 200){
                }
            })
        },
    },
    mounted(){
        this.getDonation()
        setTimeout(() => ( this.onGergeWidth() ), 500)
    }
}
</script>