<template>
<div>
    <!--サイドバー-->
    <!--<div>サイドバー</div>-->
    
    
    <div v-if="currentUser">
        
        <div class="bg__red p-4"><b>{{ currentUser.name }}</b>　Lv.105 (エロ仙人)</div>
        <ul class="list-group">
            <li class="list-group-item bg__menu">
            年代
            </li>
            <li class="list-group-item ">
                <RouterLink  to="/mypage/logs/2018">2018</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/mypage/logs/2019">2019</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/mypage/logs">Logs</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/users/1">プロフィール</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/mypage">マイページ</RouterLink>
            </li>
            
            <li class="list-group-item">
                <RouterLink  to="/mypage/quest">クエスト</RouterLink>
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
                <RouterLink  to="/notification">お知らせ</RouterLink>
            </li>
            <li class="list-group-item">年代
            </li>
            <li class="list-group-item">
                <RouterLink  to="/logs/2017">2017</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/logs/2018">2018</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/logs/2019">2019</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/home">ホーム</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/sex">性別</RouterLink>
            </li>
            <!--<li class="list-group-item">-->
            <!--    <RouterLink  to="/age">年齢</RouterLink>-->
            <!--</li>-->
            <li class="list-group-item">
                <RouterLink  to="/location">都道府県</RouterLink>
            </li>
            <li class="list-group-item">
                <RouterLink  to="/about">おな日記について</RouterLink>
            </li>
        </ul>
            
</div>
</template>

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