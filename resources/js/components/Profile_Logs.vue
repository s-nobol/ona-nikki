<template>
    <div>
       
        <!--<div class="card">-->
        <!--    <span>すべて削除</span>-->
            
        <!--    <div>検索</div>-->
        <!--</div>-->
        <div class="card">
            <!--<div class="bg-light p-2">-->
                <h3><b>最新の記録 (30件)</b></h3>
            <!--</div>-->
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
                        <th scope="row">{{ log.id }} </th>
                        <td v-if="editNumber !== log.id " content="category">
                            <span v-if="log.category">{{ log.category }}</span>
                            <span v-else>null</span>
                        </td>
                        <td v-if="editNumber === log.id " content="category">
                            <select v-model="log.category" :value="log.category">
                                <option value="みかん">みかん</option>
                                <option value="リンゴ">リンゴ</option>
                                <option value="イチゴ">イチゴ</option>
                                <option value="ぶどう">ぶどう</option>
                            </select>
                        </td>
                        <td content="comment">作成中</td>
                        <td content="status">
                            <i class="fas fa-check-circle fa-lg text__gray" :class="{ 'text-success' : log.check }"></i>
                        </td>
                        <td content="delete">
                            <button v-if="editNumber !== log.id "class="btn btn-success pt-1 pb-1" @click="onEditMode(log)">編集</button>
                            <button v-if="editNumber === log.id " class="btn btn-primary pt-1 pb-1" @click="onEditLog(log)">保存</button>
                            <button class="btn btn-danger pt-1 pb-1" @click="onDeleteLog(log)">削除</button>
                        </td>
                        <td content="created_at">{{ log.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<style type="text/css">
.text__gray{  color: gray; }
</style>
<script>

export default {
    data(){
        return{
            logs: [],
            editNumber: null,
        }
    },
    methods: {
        get_logs(){
            axios.get(`/api/mypage/logs`).then(response => {
                console.log(response);
                this.logs = response.data.logs
            })
        },
        
        onEditMode(item){
            this.editNumber = item.id
        },
        onEditLog(item){
                // console.log('ログの削除',item);
            axios.put(`/api/logs/${item.id}`, item).then(response => {
                console.log('ログの編集',response);
                if(response.status === 200){
                    this.editNumber = null
                    this.$store.commit('message',{
                        type: 'edit',
                        content: '記録Logを編集しました',
                    })
                    if(response.data.check){ item.check = true }
                }      
                if (response.status !== 200) {
                    if(alert('編集できませんでした')){}
                    // this.$store.commit('error/setCode', response.status)
                    return false
                }
            
            })
        },
        onDeleteLog(item){
            axios.delete(`/api/logs/${item.id}`).then(response => {
                console.log('ログの削除',response);
                
                if (response.status !== 200) {
                    if(alert('削除できませんでした')){}
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