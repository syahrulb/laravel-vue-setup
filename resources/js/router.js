import Vue from 'vue'
import VueRouter from 'vue-router'
import WelcomePage from './components/pages/welcome'
import DashboardPage from './components/dashboard/dashboard'
import SignupPage from './components/auth/signup'
import SigninPage from './components/auth/signin'
import NotFound from './components/errors/404'
Vue.use(VueRouter)
const routes = [
    {
        path: '/home',
        component: WelcomePage
    },
    {
        path: '/signup',
        component: SignupPage
    }, 
    {
        path: '/signin',
        component: SigninPage
    }, 
    {
        path: '/dashboard',
        component: DashboardPage
    },
]
export default new VueRouter({
    base: 'server-spa-belajar/admin',
    mode: 'history',
    routes
})