import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    namespaced: true,
    
    state: {
        user: null,
    },
    
    getters:{
        currentUser:  state => state.user ? state.user : null,
    },
    
    
    mutations:{
        currentUser (state, user) {
            state.user = user
            
        },
        async sessionCurrentUser(state) {
            const response = await axios.get('/api/currentUser')
            const user = response.data || null
            state.user = user
            // var user = window.sessionStorage.getItem(['user'])
            // if(user){
            //     state.user = user
            // }
        },
    }

})

export default store