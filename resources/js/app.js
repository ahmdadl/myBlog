require('./bootstrap');
require('vue');
window.Vue = require('../../node_modules/vue/dist/vue');

Vue.config.productionTip = false;

var data = {
    items: ["Bananas", "Apples"],
    title: "My Shopping List"
};


Vue.filter('capt', function (str) {
    if (!str) return '';
    return str.toString().charAt(0).toUpperCase() + str.slice(1);
});


var app = new Vue({
    el: "#app",
    data: data
});