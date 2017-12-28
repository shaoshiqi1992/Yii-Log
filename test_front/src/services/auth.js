import setting from '../config/setting.js'
export default {
  login(data){
    localStorage.setItem(setting.userToken,data);
  },
  // authentication status
  authenticated(){
    var t = localStorage.getItem(setting.userToken);
    return t && t.length > 0;
  },
  getToken(){
    return localStorage.getItem(setting.userToken);
  },
  logout(){
    localStorage.setItem(setting.userToken,"");
  }
}
