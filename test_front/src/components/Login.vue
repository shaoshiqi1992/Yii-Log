<template>
  <div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="padding-top:10%">
        <p class="login-title">Login</p>
      </div>
    </div>
    <Form ref="formInline" :model="formInline" :rules="ruleInline" inline>
      <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 text-center col-md-offset-5 col-sm-offset-5 col-xs-offset-5">
          <Form-item prop="user">
            <Input type="text" v-model="formInline.username" placeholder="用户名">
            <i class="ivu-icon ivu-icon-ios-people-outline" slot="prepend"></i>
            </Input>
          </Form-item>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 text-center col-md-offset-5 col-sm-offset-5 col-xs-offset-5">
          <Form-item prop="password">
            <Input type="password" v-model="formInline.password" placeholder="密码">
            <Icon type="ios-locked-outline" slot="prepend"></Icon>
            </Input>
          </Form-item>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
          <Button type="primary" @click="handleSubmit('formInline')">登录</Button>
        </div>
      </div>
    </Form>
  </div>
</template>

<style>
  .login-title{
    font-family: '黑体 Bold', '黑体';
    font-weight: 700;
    font-style: normal;
    font-size: 13px;
    color: #7B7B7B;
  }
</style>
<script>
  import Auth from '../services/auth.js'

  export default {
    data () {
      return {
        formInline: {
          username: '',
          password: ''
        },
        ruleInline: {
          username: [
            { required: true, message: '请填写用户名', trigger: 'blur' }
          ],
          password: [
            { required: true, message: '请填写密码', trigger: 'blur' }
          ]
        }
      }
    },
    methods: {
      handleSubmit(name) {
        let obj = {
          username: this.formInline.username,
          password: this.formInline.password
        }
        if(this.formInline.username.length == 0 || this.formInline.password.length == 0){
          this.$Message.error("用户名或密码不能为空")
          return;
        }
        this.$http.post('/auth/index', obj)
          .then((res) => {
            console.log(res);
            if(res.data.success){
              Auth.login(res.data.msg);
              this.$router.push({path:'/'})
            }else{
              this.$Message.error(res.data.msg); // 登录失败，显示提示语
            }
          }, (err) => {
            this.$Message.error('请求错误！')
          })
      }
    }
  }
</script>
