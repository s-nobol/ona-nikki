<template>
    <div>
       <!--テーブル--> 
       <table  v-if="dataSet" class="table p-2" >
            <thead class="text-center">
                <tr>
                    <th scope="col">id</th>
                    <!--<th scope="col">エリア</th>-->
                    <th scope="col">カテゴリー</th>
                    <!--<th scope="col" >コメント</th>-->
                    <th scope="col" >ステータス⇩</th>
                    <!--<th scope="col">詳細</th>-->
                    <th scope="col">日付⇩</th>
                </tr>
            </thead>
            <tbody v-for="log in dataSet" class="text-center">
                <tr>
                    <th scope="row">{{ log.id }}</th>
                    
                    <td content="category">カテゴリー</td>
                    <!--<td content="comment">テストコメント</td>-->
                    <td content="status">編集済み</td>
                    <!--<td content="delete">-->
                        <!--<button class="btn btn-danger pt-1 pb-1" @click="onDeleteLog(log)">削除</button>-->
                    <!--</td>-->
                    <td content="created_at">{{ log.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    props: {
        // エラーが出るので配列は一行まで
        dataSet: {
            type: Array,
            required: false,
            default: () => []
        },
    },
    // watch: {
    //     dataSet: function(labels){
    //     }
    // },
    methods: {
    }
}
</script>
