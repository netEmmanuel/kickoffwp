
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

Vue.component('toast', require('./components/Toast.vue'));
Vue.component('welcomeEmailSignup', require('./components/WelcomeEmailSignup.vue'));
Vue.component('fields', require('./components/Fields.vue'));
Vue.component('createFieldForm', require('./components/CreateFieldForm.vue'));
Vue.component('fieldList', require('./components/FieldList.vue'));
Vue.component('fieldListItem', require('./components/FieldListItem.vue'));
Vue.component('themeList', require('./components/ThemeList.vue'));
Vue.component('themeCard', require('./components/ThemeCard.vue'));
Vue.component('sectionList', require('./components/SectionList.vue'));
Vue.component('sectionCard', require('./components/SectionCard.vue'));

const app = new Vue({
    el: '#app'
});
