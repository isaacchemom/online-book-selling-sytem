import './bootstrap';
import $ from 'jquery';

import VueGoodTablePlugin from 'vue-good-table-next';

// import the styles
import 'vue-good-table-next/dist/vue-good-table-next.css'

import moment from "moment";
//import Vue3Toastify, { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

import Toaster from '@meforma/vue-toaster'
import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';
import emitter from './eventLoader.js';

import category from './components/items/categories.vue';
import items from './components/items/add.vue';
import transaction from './components/items/transaction.vue';
import payment from './components/items/payments.vue';
import dashboard from './components/items/dashboard.vue'


import { createApp } from 'vue/dist/vue.esm-bundler.js';

import { createRouter, createWebHistory } from 'vue-router';


import LoaderComponent from './components/LoaderComponent.vue'

import navbar from './components/items/navbar.vue'



const routes = [

 { path: '/admin/categories', component: category },
 {path:'/admin/items' , component:items},
 {path:'/admin/transaction' , component:transaction},
 {path:'/admin/payment' , component:payment},
 {path:'/admin/' , component:dashboard},
 {path:'/getItems/:category' , component:navbar},


];


const app = createApp({});


app.config.globalProperties.$emitter = emitter;

window.jQuery = window.$ = $
//window.Dropzone = Dropzone

const router = createRouter({
  history: createWebHistory(),
  routes,
});

//app.component('buy-book', BuyBook)
app.component('loader-component', LoaderComponent)
app.component('nav-component', navbar)




app.use(VueGoodTablePlugin);
app.use(router);
app.use(moment);
app.mount('#app');
app.use(Toaster)
