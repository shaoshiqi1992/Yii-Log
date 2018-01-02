<style scoped>
  body{
    background: #404655;
  }
  .layout{
    background: #f5f7f9;
    position: relative;
    overflow: hidden;
  }

  .main-wrapper{
    background: #484e5f;
  }
  .content-wrapper{
    min-height: 920px;
    border-top-left-radius: 32px;
  }

  .first-level-menu{
    margin-top:32px;
    width: 32px;
    z-index: 100;
  }
</style>
<template>
  <div class="layout">
    <Layout>
      <pHeader :username="username" :msg="msg"></pHeader>
      <Layout class="main-wrapper">

        <Sider breakpoint="md" collapsible :collapsed-width="128" v-model="isCollapsed" class="first-level-menu">
          <pMenu1st :isCollapsed="isCollapsed"></pMenu1st>
        </Sider>

        <Layout class="content-wrapper" >
          <Row>
            <pMenu2nd></pMenu2nd>
              <Content :style="{margin: '20px'}">
                <Card>
                  <h1>Home Page</h1>
                  {{msg}}
                </Card>
              </Content>
          </Row>
        </Layout>

      </Layout>

    </Layout>
  </div>
</template>
<script>
  import header from '../../components/header.vue'
  import menu2ndh from '../../components/Menu2ndH.vue'
  import menu2ndv from '../../components/Menu2ndV.vue'
  import menu1st from '../../components/Menu1st'
  export default {
    name:'campaign-add',
    data () {
      return {
        msg:"",
        username:"",
        isCollapsed:false
      }
    },
    components:{
      pMenu1st:menu1st,
      pMenu2nd:menu2ndh,
      pHeader:header
    },
    computed: {

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
      }
    }
  }
</script>

