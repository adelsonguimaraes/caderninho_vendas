import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    session: null, 
  },
  getters: {
    login: state => (session, router) => {
      state.session = session;
      sessionStorage.setItem('caderninho_vendas', JSON.stringify(session));
      router.push({name: 'app.home'});
    },
    logout: state => (router) => {
      state.session = null;
      sessionStorage.removeItem('caderninho_vendas');
      router.push({name: 'Login'});
    },
    getSession: state => {
      state.session = JSON.parse(sessionStorage.getItem('caderninho_vendas'));
      return state.session;
    },
    inSession: state => (router) => {
      if (state.session===null && router.currentRoute.name.indexOf('Login')===-1) router.push({name: 'Login'});
      if (state.session!==null && router.currentRoute.name.indexOf('Login')!==-1) router.push({name: 'app.home'});
    }
  },
  mutations: {
  },
  actions: {
  },
  modules: {
  }
})
