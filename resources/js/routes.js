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