<template>
  <i-col span="5">
    <Sider hide-trigger class="second-menu-v">
      <Menu active-name="1-2" theme="light" class="second-menu-list-v" width="auto" :open-names="['1']">
        <Submenu name="1">
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
  </i-col>
</template>

<script>
    export default {
        name: "menu2nd-v"
    }
</script>

<style scoped>
  .second-menu-v{
    background: #fff;
    min-height: 920px;
    z-index:11;
  }
  .second-menu-list-v:after{
    background: #f5f7f9;
  }
</style>
