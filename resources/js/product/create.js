//Create.js
require('../bootstrap');
window.Vue = require('vue');
Vue.component('create-product', require('../components/CreateProduct.vue').default);
const app = new Vue({
    el: '#app',
});
