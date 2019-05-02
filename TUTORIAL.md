# LaraVueFy
Vuetify...ing Laravel

# Summary

1. [Summary](#summary)
2. [Requirements](#requirements)
3. [Laravel Installation](#laravel-installation)
4. [Add Vuet to Laravel](#add-vuet-to-Laravel)
5. [Using Vue](#using-vue)
	1. [Javascript setting](#javascript-setting)
	2. [Create our application's main component](#cerate-our-applications-main-component)
	3. [Include our Vue application into the markup] (#include-our-vue-application-into-the-markup)
	4. [Run NPM and see the results](#run-npm-and-see-the-results)
6. [Multi components app](#multi-components-app)


5. [Using a router](#using-a-router)


# Requirements
Before to start this tutorial you need Docker already installed anc configured. For this we already created "laravuefy" site configuration in our [Laradock](https://laradock.io/ "Laradock") installation.


# Laravel installation
Create a new laravel installation via

	composer create-project --prefer-dist laravel/laravel laravuetify
	
If you prefer you can also install it via Laravel installer (refer to the [official documentation](https://laravel.com/docs/5.8#installing-laravel) for this).


# Add Vue to Laravel
Go into your installation folder
	
	cd laravuetify
	
and open with your preferred editor the `package.json` file. You'll notice that both **jQuery** and **Bootstrap** packages are required. This because Laravel (5.8 is the current version in this moment) comes with Bootstrap and jQuery frameworks already integrated. Since we want to use **Vue** let's go to remove them! We can do it just running the command

	php artisan preset none

Proceed in installing just **Vue** that is obviously a requirement for vuetify

	php artisan preset vue
	
Once done we need to install all the **node modules** required

	npm install


# Using Vue

Now that all we need is installed and ready we can start using **Vue**. 

## Javascript setting

Open `app.js` file located into `resources/js` folder and import external libraries, import Vue and our application's main component and register it.

	require('./bootstrap');       // Require libraries
	
	import Vue from 'vue'         // Vue import
	import App from './App.vue'   // App import
	
	const app = new Vue({
	  el: '#app',
	  components: { App }         // Register App component
	})

## Create our application's main component

Create `App.vue` file under `resources/js/component` folder adn put into it a simple template with a very easy functionality: say "Welcome to my first Vue application in Laravel".

	<template>
	  <div>
	    {{ message }}
	  </div>
	</template>
	
	<script>
	  export default {
			name: 'App',
	    data: () => ({
	      message: 'Welcome to my first Vue application in Laravel'
	    })
		}
	</script>

## Include our Vue application into the markup

The last step is to inform our front-end code that our application exists. So open `welcome.blade.php` located under `resources/views` folder and change it in this way:

	<!doctype html>
	<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	    <head>
	        <meta charset="utf-8">
	        <meta name="viewport" content="width=device-width, initial-scale=1">
	
	        <title>Laravuetify</title>
	
	        <!-- CSRF token -->
	        <meta name="csrf-token" content="{{ csrf_token() }}">
	        <!-- Application javascripts -->
	        <script src="{{ asset('js/app.js') }}" defer></script>
	        <!-- Application stylesheet -->
	        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	        <!-- Fonts -->
	        <link href='https://fonts.googleapis.com/css?family=Nunito:100,300,400,500,700,900' rel="stylesheet">
	
	    </head>
	    <body>
	        <div id="app">      <!-- this is the reference for Vue -->
	            <App></App>     <!-- this is our application's tag -->
	        </div>
	    </body>
	</html>

## Run NPM and see the results

If we do all in the right way we can go on the console and run `npm run watch`. In this way NPM will compile our source code and will generate the static assets. In addition to this it will start observing source files and will restart the compiling if someone of them will change. If the command will be executed as expected you will see something like this:

```
 DONE  Compiled successfully in 290ms                                                                                                  6:21:30 PM
                                                                                                                    Asset     Size   Chunks             Chunk Names
/css/app.css  0 bytes  /js/app  [emitted]  /js/app
  /js/app.js  922 KiB  /js/app  [emitted]  /js/app

```

Now go to the browser and observe the result: you must see a simple white page showing just the message "Welcome to my first Vue application in Laravel".


# Multi components app

Ok, it's all good but this application do nothing and have a single page with a single message. In a real world application probably we need to do more than this. Let say for example we want to have an homepage and a contact page. In this case we can use **[VueRouter](https://router.vuejs.org/)** and two components to handle the two pages we need.

Create our compoments into `resoureces/js/components` folder naming them `Home.vue` and `Contact.vue`. They will look very similar to our initial `App.vue` like the following:

**Home.vue**:

	<template>
	  <div>
	    {{message}}
	  </div>
	</template>
	
	<script>
		export default {
			name: "Home",
			data: () => ({
				message: 'Home component'
			})
		}
	</script>

**Contact.vue**:

	<template>
	  <div>
	    {{message}}
	  </div>
	</template>
	
	<script>
		export default {
			name: "Contact",
			data: () => ({
				message: 'Contact component'
			})
		}
	</script>


Install **VueRouter**

	npm install vue-router --save
	
Add a `routes.js` file into `resources/js` folder and into it import VueRouter and define our routes. A route is a set of information that map a URL's path to a Vue component. To create the mapping you must also import into `routes.js` file also the components you need.

	import VueRouter from 'vue-router'
	import Home from './components/Home'
	import Contact from './components/Contact'
	
	const routes =[
		{
			path: "/",
			name: "home",
			component: Home
		},
		{
			path: "/contact",
			name: "contact",
			component: Contact
		}
	]
	
	const router = new VueRouter({
		routes,
		mode: "history"
	})
	
	export default router

Change `app.js` file adding the routes' file and telling Vue to use the router:

	require('./bootstrap')              
	
	import Vue from 'vue'               
	import VueRouter from 'vue-router'  // VueRouter import
	import router from './routes'       // Router and routes import
	import App from './App.vue'         
	
	Vue.use(VueRouter)                  // Register VueRouter
	
	const app = new Vue({
	  el: '#app',
	  components: { App },              	
	  router                            // Tell Vue that router exists
	})

Chnage the main application's component (`App.vue`) to include the router

	<template>
	  <div>
	      <router-view></router-view>
	  </div>
	</template>
	
	<script>
	  export default {
			name: 'App',
		}
	</script>

If you reload the page (if compilation completed with success) you will see now a blank page with the string "Home component". Let's add some links to reach both the components:

	<template>
	  <div>
	      <ul>
	        <li><router-link to="/">Home</router-link></li>
	        <li><router-link to="/contact">Contact</router-link></li>
	      </ul>
	      <router-view></router-view>
	  </div>
	</template>
	[...]

If now you reload the page you can see the links at the top of the page and, clicking on them, the message under them will change accordingly with the component's link you clicked.

# Add Vuetify

Now that our first **Vue** application is made and running we want to add **Vuetify** to it. Let's start installing it via NPM.

	npm i vuetify --save

Once installed we need to import Vuetify's assets in `resources/scss/app.scss` 

	@import '~vuetify/dist/vuetify.min.css';

and declare it into javascript section of our application `resources/js/components/App.vue`

	<script>
		import Vue from 'vue'         // Vue import
		import Vuetify from 'vuetify' // Vuetify import
		Vue.use(Vuetify)              // Vuetify component registration
	
	  	export default {
			name: 'App',
	    	data: () => ({
		    	message: 'Welcome to my first Vue application in Laravel'
	    	})
		}
	</script>




