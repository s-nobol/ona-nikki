import Vue from 'vue'
import Router from 'vue-router'


// // view
import index from './pages/Index.vue'

//home
import hoem from './home/Home.vue'
import sex from './home/Sex.vue'
import age from './home/Age.vue'
import location from './home/Location.vue'
import ranking from './home/Ranking.vue'
import about from './pages/About.vue'
import notification from './pages/Notification.vue'
import home_year from './home/Year.vue'
import home_month from './home/Month.vue'

//login & Oauth
import login from './pages/Login.vue'
import oauth from './pages/Oauth.vue'

//mypage
import mypage from './user/Mypage.vue'
import show from './user/Show.vue'
import logs from './user/Logs.vue'
import user_year from './user/Year.vue'
import user_month from './user/Month.vue'


Vue.use(Router)

export default new Router({
    routes: [
        // home
        { path: '/', component: index  },
        { path: '/hoem', component: index  },
        { path: '/about', component: about  },
        { path: '/notification', component: notification  },
        { path: '/sex', component: sex  },
        { path: '/age', component: age  },
        { path: '/location', component: location  },
        { path: '/ranking', component: ranking  },
        { path: '/logs/:year', component: home_year, props: true  },
        { path: '/logs/:year/:month', component: home_month,  props: true },
        
        //login && Oauth
        { path: '/login', component: login  },
        { path: '/login/:string/callback', component: oauth , props: true },
        
        // mypage
        { path: '/mypage', component: mypage  },
        { path: '/users/:id', component: show, props: true   },
        { path: '/mypage/logs', component: logs  },
        { path: '/mypage/logs/:year', component: user_year, props: true  },
        { path: '/mypage/logs/:year/:month', component: user_month,  props: true },
    ],
    
    base: process.env.BASE_URL,  // これ
    mode: 'history', // ★ 追加
})