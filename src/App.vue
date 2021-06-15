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
  
  created() {
    if (this.session===null) {
      if (this.$router.currentRoute.name.indexOf('Login')===-1) this.$router.push({name: 'Login'});
    }else{
      if (this.$router.currentRoute.name.indexOf("app.home")===-1) this.$router.push({name: 'app.home'});
    }
  },
  computed: {
    session() {
      return this.getSession();
    }
  },
  methods:{
    getSession: function () {
      let session = JSON.parse(sessionStorage.getItem('caderninho_vendas'));
      if (session==null) return session;
      // limpando dados autenticados
      this.$store.state.session = session;
      return session;
    }
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