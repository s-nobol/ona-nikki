<template>
    <div class="d-inline-block">
    
        
        <button 
            v-if="! followCheck"
            @click="follow" 
            class="btn p-1 btn-primary"
            >弟子入り</button>
           
        
        <button 
            v-if="followCheck"
            @click="follow" 
            class="btn p-1 btn-danger"
            >弟子入り済み</button>
           
           
           
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            require  : true,
        },
        followCheck: {
            type: Boolean,
            require  : true,
        },
    },
    data(){
        return{
            loading: false
        }
    },
    methods: {
        
        follow(){
            
            // ローディング中は操作できない
            if(this.loading){ return false }
            this.loading = true
            
            
            if(this.followCheck){
                this.deletefollow()  
            }else{
                this.createFollow()
            }
            
            this.loading = false
            
        },
        createFollow(){
            axios.post(`/api/follow/${this.id}`).then(response => {
                console.log('following',response); 
                if(response.status === 200){
                    this.$emit('chengeData')
                }
            })
        },
        deletefollow(){
            axios.delete(`/api/follow/${this.id}`).then(response => {
                console.log('followdelte',response); 
                if(response.status === 200){
                    this.$emit('chengeData')
                }
            })
        },
    }
}
</script>

      