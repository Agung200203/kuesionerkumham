/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import { createApp } from "vue";
import App from './pages/app.vue';
// import router from "./router";
import { Icon } from "@iconify/vue";
import VueApexCharts from "vue3-apexcharts";
import ApexCharts from "apexcharts";
// import VueApexCharts from 'vue-apexcharts'
// Vue.use(VueApexCharts)
// Vue.component('apexchart', VueApexCharts)

import Vue from 'vue'
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vuejs-noty/dist/vuejs-noty.css'
import VueNoty from 'vuejs-noty'
Vue.use(VueNoty)
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

import router from './router/index'
import VueRouter from 'vue-router';
Vue.component('header-component', require('./components/Header.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);

Vue.component('app-component', require('./pages/app.vue').default);
Vue.component('sidebar-component', require('./components/Sidebar.vue').default);

const app = new Vue({
    el: '#app',
    data : {
        title: 'kita harus bisa ',
        logo:'https://cdn.optinmonster.com/wp-content/uploads/2021/07/404-page-examples-fb-image.png'
    },
    router
});
