import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'

import http from './services/http.js'
import {Button, Form,Input,Icon,FormItem} from 'iview';
import 'iview/dist/styles/iview.css';
import 'bootstrap/dist/css/bootstrap.css'

import Login from './components/Login.vue'
import Home from './components/Home.vue'


Vue.component('Button', Button);
Vue.component('Form', Form);
Vue.component('Input', Input);
Vue.component('Icon', Icon);
Vue.component('Form-item', FormItem);

Vue.prototype.$http = http
Vue.use(VueRouter);
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
