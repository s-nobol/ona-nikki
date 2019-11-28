<template>
<div>
    <!--サイドバー-->
    <!--<div>サイドバー</div>-->
    
    
    <div v-if="currentUser" class="sidebar">
        
        <div class="bg__red p-4"><b>{{ currentUser.name }}</b>　Lv.105 (エロ仙人)</div>
        <ul class="list-group">
            <li class="list-group-item bg__menu">
            年代
            </li>
            <li class="list-group-item ">
                <RouterLink  to="/mypage/logs/2018" class="sidebar_item" >2018</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/mypage/logs/2019" class="sidebar_item" >2019</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/mypage/logs" class="sidebar_item" >Logs</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/users/1" class="sidebar_item" >プロフィール</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/mypage" class="sidebar_item" >マイページ</RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/mypage/quest" class="sidebar_item" >クエスト</RouterLink>
            </li>
            
            
            <li class="list-group-item">
            <a href="/donation">貢献施設</a>
            </li>
            
        </ul>
    </div>
    
    
    <div class="bg__red p-4">
        <b>2018年版</b>
    </div>
    
    
        <ul class="list-group">   
            <li class="list-group-item">
                <RouterLink  to="/notification" class="sidebar_item" >お知らせ</RouterLink>
            </li>
            <li class="list-group-item">年代
            </li>
            <li class="list-group-item">
                <RouterLink  to="/logs/2017" class="sidebar_item" >2017</RouterLink>
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
                <RouterLink  to="/sex" class="sidebar_item" >年齢・性別</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/location" class="sidebar_item" >都道府県</RouterLink>
            </li>
            <li class="list-group-item">
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