<template>
<div class="card p-3">

    <h3 class="p-2">カテゴリ一覧</h3>
    
    <table  v-if="categories" class="table p-2" >
                <thead class="text-center">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">名前</th>
                        <th scope="col" >カラー</th>
                        <th scope="col" >タイプ</th>
                        <th scope="col" >詳細</th>
                        <th scope="col">日付⇩</th>
                    </tr>
                </thead>
                <tbody v-for="category in categories" class="text-center">
                    <tr>
                        <!--id-->
                        <th scope="row">{{ category.id }}</th>
                        
                        <!--名前-->
                        <td v-if="editNumber !== category.id " content="name">
                            <span v-if="category.name">{{ category.name }}</span>
                            <span v-else>null</span>
                        </td>
                        <td v-if="editNumber === category.id " content="name">
                            <input type="text" v-model="category.name" />
                        </td>
                        
                        <!--カラー-->
                        <td v-if="editNumber !== category.id " content="color">
                            <span v-if="category.color">{{ category.color }}</span>
                            <span v-else>null</span>
                        </td>
                        <td v-if="editNumber === category.id " content="color">
                            <select v-model="category.color" :value="category.color">
                                <option 
                                    v-for="item in categories_color"
                                    :style="{ 'background-color': item.color }"
                                    :value="item.color"
                                    
                                    >{{ item.color }}</option>
                            </select>
                        </td>
                        
                        
                        <!--タイプ-->
                        <td content="coin">
                            <span 
                                class="p-2 text-white"
                                :style="{ 'background-color': category.color }"
                                >{{ category.color }}</span>
                        </td>
                        
                        
                        <!--編集-->
                        <td content="delete">
                            <button 
                                v-if="editNumber !== category.id "
                                class="btn btn-success pt-1 pb-1"
                                @click="onEditMode(category)"
                                >編集</button>
                            <button 
                                v-if="editNumber === category.id " 
                                class="btn btn-primary pt-1 pb-1" 
                                @click="onEditCategory(category)">
                                保存</button>
                            <button 
                                class="btn btn-danger pt-1 pb-1" 
                                @click="onDeleteCategory(category)"
                                >削除</button>
                        </td>
                        
                        <!--作成時間-->
                        <td content="created_at">{{ category.created_at }}</td>
                    </tr>
                </tbody>
            </table>

</div>
</template>
<style type="text/css">
</style>

<script>
export default {
    data(){
        return{
            
            categories: [],
            categories_color: [],
            mode: null,
            errors: [],
            editNumber: null,
            
        }
    },
    methods: {
        onEditMode(item){
            this.editNumber = item.id
        },
        getCategory(){
            axios.get(`/api/categories`).then(response => {
                console.log('category',response); 
                if(response.status === 200){
                    this.categories = response.data
                    this.categories_color = response.data
                }
            })
        },
        onEditCategory(item){
            console.log("color",item)
            axios.put(`/api/categories/${item.id}`, item).then(response => {
                console.log('category_edit',response); 
                if(response.status === 200){
                    this.user = response.data
                    this.editNumber = null
                    this.$store.commit('message',{
                        type: 'edit',
                        content: 'カテゴリーが編集されました',
                    })
                }
            })
        },
        onDeleteCategory(item){
            axios.delete(`/api/categories/${item.id}` ).then(response => {
                console.log('category_edit',response); 
                if(response.status === 200){
        			var index = this.logs.indexOf(item)
                    this.categories.splice(index, 1);
                    alert("カテゴリー削除しました")
                }
            })
        },
        
        changeMode(){
            const mode = ! this.mode
        }
        
        
    },
    created(){
        this.getCategory()
    },
}
</script>