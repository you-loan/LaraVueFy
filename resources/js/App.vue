<template>
  <v-app>
    <app-header />
    <v-content>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-content>
    <app-footer />
  </v-app>
</template>

<script>
  import AppHeader from './components/layout/AppHeader'
  import AppFooter from './components/layout/AppFooter'

  export default {
    name: 'App',
    components: { AppHeader, AppFooter }
  }
</script>
