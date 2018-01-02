<template>
  <Menu mode="horizontal" theme="light" active-name="1" class="second-menu-h">
    <div class="layout-logo"></div>
    <div class="layout-nav">
      <MenuItem name="1">
        <Icon type="ios-navigate"></Icon>
        Item 1
      </MenuItem>
      <MenuItem name="2">
        <Icon type="ios-keypad"></Icon>
        Item 2
      </MenuItem>
      <MenuItem name="3">
        <Icon type="ios-analytics"></Icon>
        Item 3
      </MenuItem>
      <MenuItem name="4">
        <Icon type="ios-paper"></Icon>
        Item 4
      </MenuItem>
    </div>
  </Menu>
</template>

<script>
    export default {
        name: "menu2nd-h"
    }
</script>

<style scoped>
.second-menu-h{
  padding-left: 20px;
}
</style>
