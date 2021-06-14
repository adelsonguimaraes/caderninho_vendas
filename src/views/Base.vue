<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-list dense>
                <v-list-item>
                    <v-list-item-content>
                    <v-card class="mx-auto" max-width="220px">
                        <v-img class="align-end" width="220px" :src="require('./assets/profile.jpg')">
                        <v-card-title>Usuário</v-card-title>
                        </v-img>
                    </v-card>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item @click.prevent="navigateTo('Home')">
                    <v-list-item-action>
                    <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item @click.prevent="navigateTo('About')">
                    <v-list-item-action>
                    <v-icon>mdi-email</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>
                        About
                    </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item @click.prevent="navigateTo('Produtos')">
                    <v-list-item-action>
                    <v-icon>mdi-email</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>
                        Produtos
                    </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link @click.prevent="alterTheme">
                    <v-list-item-action>
                    <v-icon>mdi-animation</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                    <v-list-item-title>Tema</v-list-item-title>
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

        <v-main>
            <!-- class="fill-height" -->
            <v-container
            fluid
            >
            <v-row
                align="center"
                justify="center"
            >
                <v-col class="text-center">

                <router-view></router-view>

                </v-col>
            </v-row>
            </v-container>
        </v-main>
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
  name: 'App',
  props: {
    source: String,
  },
  data: () => ({
    drawer: null,
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
    }
  },
  created () {
    this.$vuetify.theme.dark = true
  },
};
</script>