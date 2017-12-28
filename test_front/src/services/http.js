import axios from 'axios'
import setting from '../config/setting.js'
import router from '../main.js'
import Auth from './auth.js'

// axios 配置
axios.defaults.timeout = 5000;
axios.defaults.baseURL = setting.remoteHost;

// http request 拦截器
axios.interceptors.request.use(
  config => {
    if (Auth.authenticated()) {
      var token = Auth.getToken();
      //console.log(token);
      config.headers.common["Authorization"] = `Bearer ${token}`;
    }
    return config;
  },
  err => {
    return Promise.reject(err);
  }
);
axios.interceptors.response.use(
  response => {
    return response;
  },
  error => {
    if (error.response) {
      switch (error.response.status) {
        case 401:
          // 401 清除token信息并跳转到登录页面
          Auth.logout()
          router.replace({
            path: 'login',
            query: {redirect: router.currentRoute.fullPath}
          })
      }
    }
    console.log(error);//console : Error: Request failed with status code 402
    return Promise.reject(error)
  });
export default axios;
