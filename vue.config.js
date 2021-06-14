module.exports = {
  publicPath: process.env.NODE_ENV === 'production'
  ? '/caderninho_vendas/dist/'
  : '/',
  
  transpileDependencies: [
    'vuetify'
  ],

  devServer: {
    proxy: {
      '^/api': {
        target: 'http://localhost/vue_login/api',
        ws: true,
        changeOrigin: true
      }
    }
  }
}
