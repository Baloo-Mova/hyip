
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat_wrap', require('./components/wrap/Wrap.vue'));
Vue.component('chat_header', require('./components/header/Header.vue'));
Vue.component('chat_body', require('./components/body/Body.vue'));
Vue.component('chat_footer', require('./components/footer/Footer.vue'));
Vue.component('chat_dialog', require('./components/dialog/Dialog.vue'));
Vue.component('chat_messages', require('./components/messages/Messages.vue'));

const app = new Vue({
    el: '#chat'
});
