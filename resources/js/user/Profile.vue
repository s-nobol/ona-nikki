<template>
<div v-if="currentUser">

    <!--<h2>プロフィール</h2>-->
    
    <div class="card">
       <div class="row p-3">
       
       
                <!--ユーザー名-->
                <div class="col-3">
                        <img class="user_image" src="/image/myuser.jpg" alt="ユーザー画像">
                        <div class="Status__user">
                            <span class="Status__user__name">{{ currentUser.name }}</span>
                            <span class="Status__user__edit" @click="mode =! mode">編集</span><br>
                            <span class="Status__user__level">Lev.{{ currentUser.level }}</span>
                        </div>
                </div>
                
                
                <!--レベルゲージ-->
                <div class="col-3 plr-2 Status__gerge">
                    <small >これは次のレベルまであと {{ currentUser.experience_point }}pint</small>
                    <div class="user__gerge">
                        <div class="user__gerge__bar" id="gerge_bar">
                        </div>
                    </div>
                    <small>現在 {{ currentUser.point }}point</small>
                </div>
                
                
                <!--利用指数-->
                <div class="col-3 plr-2 ">
                    
                </div>
                
                
                <div class="col-3 plr-2 status__subtitle">
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
<style type="text/css">
.user_image{
    width: 55px;
    border-radius:55px;
}

.Status__user{
    vertical-align: middle;
    display: inline-block;
    padding-left: 15px;
}
.Status__user__name{
    font-size: 18px;
    font-weight: bold;
}
.Status__user__edit{
    color: mediumseagreen;
    cursor: pointer;
}
.Status__user__level{
    font-weight: bold;
}

.Status__gerge small{
    color: gray;
}
.user__gerge{
    background-color: whitesmoke;
    height: 15px;
}
.user__gerge__bar{
    background-color: mediumaquamarine;
    height: 15px;
    width: 0px;
}

.status__subtitle{
    color:gray;
    text-align: center;
}
.plr-2{ padding: 0px 20px; }
</style>

<script>
import Profile_UserForm from '../components/Profile_UserForm.vue'
import Profile_Logs from '../components/Profile_Logs.vue'
export default {
    components: { Profile_UserForm, Profile_Logs },
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
        onGergeWidth(){
            if(this.currentUser){
                var point_gerge = document.getElementById("gerge_bar");
                var currentUser_gerge = this.currentUser.point /  this.currentUser.experience_point *100
                console.log("UserLogs",currentUser_gerge)
                point_gerge.style.width = `${currentUser_gerge}%`
            }
        }
    },
    mounted(){
        setTimeout(() => ( this.onGergeWidth() ), 500)
    }
}
</script>