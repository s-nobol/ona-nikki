<template>
    <div>
        <div class="card p-4">
       
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
            
            
            <!--ユーザー編集フォーム-->
            <transition name="slide_down">
            <div v-if="mode" class="UserEditForm">
                編集モード
                <form  @submit.prevent="userEdit" class="text-center">
                    <div class="row ">
                        <div class="col-6 text-right">      
                        
                            <label v-if="! user.oauth_check" >名前</label><br>
                            <!--<label >メールアドレス</label><br>-->
                            <label >年齢</label><br>
                            <label >性別</label><br>
                            <label >住所</label><br>
                            <label >テーマの変更</label><br>
                            <label >メールの受信</label><br>
                            <label>プライバシーポリシー : </label>
                        </div>
                        <div class="col-6 text-left">      
                        
                            
                            <div v-if="! user.oauth_check" >
                                <input type="text" name="name"  v-model="user.name" /><br>
                            </div>
                            <div>
                                <!--<input type="text" name="name"  v-model="user.email" /><br>-->
                            </div>
                            <div>
                                <select name="" v-model="user.age"><br>
                                    <option value="10代">10代</option>
                                    <option value="20代">20代</option>
                                    <option value="30代">30代</option>
                                    <option value="40代">40代</option>
                                    <option value="50代">50代</option>
                                    <option value="60代">60代</option>
                                    <option value="その他" selected>その他</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <input type="radio" id="one" value="男" v-model="user.sex"><label>男</label>
                                <input type="radio" id="two" value="女" v-model="user.sex"><label>女</label>
                                <input type="radio" id="three" value="その他" v-model="user.sex"><label>その他</label>
                            </div>
                            <div>
                                <select name="" v-model="user.address"><br>
                                    <option value="" selected>選択してください</option>
                                    <option value="北海道">北海道</option>
                                    <option value="東北">東北エリア</option>
                                    <option value="関東">関東エリア<</option>
                                    <option value="中部">中部エリア<</option>
                                    <option value="関西">関西エリア<</option>
                                    <option value="中国">中国エリア<</option>
                                    <option value="四国">四国エリア<</option>
                                    <option value="九州">九州エリア</option>
                                </select>
                            </div>
                            <div>
                                <input type="radio" id="one" value="赤" v-model="user.theme"><label>赤</label>
                                <input type="radio" id="two" value="青" v-model="user.theme"><label>青</label>
                                <input type="radio" id="three" value="黄色" v-model="user.theme"><label>黄色</label>
                            </div>
                            <div>
                                <input type="checkbox" id="checkbox" v-model="user.receive_email">
                            </div>
                            <div>
                                <label>同意しました : </label>
                            </div>
                            
                            <div>
                                <input type="submit"  class="btn btn-primary" value="保存"/>
                            </div>                  
                        </div>
                    </div>
                </form>
            </div>
            </transition>
            
        </div>
        
            
        <div class="card mt-3">
            <div class="row ">
                <div class="col-9 ">
                    <h4>グラフ折れ線グラフ（プロフィールページなのでグラフは多くなくていかも）</h4>
                    <img src="/image/chart.jpg"></img>
                </div>
                <div class="col-3 ">
                    データ
                </div>
            </div>
        </div>
        
        
            
        <div class="row  mt-3">
            <div class="col-4 card">
                <h4>グラフ折れ線グラフ</h4>
                <img src="/image/chart.jpg"></img>
            </div>
            <div class="col-4 card">
                <h4>グラフ折れ線グラフ</h4>
                <img src="/image/chart.jpg"></img>
            </div>
            <div class="col-4 card">
                データ
            </div>
        </div>
        
        <!--チャート-->
        <div class="row mt-3">
            <div class="col-6 card">
                <h4>絶対いるグラフ</h4>
                <img src="/image/chart.jpg"></img>
            </div>
            <div class="col-6 card">
                <table class="table ">
                    <thead>
                        <tr>
                        <th scope="col">id</th>
                        <th scope="col">日付</th>
                        <th scope="col">エリア</th>
                        <th scope="col">コメント</th>
                        <th scope="col">カテゴリー</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>日付</td>
                        <td>内容</td>
                        <td>内容</td>
                        <td>内容</td>
                        <td></td>
                        </tr>
                        <tr>
                        <th scope="row">1</th>
                        <td>日付</td>
                        <td>内容</td>
                        <td>内容</td>
                        <td>内容</td>
                        <td></td>
                        </tr>
                        <tr>
                        <th scope="row">1</th>
                        <td>日付</td>
                        <td>内容</td>
                        <td>内容</td>
                        <td>内容</td>
                        <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            
            
            
       
    </div>
</template>
<style type="text/css">
    .Profile{
        width:80%;
        margin: auto;
    }
.Profile_image{
    text-align: center;
}
.Profile_image img{
    width:75px;
    border-radius: 100px;
}


.Profile__Status{
    list-style: none;
    font-size:0px;
    margin: 0px;
    padding: 0px 0px;
}
.Profile__Status__item{
    display: inline-block;
    padding: 15px;
    text-align: center;
    border-left: solid #DDDDDD 1px;
}
.Profile__Status__item__title{
    font-size: 15px;
    color:gray;
}
.Profile__Status__item__content{
    font-size: 25px;
}

.UserEditForm{
    width:80%;
    height: 400px;
    overflow: hidden;
}
.UserEditForm label{
    font-size: 15px;
}
.UserEditForm input{
    padding:  5px;
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
        changeMode(){
             const mode = ! this.mode
            this.mode = mode
            window.sessionStorage.setItem(['mode'],[mode]);
        }
        
        
    },
    created(){
        this.getUser()
        this.mode = window.sessionStorage.getItem(['mode']); 
        
        
        axios.get(`/api/logs/1505/1` ).then(response => {
            console.log(response); 
        })
    },
}
</script>