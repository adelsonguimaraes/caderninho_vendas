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
  
  mounted() {
    // if (this.$store.getters.getSession===null) {
    //   if (this.$router.currentRoute.name.indexOf('Login')===-1) this.$router.push({name: 'Login'});
    // }else{
    //   if (this.$router.currentRoute.name.indexOf('Login')!==-1) this.$router.push({name: 'app.home'});
    // }
    this.$store.getters.inSession(this.$router);
  },
  computed: {
  },
  methods:{
  }
};

</script>

<style>
  .v-application--wrap {
    background-image: url('https://www.dlojavirtual.com/wp-content/uploads/2015/09/onlinebusiness.jpg');
    /* background-image: url('https://d2ofpir5gh0cbr.cloudfront.net/files/2016-06/1466011935_cadernos-header1.jpg'); */
    background-size: cover;
    background-position: center;
    background-blend-mode: overlay;
    background-color: #191919;
  }
</style>