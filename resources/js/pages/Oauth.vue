<template>
<div>
</div>
</template>

<script>

export default {

    props: {
         string: String,
    },
    created() {
            axios.get(`/api/login/${this.string}/callback`, { params: this.$route.query })
            .then(response => {
                
                console.log('OAoth-ログイン成功', response);
                if(response.status === 201){
                    this.$store.commit('currentUser', response.data)
                }
                if(response.status === 200){
                    this.$store.commit('currentUser', response.data)
                }
            })
            
            this.$router.replace('/')
    },
    
}
</script>