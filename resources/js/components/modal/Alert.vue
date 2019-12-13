<template>
<div >
    <div class="model" @click.self="">
        <div class="model__content modal-dialog ">
        
            <div class="levelForm modal-content">
            
                <h3>アラート</h3>
            </div>
            
        </div>
  </div>
  

  
</div>
</template>
<style type="text/css">
</style>
<script>
// テスト用のLevel.vue
export default {
    props:{
        id:{ 
            type: Number, require: true,
        },
    },
    data(){
        return{
            
        }
    },
    
    computed: {
        currentUser(){
            return this.$store.getters['currentUser']
        },   
    },
    methods: {
    },
    mounted(){
        alert("ステータスを編集してください。")
    }
    
}
</script>