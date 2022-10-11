require('./bootstrap');

window.Vue = require('vue');

Vue.component('adscripcion', require('./components/Adscripcion.vue').default);
Vue.component('calificacion', require('./components/Calificacion.vue').default);
Vue.component('curso', require('./components/Curso.vue').default);
Vue.component('prueba', require('./components/prueba.vue').default);
Vue.component('nombramiento', require('./components/Nombramiento.vue').default);
Vue.component('puesto', require('./components/Puesto.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('informe', require('./components/Informe.vue').default);
Vue.component('consulta', require('./components/Consulta.vue').default);
Vue.component('usuario', require('./components/Usuario.vue').default);
Vue.component('home', require('./components/Home.vue').default);

import VueQr from 'vue-qr'
Vue.component('vue-qr', VueQr);

import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
// Global registration
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)

const app = new Vue({
    el: '#app',
});

//importar Toaster

//antes ejecutar "npm i --save v-toaster"
import Toaster from 'v-toaster'
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})


