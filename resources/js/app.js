require('./bootstrap')              // Requiring libraries

import Vue        from 'vue'        // Vue import
import VueRouter  from 'vue-router' // VueRouter import
import router     from './routes'   // Router and routes import
import Vuetify    from 'vuetify'    // Vuetify import
import App        from './App.vue'  // App import

Vue.use(VueRouter)  // Register VueRouter
Vue.use(Vuetify)    // Vuetify component registration

const app = new Vue({
  el: '#app',
  components: { App }, // Register App component
  router               // Tell Vue that router exists
})