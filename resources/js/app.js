require('./bootstrap');

window.Vue = require('vue');

Vue.component('adscripcion', require('./components/Adscripcion.vue').default);
Vue.component('prueba', require('./components/prueba.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('informe', require('./components/Informe.vue').default);
Vue.component('consulta', require('./components/Consulta.vue').default);
Vue.component('home', require('./components/Home.vue').default);

import VueQr from 'vue-qr'
Vue.component('vue-qr', VueQr);

const app = new Vue({
    el: '#app',
});


