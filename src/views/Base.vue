<template>
    <v-app id="inspire" v-if="this.$store.getters.getSession!==null">
        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-list dense>
                <v-list-item>
                    <v-list-item-content>
                    <v-card class="mx-auto hover-scale-5s" max-width="220px">
                        <v-img class="align-end" width="220px" :src="profile_image">
                        </v-img>
                        <v-card-title>{{session.nome}}</v-card-title>
                    </v-card>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item class="hover-scale-5s" @click.prevent="navigateTo('app.home')">
                    <v-list-item-action>
                    <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item class="hover-scale-5s" @click.prevent="navigateTo('app.about')">
                    <v-list-item-action>
                    <v-icon>mdi-email</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>
                        About
                    </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item class="hover-scale-5s" @click.prevent="navigateTo('app.produtos')">
                    <v-list-item-action>
                    <v-icon>mdi-email</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>
                        Produtos
                    </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item class="hover-scale-5s" @click.prevent="alterTheme">
                    <v-list-item-action>
                    <v-icon>mdi-animation</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>Tema</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item class="hover-scale-5s" @click.prevent="logout">
                    <v-list-item-action>
                    <v-icon>mdi-logout</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>Sair</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app
            :color="tema"
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Application</v-toolbar-title>
        </v-app-bar>

        <template>
            <router-view></router-view>
        </template>

        <v-footer
            :color="tema"
            app
        >
            <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
        </v-footer>
    </v-app>
</template>

<script>

export default {
  name: 'Base',
  data: () => ({
    drawer: false,
    tema: '',
    rota: ''
  }),
  methods: {
    alterTheme () {
      this.tema = 'indigo';
      this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
    },
    navigateTo(where) {
      if (this.$router.currentRoute.name === where) return false;
      this.$router.push({name: where});
    },
    logout () {
      this.$store.getters.logout(this.$router);
    }
  },
  computed: {
      session() {
          return this.$store.state.session
      },
      profile_image() {
          return (this.session===null) ? '' : ('data:image/jpeg;base64,'+ this.session.foto);
      }
  },
  mounted() {
      this.$store.getters.inSession(this.$router);
  },
  created () {
    this.$vuetify.theme.dark = true
  },
};
</script>

<style scoped>
    .hover-scale-5s {
        transition: .5s;
    }
    .hover-scale-5s:hover{
        transform: scale(1.02);
    }
</style>