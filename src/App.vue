<template>
  <div id="app">
    <v-main>
      <router-view></router-view>
    </v-main>
  </div>
</template>

<script>

export default {
  name: 'App',
  data: () => ({
  }),
  
};
</script>

<style>
  .v-application--wrap {
    background-image: url('https://www.dlojavirtual.com/wp-content/uploads/2015/09/onlinebusiness.jpg');
    background-size: cover;
    background-position: center;
  }
</style>