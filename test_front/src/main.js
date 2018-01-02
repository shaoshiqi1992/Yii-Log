import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'

import http from './services/http.js'
import iView from 'iview';
import 'iview/dist/styles/iview.css'
import 'bootstrap/dist/css/bootstrap.css'
import Login from './views/login.vue'
import Home from './views/index.vue'
import AddCampaign from './modules/campaign/add.vue'


Vue.use(VueRouter);
Vue.use(iView);

Vue.prototype.$http = http



const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    {
      path: '/',
      component: Home,
      meta: {
        requireAuth: true
      }
    },
    {
      path: '/login',
      component: Login
    },
    {
      path:'/campaign/add',
      component:AddCampaign
    }
  ]
})
import Auth from './services/auth.js';

router.beforeEach((to, from, next) => {
  if(to.meta.requireAuth && !Auth.authenticated())
  {
    next({
      path: '/login',
      query: { redirect: to.fullPath }
    })
  }
  else {
    next()
  }
})

new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
});

export default router
