<template>
  <v-container fluid>
    <v-row
        align="center"
        justify="center"
    >
      <v-col class="text-center">
        <v-data-table
          :headers="headers"
          :items="itens"
          sort-by="id"
          class="elevation-1"
        >
          <template v-slot:top>
            <v-alert
              dense
              outlined
              type="error"
              v-if="error!=''"
            >
              {{error}}
            </v-alert>
            <v-toolbar flat color="indigo">
              <v-toolbar-title>Produtos</v-toolbar-title>
              <v-divider
                class="mx-4"
                inset
                vertical
              ></v-divider>
              <v-spacer></v-spacer>
              <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="attrs"
                    v-on="on"
                  >Novo</v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                  </v-card-title>

                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field v-model="editedItem.nome" label="Nome"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <!-- <v-text-field prefix="R$" v-model="editedItem.preco" label="Preço"></v-text-field> -->
                          <v-text-field-money
                            v-model="editedItem.preco"
                            label="preco"
                            v-bind:properties="{
                              prefix: 'R$',
                              readonly: false,
                              disabled: false,
                              outlined: false,
                              clearable: true,
                              placeholder: ' ',
                            }"
                            v-bind:options="{
                              locale: 'pt-BR',
                              length: 6,
                              precision: 2,
                              empty: null,
                            }"
                          />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editedItem.quantidade" type="tel" label="Estoque" @keyup.prevent="only_number()"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                          <!-- <v-text-field v-model="editedItem.foto" label="Foto"></v-text-field> -->
                          <v-file-input truncate-length="15" counter label="Imagem">
                          </v-file-input>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                    <v-btn color="blue darken-1" text @click="save">Salvar</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon
              small
              class="mr-2"
              @click="editItem(item)"
            >
              mdi-pencil
            </v-icon>
            <v-icon
              small
              @click="deleteItem(item)"
            >
              mdi-delete
            </v-icon>
          </template>
          <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Refresh</v-btn>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  // import MD5 from 'crypto-js/md5';
  
  export default {
    data() {
      return {
        error: '',
        dialog: false,
        headers: [
          {
            text: 'Nome',
            align: 'start',
            sortable: true,
            value: 'nome',
          },
          {
            text: 'Preço',
            align: 'end',
            sortable: true,
            value: 'preco',
          },
          {
            text: 'Estoque',
            align: 'start',
            sortable: true,
            value: 'quantidade',
          },
          {
            text: 'Foto',
            align: 'center',
            sortable: false,
            value: 'foto',
          }
        ],
        itens: [],
        editedIndex: -1,
        editedItem: {
          id: 0,
          nome: '',
          preco: 0,
          quantidade: '',
          foto: ''
        },
        defaultItem: {
          id: 0,
          nome: '',
          preco: 0,
          quantidade: '',
          foto: ''
        },
      }
    },

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Novo Cadastro' : 'Atualização'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize();
    },
    mounted () {
      this.$store.getters.inSession(this.$router);
    },

    methods: {
      only_number () {
        // eventos para o keydown
        // let KC = $event.keyCode;
        // this.editedItem.quantidade += $event.key.replace(/\D/gi, '');
        this.editedItem.quantidade = this.editedItem.quantidade.replace(/\D/gi, '');
      },

      initialize () {

        let jwt = JSON.parse(sessionStorage.getItem('caderninho_vendas')).jwt;

        fetch('http://localhost/caderninho_vendas/api/src/rest/produto.php?idusuario=' + this.$store.state.session.id, {
          method:'GET',
          headers: {
              'Authorization': 'baerer ' + jwt
          }
        })
        .then(r => r.json())
        .then(json => {
          if (json.success) {
            this.error = '';
            this.itens = json.data;
          }else{
            this.error = json.msg;
            if (!json.authorized)  {
              this.$store.getters.logout(this.$router);
            }
          }
        });
      },
      editItem (item) {
        console.log(item);

        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      }
    }
  }
</script>