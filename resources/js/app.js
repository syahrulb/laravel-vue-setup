
require('./bootstrap');
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
window.Vue = require('vue');
import router from './router'
import App from './components/template/App'
console.log(process.env.APP_NAME);

Vue.use(VueSweetalert2);
const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
