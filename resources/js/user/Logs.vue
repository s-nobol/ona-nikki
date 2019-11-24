<template>
    <div>
       
        <!--<div class="card">-->
        <!--    <span>すべて削除</span>-->
            
        <!--    <div>検索</div>-->
        <!--</div>-->
        <div class="card">
            <div class="bg-light p-2">
                <h3>・<b>最新のLog (30件)</b></h3>
            </div>
            <table  v-if="logs" class="table p-2" >
                <thead class="text-center">
                    <tr>
                        <th scope="col">id</th>
                        <!--<th scope="col">エリア</th>-->
                        <th scope="col">カテゴリー</th>
                        <th scope="col" >コメント</th>
                        <th scope="col" >ステータス⇩</th>
                        <th scope="col">詳細</th>
                        <th scope="col">日付⇩</th>
                    </tr>
                </thead>
                <tbody v-for="log in logs" class="text-center">
                    <tr>
                        <th scope="row">{{ log.id }}</th>
                        
                        <td content="category">カテゴリー</td>
                        <td content="comment">テストコメント</td>
                        <td content="status">編集済み</td>
                        <td content="delete">
                            <button class="btn btn-danger pt-1 pb-1" @click="onDeleteLog(log)">削除</button>
                        </td>
                        <td content="created_at">{{ log.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
// 初めに複数のチャートのデータを取得
// まとめて表示する
// chartディレクｓトリに素材ごとのチャートをいれておく

export default {
    data(){
        return{
            logs: []
        }
    },
    methods: {
        get_logs(){
            axios.get(`/api/mypage/logs`).then(response => {
                console.log(response);
                this.logs = response.data.logs
            })
        },
        onDeleteLog(item){
            axios.delete(`/api/logs/${item.id}`).then(response => {
                console.log(response);
                
                if (response.status !== 200) {
                    if(alert('コメントが削除できませんでした')){}
                    // this.$store.commit('error/setCode', response.status)
                    return false
                }
            
                if(response.status === 200){
        			var index = this.logs.indexOf(item)
                    this.logs.splice(index, 1);
                    this.$store.commit('message',{
                        type: 'success',
                        content: 'Logを削除しました',
                    })
                }
            })
        }
    },
    created(){
        this.get_logs()
    }
}
</script>