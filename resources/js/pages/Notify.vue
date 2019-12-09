<template>
    <div>
        <!--ランキング-->
        <h3 class="notify__title"><b>お知らせ一覧</b>
        
        <button  
            v-if="currentUser && currentUser.role > 2 " 
            class="btn btn-dark pt-1 pb-1"  
            @click="mode =! mode">作成</button>
        </h3>
        
        
        <div v-if="currentUser && currentUser.role > 2 " >
            
            <div v-if="mode" class="notify__container card p-2 mb-3">
            
                <!--エラー-->
                <div v-if="errors" class="errors text-danger">
                    <div v-if="errors.title" >
                        <span v-for="msg in errors.title" :key="msg" class="errors_item">{{ msg }}</span>
                    </div>
                    <div v-if="errors.description">
                        <span v-for="msg in errors.description" :key="msg" class="errors_item">{{ msg }}</span>
                    </div>
                </div>
            
                <!--タイトル-->
                <div class="notify__item__title">
                    <div>タイトル</div>
                    <input  type="text" v-model="notifyForm.title"/>
                </div>
                
                <!--説明-->
                <div class="notify__item__description">
                    <div>説明</div>
                    <textarea  v-model="notifyForm.description" rows="4" ></textarea>
                </div> 
                
                <!--管理者のみ実行可能-->
                <div class="notify__item__editform">
                    <button 
                    class="btn btn-primary pt-1 pb-1" 
                    @click="onCreateNotify">削除</button>
                </div>
                
            </div>
        </div>
       
       
       
       <!--お知らせ一覧-->
       <div v-if="notifies" class="notify__container">
       
       
           <div v-for="notify in notifies" class="card p-3">
           
               <!--タイトル-->
               <div class="notify__item__title">
                   <span v-if="editNumber !== notify.id ">  {{ notify.title }}</span>
                   <input  v-if="editNumber === notify.id " type="text" v-model="notify.title"/>
               </div>
               
               <!--説明-->
               <div class="notify__item__description">
                    <pre v-if="editNumber !== notify.id "><span>{{ notify.description }}</span></pre>
                    <textarea v-if="editNumber === notify.id" v-model="notify.description" rows="4" ></textarea>
               </div>
               
               
               <!--管理者のみ実行可能-->
               <div v-if="currentUser && currentUser.role > 2 " class="notify__item__editform">
                    <button 
                        v-if="editNumber !== notify.id "
                        class="btn btn-success pt-1 pb-1" 
                        @click="onEditMode(notify)">編集</button>
                    <button 
                        v-if="editNumber === notify.id " 
                        class="btn btn-primary pt-1 pb-1" 
                        @click="onEditNotify(notify)">保存</button>
                    <button 
                        v-if="editNumber !== notify.id "
                        class="btn btn-danger pt-1 pb-1" 
                        @click="onDeleteNotify(notify)">削除</button>
               </div>
           </div>
       
       
       
             <!--ページネーション-->
            <div v-if="lastPage > 1"  class="mt-5 text-center">
                <button
                    v-if="currentPage !== 1" 
                    @click="onPagenate('prev')"
                    class="btn btn-primary">前へ</button>
                <button 
                    v-if="currentPage !== lastPage" 
                    @click="onPagenate('next')"
                    class="btn btn-primary">次へ</button>
            </div>
       
       
       </div>
    </div>
</template>
<style type="text/css">
.notify__title{
    text-align: center;
    font-weight: bold;
    margin-bottom: 50px;
}
.notify__container{
    width: 60%; 
    margin: auto;
}

.notify__item__title {
    font-size: 23px;
}
.notify__item__description textarea{
    margin-top: 15px;
    width: 100%;
}
.notify__item__editform{ text-align: right;}
</style>
<script>
export default {
    data(){
        return{
            notifies: [],
            editNumber: null,
            
            //notify
            mode: false,
            notifyForm:{
                title: '',
                description: '',
            },
            errors: null,
            
            //ページネーション
            currentPage: 0,
            lastPage: 0
        }
    },
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    methods: {
        getNotify(){
            axios.get(`/api/notifies?page=${this.currentPage}`).then(response => {
                
                console.log('お知らせ取得', response);
                if(response.status === 200){
                    this.notifies = response.data.data
                    this.currentPage = response.data.current_page
                    this.lastPage = response.data.last_page
                }                
            })
        },
        
        onEditNotify(item){
            axios.put(`/api/notifies/${item.id}`, item ).then(response => {
                console.log('お知らせ編集', response);
                if(response.status === 200){
                    this.editNumber = null
                    this.$store.commit('message',{
                        type: 'edit',
                        content: '記録お知らせを編集しました',
                    })
                }                
            })
        },
        
        onDeleteNotify(item){
            axios.delete(`/api/notifies/${item.id}` ).then(response => {
                console.log('お知らせ削除', response);
                if(response.status === 200){
                    this.editNumber = null
        			var index = this.logs.indexOf(item)
                    this.logs.splice(index, 1);
                    this.$store.commit('message',{
                        type: 'danger',
                        content: '記録お知らせを削除しました',
                    })
                }                
            })
        },
        
        onCreateNotify(){
            axios.post(`/api/notifies` , this.notifyForm ).then(response => {
                console.log('お知らせ作成', response);
                if(response.status === 201 || response.status === 200 ){
                    this.mode = false
                    this.notifies.push(this.notifyForm)
                    this.resetErrors()
                    this.$store.commit('message',{
                        type: 'success',
                        content: '記録お知らせを削除しました',
                    })
                } 
                
                if(response.status === 422){
                    this.errors = response.data.errors
                }      
            })
        },
        resetErrors(){
            this.errors = []
            this.notifyForm.title = ''
            this.notifyForm.description = ''
        },
        onPagenate(name){
            if(name === 'prev'){
                this.currentPage -= 1
            }
            if(name === 'next'){
                this.currentPage += 1
            }
            this.notifies=[]
            this.getNotify()
            
        },
        
        
        onEditMode(item){
            this.editNumber = item.id
        },
    },
    created(){
        this.getNotify()
    }
}
</script>