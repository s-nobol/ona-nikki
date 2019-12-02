<template>
<div>
    <!--サイドバー-->
    <!--<div>サイドバー</div>-->
    
    
    <div v-if="currentUser" class="sidebar">
        
        <div class="bg__red p-4"><b>{{ currentUser.name }}</b>　Lv.105 (エロ仙人)</div>
        <ul class="list-group">
            <li class="list-group-item bg__menu">
            <i class="far fa-chart-bar fa-lg"></i>
            年代
            </li>
            <li class="list-group-item  pl-5">
                <RouterLink  to="/mypage/logs/2018" class="sidebar_item" >2018</RouterLink>
            </li>
            <li class="list-group-item pl-5">
                <RouterLink  to="/mypage/logs/2019" class="sidebar_item" >2019</RouterLink>
            </li>
            <li class="list-group-item  pl-5">
                <RouterLink  to="/mypage/logs" class="sidebar_item" >Logs</RouterLink>
            </li>
            <li class="list-group-item">
                <i class="far fa-address-card fa-lg"></i>
                <RouterLink  to="/mypage/profile" class="sidebar_item" >プロフィール</RouterLink>
            </li>
            <li class="list-group-item">
                <i class="fas fa-home fa-lg"></i>
                <RouterLink  to="/mypage" class="sidebar_item" >マイページ</RouterLink>
            </li>
            
            <li class="list-group-item">
                <i class="fas fa-envelope fa-lg"></i>
                <RouterLink  to="/mypage/notify" class="sidebar_item" >お知らせ</RouterLink>
            </li>
            
            
            <li class="list-group-item pl-5">
                <span>ログアウト</span>
            </li>
            
        </ul>
    </div>
    
    
    <div class="bg__red p-4">
        <b>2018年版</b>
    </div>
    
    
        <ul class="list-group">   
            <li class="list-group-item">
                <RouterLink  to="/notification" class="sidebar_item" >ホーム</RouterLink>
            </li>
            <li class="list-group-item">
            <i class="far fa-chart-bar fa-lg"></i>年代
            </li>
            
            
            <li class="list-group-item">
                <RouterLink  to="/logs/2018" class="sidebar_item" >2018</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/logs/2019" class="sidebar_item" >2019</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/home" class="sidebar_item" >ホーム</RouterLink>
            </li>
            <li class="list-group-item">
                <i class="fas fa-venus-mars  fa-lg"></i>
                <RouterLink  to="/sex" class="sidebar_item" >年齢・性別</RouterLink>
            </li>
            <li class="list-group-item">
                <i class="fas fa-thumbtack fa-lg"></i>
                <RouterLink  to="/location" class="sidebar_item" >都道府県</RouterLink>
            </li>
            <li class="list-group-item">
                <!--<i class="fas fa-ban fa-lg"></i>-->
                <RouterLink  to="/about" class="sidebar_item" >おな日記について</RouterLink>
            </li>
        </ul>
            
</div>
</template>
<style type="text/css">
.sidebar_item{
    color: black;
}
.sidebar_item:hover{
    color: gray;
    text-decoration: none;
}
.list-group-item{ padding: 10px 0px;}
.list-group-item i{ color: gray;}
</style>
<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく

export default {
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },
    },
}
</script>