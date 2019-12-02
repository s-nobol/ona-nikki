<template>
<div>

    <h2>プロフィール</h2>
    
    <div class="card">
       <div class="row">
                <div class="col-4 ">
                
                    <div class="media Profile_image p-3">
                        <img class="" src="/image/myuser.jpg" alt="ユーザー画像">
                        <div class="media-body m-0 mt-3 pl-4 text-left">
                            <h6 class="m-0 ">{{ user.name  }} <a href="/">自分と比較する</a></h6>
                            <h4 class="m-0"><span>Lv.256</span></h4>
                            <button class="btn btn-success" @click="changeMode">編集</button>
                        </div>
                    </div>
                    
                </div>
                <div class="col-8">
                    <ul class="Profile__Status">
                        <li class="Profile__Status__item">
                            <span class="Profile__Status__item__title">最高射精回数</span><br>
                            <span class="Profile__Status__item__content">15</span>
                        </li>
                        <li class="Profile__Status__item">
                            <span class="Profile__Status__item__title">最高射精回数</span><br>
                            <span class="Profile__Status__item__content">15</span>
                        </li>
                        <li class="Profile__Status__item">
                            <span class="Profile__Status__item__title">最高射精回数</span><br>
                            <span class="Profile__Status__item__content">15</span>
                        </li>
                        <li class="Profile__Status__item">
                            <span class="Profile__Status__item__title">最高射精回数</span><br>
                            <span class="Profile__Status__item__content">15</span>
                        </li>
                    </ul>
                </div>
            </div>
    </div>

    <div class="profile_form card p-5">
    
        
        <div class="text-center pl-5 pr-5  pb-5"> 
            <img class="profile_image" src="/image/myuser.jpg" alt="ユーザー画像">
        </div>
        
        <!--名前-->
        <div class="row mb-3">
            <div class="col-5">
                <span>名前</span>
            </div>
            <div class="col-7">
                <input type="text" name="name"/>
            </div>
        </div>
        
        
        
        <!--メールアドレス-->
        <div class="row mb-3">
            <div class="col-5">
                <span>メールアドレス</span>
            </div>
            <div class="col-7">
                <input type="text" name="name"/>
            </div>
        </div>
        
        
     
        
        <!--年齢-->
        <div class="row mb-3">
            <div class="col-5">
                <span>年齢</span>
            </div>
            <div class="col-7">
                <input type="text" name="name"/>
            </div>
        </div>
        
        
        <!--性別-->
        <div class="row mb-3">
            <div class="col-5">
                <span>性別</span>
            </div>
            <div class="col-7">
                <input type="text" name="name"/>
            </div>
        </div>
        
        
        <!--住所-->
        <div class="row mb-3">
            <div class="col-5">
                <span>住所</span>
            </div>
            <div class="col-7">
                <input type="text" name="name"/>
            </div>
        </div>
        
        
        <!--テーマ-->
        <div class="row mb-3">
            <div class="col-5">
                <span>テーマ</span>
            </div>
            <div class="col-7">
            </div>
        </div>
        
        <!--メールアドレスの同意-->
        <div class="row mb-3">
            <div class="col-5">
                <span>メールアドレスの同意</span>
            </div>
            <div class="col-7">
                同意する
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
        
        
    </div>
    
    
    <!--<div>-->
        
    <!--    <div> null  </div>-->
    <!--    <div>   ka1301@outlook.jp </div>-->
        
    <!--    <div> メール配信設定   </div>-->
    <!--    <div>    Progateからのお知らせを受け取る  </div>-->
    <!--    <div>  プライバシー設定   </div>-->
    <!--    <div>   自分のランキングを公開する    </div>-->
    <!--    <div>  友達検索に自分を表示する   </div>-->
    <!--</div>-->
        
   
</div>
</template>
<style type="text/css">
.profile_form{
    width: 75%;
}
.col-5{ 
    text-align: right;
    padding-right: 15px;
}
.col-7 input{
    padding: 5px;
    width: 50%;
}
.profile_image{
    width: 150px;
    border-radius:150px;
}
</style>

<script>
export default {
    props:{
        id: String
    },
    data(){
        return{
            
            user: [],
            mode: null,
            errors: [],
        }
    },
    methods: {
        getUser(){
            axios.get(`/api/users/${this.id}`).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.user = response.data
                }
            })
        },
        userEdit(){
            axios.put(`/api/users/${this.id}`, this.user ).then(response => {
                console.log(response); 
                if(response.status === 200){
                    this.user = response.data
                    this.$store.commit('message',{
                        type: 'edit',
                        content: 'ユーザーが編集されました',
                    })
                }
            })
        },
    },
    created(){
        this.getUser()
    },
}
</script>