

require('./bootstrap');

window.Vue = require('vue');


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('chart-vue', require('./components/Chart.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
//  window.sessionStorage.getItem(['user']) はログイン・サインアップとログアウトのみ
 
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './App.vue'

function createApp() {
    
    // セッションのデータを確認
    store.commit('sessionCurrentUser')
    
    
    new Vue({
        el: '#app',
        router,
        store,
        components: { App },
        template: '<App />' 
    });
}

createApp()