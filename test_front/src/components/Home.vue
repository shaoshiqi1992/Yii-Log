<style scoped>
  body{
    background: #404655;
  }
  .layout{
    //border: 1px solid #d7dde4;
    background: #f5f7f9;
    position: relative;
    //border-radius: 4px;
    overflow: hidden;
  }
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
  .menu-item span{
    display: inline-block;
    overflow: hidden;
    width: 69px;
    text-overflow: ellipsis;
    white-space: nowrap;
    vertical-align: bottom;
    transition: width .2s ease .2s;
  }
  .menu-item i{
    transform: translateX(0px);
    transition: font-size .2s ease, transform .2s ease;
    vertical-align: middle;
    font-size: 16px;
  }
  .collapsed-menu span{
    width: 0px;
    transition: width .2s ease;
  }
  .collapsed-menu i{
    transform: translateX(5px);
    transition: font-size .2s ease .2s, transform .2s ease .2s;
    vertical-align: middle;
    font-size: 22px;
  }
  .logout-btn{
    float:right;
    color: rgba(255,255,255,0.7);
    height:32px;
    margin: 16px 0;
    line-height: 32px;
  }
  .logout-btn:hover{
    cursor: pointer;
  }
  .main-wrapper{
    background: #484e5f;
  }
  .content-wrapper{
    min-height: 920px;
    border-top-left-radius: 32px;
    //border:3px solid black;
  }
</style>
<template>
  <div class="layout">
    <Layout>
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
      <Layout class="main-wrapper">
        <Sider ref="side1" hide-trigger collapsible :collapsed-width="78" v-model="isCollapsed">
          <Menu active-name="1-2" theme="dark" width="auto" :open-names="['1']" style="margin-top: 32px;">
            <Submenu name="">
              <template slot="title">
                <Icon type="ios-navigate"></Icon>
                Item 1
              </template>
              <MenuItem name="1-1">Option 1</MenuItem>
              <MenuItem name="1-2">Option 2</MenuItem>
              <MenuItem name="1-3">Option 3</MenuItem>
            </Submenu>
            <Submenu name="2">
              <template slot="title">
                <Icon type="ios-keypad"></Icon>
                Item 2
              </template>
              <MenuItem name="2-1">Option 1</MenuItem>
              <MenuItem name="2-2">Option 2</MenuItem>
            </Submenu>
            <Submenu name="3">
              <template slot="title">
                <Icon type="ios-analytics"></Icon>
                Item 3
              </template>
              <MenuItem name="3-1">Option 1</MenuItem>
              <MenuItem name="3-2">Option 2</MenuItem>
            </Submenu>
          </Menu>
        </Sider>
        <Layout class="content-wrapper" >
          <Breadcrumb :style="{margin: '16px 20px'}">
            <BreadcrumbItem>Home</BreadcrumbItem>
            <BreadcrumbItem>Components</BreadcrumbItem>
            <BreadcrumbItem>Layout</BreadcrumbItem>
          </Breadcrumb>
          <Content :style="{margin: '20px', background: '#fff', minHeight: '260px'}">

            <div class="content">
              <h1>Home Page</h1>
              {{msg}}

            </div>
          </Content>
        </Layout>
      </Layout>

    </Layout>
  </div>
</template>
<script>
  import Auth from '../services/auth.js'
  export default {
    data () {
      return {
        isCollapsed: false,
        msg:"",
        username:""
      }
    },
    computed: {
      rotateIcon () {
        return [
          'menu-icon',
          this.isCollapsed ? 'rotate-icon' : ''
        ];
      },
      menuitemClasses () {
        return [
          'menu-item',
          this.isCollapsed ? 'collapsed-menu' : ''
        ]
      }
    },
    created(){

      this.$http.get('/user').then((res)=>{
        this.msg = res.data.msg;
        this.username =res.data.username;
      })

    },
    methods: {
      collapsedSider () {
        this.$refs.side1.toggleCollapse();
      },
      logout(){
        let obj = {
          username:this.username
        };
        this.$http.post('/auth/logout', obj).then(
          (res)=>{
            console.log(res);
            if(res.data.success){
              Auth.logout();
              this.$router.push({path:'/login'})
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


