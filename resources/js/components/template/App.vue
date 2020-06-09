<template>
  <div>
    <app-header />
    <router-view></router-view>
  </div>
</template>

<script>
  import Header from '../header/header'
  export default {
    name: 'app',
    components: {
      'app-header': Header
    }
  }
</script>

<style>
  body, html {
    margin: 0;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  }
</style>