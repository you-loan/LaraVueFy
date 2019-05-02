<template>
    <v-toolbar>
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title>LaraVueFy</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn flat><router-link to="/">Home</router-link></v-btn>
            <v-btn flat><router-link to="/contact">Contact</router-link></v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
	export default {
		name: "AppHeader"
	}
</script>
