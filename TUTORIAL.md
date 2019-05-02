# LaraVueFy
Vuetify...ing Laravel

# Summary

1. [Summary](#summary)
2. [Requirements](#requirements)
3. [Laravel Installation](#laravel-installation)
4. [Add Vuet to Laravel](#add-vuet-to-Laravel)
5. [Using Vue](#using-vue)
	1. [Javascript setting](#javascript-setting)
	2. [Create our application's main component](#create-our-applications-main-component)
	3. [Include our Vue application into the markup](#include-our-vue-application-into-the-markup)
	4. [Run NPM and see the results](#run-npm-and-see-the-results)
6. [Multi components app](#multi-components-app)
	1. [Structuring our application in parts](#structuring-our-application-in-parts)
7. [Add Vuetify](#add-vuetify)
	1. [AppHeader](#appheader)
	2. [AppFooter](#appfooter)
	3. [App](#App)
	4. [Markup review](#markup-review)
	5. [Other components](#other-components)
8. [Notes](#notes)
	1. [Routing](#routing)	


# Requirements
Before to start this tutorial you need Docker already installed anc configured. For this we already created "laravuefy" site configuration in our [Laradock](https://laradock.io/ "Laradock") installation. In alternative you can just run 

	php artisan serve

and visit http://127.0.0.1:8000 or configure your local server.	


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

Create our components into `resoureces/js/components` folder naming them `Home.vue` and `Contact.vue`. They will look very similar to our initial `App.vue` like the following:

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

## Structuring our application in parts

Our components share the application strucure and if we want to have some functionalities into the structure parts and/or keep the application's files small and mainenable we need to refactor our application's file in order to separate it in several parts. For example in our application we can have an header containing the menu and our logo, a footer with the copyright and our social links and so on.

For semplicity reasons we'll have just an header and a footer. Create a new folder called "layout" under `resources/js/components` folder. Into this one create a `AppHeader.vue` file

	<template>
	    <div>
	        <ul>
	            <li><router-link to="/">Home</router-link></li>
	            <li><router-link to="/contact">Contact</router-link></li>
	        </ul>
	    </div>
	</template>
	
	<script>
		export default {
			name: "AppHeader"
		}
	</script>

and an `AppFooter.vue` one

	<template>
	  <div>
	    &copy; 2019 - YOUniversal
	  </div>
	</template>
	
	<script>
		export default {
			name: "AppFooter",
		}
	</script>

and then import, register and use them into `App.vue` 

	<template>
	  <div>
	  														// Use AppHeader
	      <app-header></app-header>
	      <router-view></router-view>						// Use AppFooter
	      <app-footer></app-footer>
	  </div>
	</template>
	
	<script>
	  import AppHeader from './components/layout/AppHeader'	// Import AppHeader
	  import AppFooter from './components/layout/AppFooter'	//  Import AppFooter
	
	  export default {
			name: 'App',
	    components: {AppHeader, AppFooter}					// Register the components
		}
	</script>

In this way we have still the same result but with differents and smallest files.


# Add Vuetify

Now our first **Vue** application is made and running but isn't so stilysh. It's possible to make the app pretty adding custom stylesheet rules but the easy way is to add **Vuetify** and to use its components to do it. Let's start installing it via NPM.

	npm i vuetify --save

Once installed we need to import Vuetify's assets in `resources/scss/app.scss` 

	@import '~vuetify/dist/vuetify.min.css';

and declare it into  `resources/js/app.js`

		import Vuetify from 'vuetify' // Vuetify import
		Vue.use(Vuetify)              // Vuetify component registration

Now we can refactor our application structure components using Vuetify components.

## AppHeader

Let's add a ToolBar component to the header.

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


## AppFooter

Let's add a Footer component to the footer.

	<template>
	  <v-footer dark height="auto" fixed>
	    <v-card class="flex" flat tile>
	      <v-card-title class="teal">
	        <strong class="subheading">Get connected with us on social networks!</strong>
	        <v-spacer></v-spacer>
	        <v-btn v-for="icon in icons" :key="icon" class="mx-3" dark icon>
	          <v-icon size="24px">{{ icon }}</v-icon>
	        </v-btn>
	      </v-card-title>
	
	      <v-card-actions class="grey darken-3 justify-center">
	        &copy;2018 - <strong>YOUniversal</strong>
	      </v-card-actions>
	    </v-card>
	  </v-footer>
	</template>
	
	<script>
		export default {
			name: "AppFooter",
			data: () => ({
				icons: [
					'fab fa-facebook',
					'fab fa-linkedin',
				]
			})
		}
	</script>

## App

We can also review a litle the App component

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

## Other components

Taking inspiration from the official **Vuetify** documentation it's very easy to add Vuetify's components to our ones. As an example we can add a slider on the homepage and a contact form to our contact page. You can checkout the [repository](https://github.com/andrea-lorusso-yn/LaraVueFy) to have a look at the implementation.


# Notes

## Routing

If you try now to access directly to `/contact` url you'll see the 404 error page of Laravel. This because Laravel doesn't know nothing about VueRouter routing. You can solve this adding a route like this one to Laravel:

	Route::get('/{any}', function() {
		return view('welcome');
	})->where('any', '.*');
