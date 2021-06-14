<template>
  <v-app id="inspire">
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
          <h1 align="center">
              Cardeninho de Vendas
          </h1>

          <v-card class="elevation-12">
            <v-toolbar
              color="primary"
              dark
              flat
            >
              <v-toolbar-title>Acesso</v-toolbar-title>
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
              <v-btn color="primary" @click.prevent="acessar" :disabled="obj.email =='' || obj.senha ==''">Acessar</v-btn>
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
            sessionStorage.setItem('caderninho_vendas', JSON.stringify({
                jwt: json.data
            }));
            this.$router.push({name: 'Home'});
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
  }
</style>