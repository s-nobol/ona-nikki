import Vue from 'vue'
import Router from 'vue-router'


// // view
import index from './pages/Index.vue'
import test from './pages/Test.vue'

//home
import home from './home/Home.vue'
import sex from './home/Sex.vue'
import age from './home/Age.vue'
import location from './home/Location.vue'
import ranking from './home/Ranking.vue'
import about from './pages/About.vue'
import notification from './pages/Notification.vue'
import home_year from './home/Year.vue'
import home_month from './home/Month.vue'

//login & Oauth
import signup from './pages/Signup.vue'
import oauth from './pages/Oauth.vue'

//mypage
import mypage from './user/Mypage.vue'
import profile from './user/Profile.vue'
import show from './user/Show.vue'
import logs from './user/Logs.vue'
import user_year from './user/Year.vue'
// import user_month from './user/Month.vue'


Vue.use(Router)

export default new Router({
    routes: [
        // home
        { path: '/', component: index  },
        { path: '/home', component: home , name: 'home' },
        { path: '/about', component: about  , name: 'about'  },
        { path: '/notification', component: notification  , name: 'notification'  },
        { path: '/sex', component: sex  , name: 'sex'  },
        { path: '/age', component: age  , name: 'age'  },
        { path: '/location', component: location  , name: 'location'  },
        { path: '/ranking', component: ranking   , name: 'ranking' },
        { path: '/logs/:year', component: home_year, props: true  , name: 'home-year' },
        { path: '/logs/:year/:month', component: home_month,  props: true , name: 'home-month' },　
        
        //login && Oauth
        { path: '/signup', component: signup, name: 'signup'   },
        // { path: '/login', component: login  },
        { path: '/login/:string/callback', component: oauth , props: true },
        
        // mypage
        { path: '/mypage', component: mypage , name: 'mypage'  },
        { path: '/mypage/profile', component: profile , name: 'profile'  },
        { path: '/users/:id', component: show, props: true   },
        { path: '/mypage/logs', component: logs  , name: 'mypage-logs' },
        { path: '/mypage/logs/:year', component: user_year, props: true , name: 'mypage-year'  },
        // { path: '/mypage/logs/:year/:month', component: user_month,  props: true },//今は入れなくていい?
        
        
        { path: '/test', component: test },
    ],
    
    base: process.env.BASE_URL,  // これ
    mode: 'history', // ★ 追加
})