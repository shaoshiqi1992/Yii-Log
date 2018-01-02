<template>
  <Header style="padding: 0">
    <Menu mode="horizontal" theme="dark" active-name="1">
      <div class="layout-logo">
        <a href="/">
          <img src="../img/logo.png"/>
        </a>
      </div>
      <div class="layout-nav-panel">
        <MenuItem name="username" style="margin-left: 16px">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
          {{username}}
        </MenuItem>
        <MenuItem name="charge">
          <i class="fa fa-jpy" aria-hidden="true"></i>
        </MenuItem>
        <MenuItem name="notification">
          <i class="fa fa-envelope" aria-hidden="true"></i>
        </MenuItem>
        <MenuItem name="help">
          <i class="fa fa-question-circle" aria-hidden="true"></i>
        </MenuItem>
      </div>

      <div>
        <span v-if="msg.length > 0" @click="addcampaign" class="add-btn">
          <i class="fa fa-plus" aria-hidden="true"></i>
          Add Campaign
        </span>
      </div>

      <div class="layout-nav-quit">
        <span v-if="msg.length > 0" @click="logout" class="logout-btn">
          <i class="fa fa-sign-out" aria-hidden="true"></i>
          Quit
        </span>
      </div>


    </Menu>
    <!--
      <Icon @click.native="collapsedSider" :class="rotateIcon" :style="{margin: '20px 20px 0'}" type="navicon-round" size="24"></Icon>
    -->
  </Header>
</template>

<script>

  import Auth from '../services/auth.js'
  export default {
    props:['username','msg'],
    data(){
      return{
        isCollapsed: false
      }
    },
    methods:{
      addcampaign(){
        this.$router.push({path:'/campaign/add'});
      },
      logout(){
        let obj = {
          username:this.username
        };
        this.$http.post('/auth/logout', obj).then(
          (res)=>{
            //console.log(res);
            if(res.data.success){
              Auth.logout();
              this.$router.push({path:'/login'});
            }else{
              this.$Message.error(res.data.msg); // 登出失败
            }
            //console.log(localStorage.tk);
          }, (err) => {
            this.$Message.error('请求错误！')
          });
      }
    }
  }

</script>

<style scoped>
  .layout-logo{
  //border-radius: 3px;
    width: 175px;
  //background: aqua;
    float: left;
    position: relative;
    left: 25px;
  }
  .layout-nav-panel{
  //margin-right:100px;
  }
  .layout-nav-quit{
    margin-right: 25px;
  }
  .logout-btn{
    float:right;
    color: rgba(255,255,255,0.7);
    height:32px;
    margin: 16px 0;
    line-height: 32px;
    transition: all .2s ease-in-out;
  }
  .logout-btn:hover{
    cursor: pointer;
    color:#fff;
  }
  .add-btn{
    float:right;
    height: 64px;
    padding: 0 12px;
    line-height: 64px;
    margin:0 0 0 16px;
    transition: all .2s ease-in-out;
    background: #13c4a5;
  }
  .add-btn:hover{
    cursor: pointer;
    color:#fff;
  }
</style>
