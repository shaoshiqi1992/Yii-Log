<template>
  <div class="content">
    <h1>Home Page</h1>
    {{msg}}
    <Button v-if="msg.length > 0" @click="logout">logout</Button>

  </div>
</template>

<script>

  import Auth from '../services/auth.js'

  export default {
    data(){
      return {
        msg:""
      }
    },
    created(){

      this.$http.get('/item').then((res)=>{
        this.msg = res.data.msg;
      })

    },
    methods:{
      logout(){
        Auth.logout()
        this.$router.push({path:'/login'})
      }
    }
  }
</script>
