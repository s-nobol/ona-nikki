import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    namespaced: true,
    
    state: {
        user: null,
        message: null,
        message_type: ''
    },
    
    getters:{
        currentUser:  state => state.user ? state.user : null,
    },
    
    
    mutations:{
        // ユーザーログイン
        currentUser (state, user) {
            state.user = user
            
        },
        async sessionCurrentUser(state) {
            const response = await axios.get('/api/currentUser')
            console.log("currentUser",response)
            const user = response.data || null
            state.user = user
        },
        
        // フラッシュメッセージ
        message( state, {type, content, }) {
            state.message = content
            state.message_type = 'flash-'+type
            setTimeout(() => (state.message = '' ,state.message_type = ''), 5000)
        },
    }

})

export default store