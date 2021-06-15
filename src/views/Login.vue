<template>
  <v-app id="inspire">

    <h1 align="center">
        Caderninho de Vendas
        <small>Acompanhamento de pedidos e vendas</small>
    </h1>

    <v-container class="fill-height" fluid>
      <v-row
        align="center"
        justify="center"
      >
        <v-col
          cols="12"
          sm="8"
          md="4"
        >
          <v-card class="elevation-12">
            <v-toolbar
              color="primary"
              dark
              flat
            >
              <v-toolbar-title>Acessar</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <v-btn
                    @click.prevent="resetPassword = !resetPassword"
                    icon
                    large
                    v-on="on"
                  >
                    <v-icon>mdi-key-chain</v-icon>
                  </v-btn>
                </template>
                <span>Esqueci a senha</span>
              </v-tooltip>
            </v-toolbar>
            <v-card-text>
              <v-alert
                dense
                outlined
                type="error"
                v-if="error!=''"
              >
                {{error}}
              </v-alert>
              <v-form>
                <v-text-field
                  label="Email"
                  name="email"
                  prepend-icon="mdi-account"
                  type="text"
                  v-model="obj.email"
                  autocomplete="off"
                ></v-text-field>

                <v-text-field
                  id="senha"
                  label="Senha"
                  name="senha"
                  prepend-icon="mdi-lock"
                  type="password"
                  v-model="obj.senha"
                  autocomplete="off"
                ></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click.prevent="acessar" :disabled="formValid">Acessar</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default ({
    data:() => ({
      obj: {
        email: '',
        senha: ''
      },
      error: '',
      resetPassword: false
    }),

    computed: {
      formValid: function () {
        return (this.obj.email !== '' && this.obj.senha !== '') ? false : true;
      }
    },

    created () {
      let session = JSON.parse(sessionStorage.getItem('caderninho_vendas'));
      if (session!==null) {
        this.$router.push({name: 'App'});
      }
    },

    methods: {
      acessar() {
        let copy = Object.assign(this.obj)
        
        fetch('http://localhost/caderninho_vendas/api/src/rest/acessar.php', {
          method: 'POST',
          body: JSON.stringify(copy)
        })
        .then(r=>r.json())
        .then(json => {
          if (json.success) {
            this.$store.getters.login(json.data, this.$router);
            // this.$router.push({name: 'app.home'});
          }else{
            this.error = json.msg;
          }
        })
      }
    }
  })
</script>

<style scoped>
  h1 {
    padding: 30px 0;
    font-weight: bold;
    font-size: 45px;
    color: burlywood;
    text-shadow: 3px 3px rgb(35 35 35);
    position: absolute;
    width: 100%;
  }
  small {
    font-size: 20px;
    display: block;
  }
</style>