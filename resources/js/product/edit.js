//edit.js
require('../bootstrap');
window.Vue = require('vue');
Vue.component('edit-product', require('../components/EditProduct.vue').default);
const app = new Vue({
    el: '#app',
});



