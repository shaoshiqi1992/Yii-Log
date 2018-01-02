<template>
  <div>
    <Menu active-name="campaign" theme="dark" width="auto" :class="menuitemClasses">
      <MenuItem name="home">
        <i class="fa fa-th-list" aria-hidden="true"></i>
        <span>Home</span>
      </MenuItem>
      <MenuItem name="campaign">
        <i class="fa fa-line-chart" aria-hidden="true"></i>
        <span>Campaign</span>
      </MenuItem>
      <MenuItem name="report">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        <span>Report</span>
      </MenuItem>
      <MenuItem name="finance">
        <i class="fa fa-money" aria-hidden="true"></i>
        <span>Finance</span>
      </MenuItem>
      <MenuItem name="tools">
        <i class="fa fa-wrench" aria-hidden="true"></i>
        <span>Tools</span>
      </MenuItem>
    </Menu>
    <div slot="trigger"></div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
      }
    },
    props:['isCollapsed'],
    computed:{
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
    }

  }
</script>

<style scoped>

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

  .ivu-menu-dark.ivu-menu-vertical .ivu-menu-item-active:not(.ivu-menu-submenu), .ivu-menu-dark.ivu-menu-vertical .ivu-menu-submenu-title-active:not(.ivu-menu-submenu) {
    color: #2d8cf0;
    border-left: 2px solid #2d8cf0;
    border-right: none;
  }
</style>
