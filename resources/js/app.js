/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 require("./bootstrap");

 import Vue from "vue";
 import "bootstrap/dist/css/bootstrap.css";
 import "vuejs-noty/dist/vuejs-noty.css";
 import "vue-select/dist/vue-select.css";
 import vSelect from "vue-select";
 // APEXCHART
 import VueApexCharts from "vue-apexcharts";
 Vue.use(VueApexCharts);
 Vue.component("apexchart", VueApexCharts);
 // NOTIFY
 import VueNoty from "vuejs-noty";
 Vue.use(VueNoty);
 // LOADING
 import Loading from "vue-loading-overlay";
 import "vue-loading-overlay/dist/vue-loading.css";
 Vue.use(Loading);
 // ROUTER
 import router from "./router/index";
 Vue.use(router);
 
 import VueRouter from "vue-router";
 Vue.component("v-select", vSelect);
 Vue.component("header-component", require("./components/Header.vue").default);
 Vue.component("footer-component", require("./components/Footer.vue").default);
 
 Vue.component("app-component", require("./pages/App.vue").default);
 Vue.component("sidebar-component", require("./components/Sidebar.vue").default);
 
 // EVENT BUS, GREATLY IMPORTANT, DON'T TOUCH IT!
 export const EventBus = new Vue();
 
 const app = new Vue({
     el: "#app",
     data: {
         title: "kita harus bisa ",
         logo: "https://cdn.optinmonster.com/wp-content/uploads/2021/07/404-page-examples-fb-image.png",
     },
     router,
 });
 
 router.beforeEach((to, from, next) => {
     let token = localStorage.getItem("JWToken") != null;
     if (to.name === "Login" && token) {
         next({
             name: "LandingPage",
         });
     } else if (to.matched.some((record) => record.meta.requiresAuth)) {
         if (!token) {
             next({
                 path: "/",
                 query: { redirect: to.fullPath },
             });
         } else {
             next();
         }
     } else {
         next();
     }
 });
 