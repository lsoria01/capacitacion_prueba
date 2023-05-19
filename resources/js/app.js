require('./bootstrap');

window.Vue = require('vue');

Vue.component('adscripcion', require('./components/Adscripcion.vue').default);
Vue.component('bitacora', require('./components/Bitacora.vue').default);
Vue.component('calificacion', require('./components/Calificacion.vue').default);
Vue.component('curso', require('./components/Curso.vue').default);
Vue.component('capturar', require('./components/Capturar.vue').default);
Vue.component('nombramiento', require('./components/Nombramiento.vue').default);
Vue.component('puesto', require('./components/Puesto.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('informe', require('./components/Informe.vue').default);
Vue.component('consulta', require('./components/Consulta.vue').default);
Vue.component('usuario', require('./components/Usuario.vue').default);
Vue.component('kardex', require('./components/Kardex.vue').default);
Vue.component('institucion', require('./components/Institucion.vue').default);
Vue.component('nivel', require('./components/Nivel.vue').default);
Vue.component('estado', require('./components/Estado.vue').default);
Vue.component('grado', require('./components/GradoEstudio.vue').default);
Vue.component('mi-cuenta', require('./components/MiCuenta.vue').default);
Vue.component('bienvenida', require('./components/Bienvenida.vue').default);

import VueQr from 'vue-qr'
Vue.component('vue-qr', VueQr);

//Autocomplete
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
// Global registration
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)

//importar html2pdf

import VueHtml2pdf from 'vue-html2pdf'
Vue.component('vue-html2pdf', VueHtml2pdf);

//importar Spinner

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

//Spinner
Vue.use(Loading,{
    color: "#285C4D",
    canCancel: false,
    loader: 'spinner',
    height: 100,
    width:100,
    opacity:.8,
    zIndex: 999
  });

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



