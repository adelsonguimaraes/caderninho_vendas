import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Produtos from '@/views/Produto.vue'
import Login from '@/views/Login.vue'
import Base from '@/views/Base.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '*',
    name: 'Login',
    component: Login
  },
  {
    path: '/app',
    name: 'App',
    component: Base,
    children: [
      {
        path: 'home',
        name: 'app.home',
        component: Home
      },
      {
        path: 'about',
        name: 'app.about',
        component: Home
      },
      {
        path: 'produtos',
        name: 'app.produtos',
        component: Produtos
      }
    ]
  }
]

const router = new VueRouter({
  routes
})

export default router
