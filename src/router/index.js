// router.js
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: '/homeview',
    name: 'home',
    component: () => import(/* webpackChunkName: "home" */ '../views/HomeView.vue')
  },
  {
    path: '/',
    name: 'MainPage',
    component: () => import(/* webpackChunkName: "mainpage" */ '../views/MainPage.vue'), // Added '.vue'
  },
  {
    path: '/about',
    name: 'about',
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../views/login.vue')
  },
  {
    path: '/register',
    name: 'register',
    component: () => import(/* webpackChunkName: "register" */ '../views/Register.vue')
  },
  {
    path: '/Shopping-cart',
    name: 'shopping-cart',
    component: () => import(/* webpackChunkName: "ShoppingCart" */ '../views/Shoppingcart.vue')
  },
  {
    path: '/UserProfile',
    name: 'user-profile',
    component: () => import(/* webpackChunkName: "UserProfile" */ '../views/UserProfile.vue') // Added '.vue'
  },
  {
    path: '/OrderHistory',
    name: 'OrderHistory',
    component: () => import(/* webpackChunkName: "OrderHistory" */ '../views/OrderHistory.vue') // Added '.vue'
  },
  {
    path: '/BestProductList',
    name: 'BestProducts',
    component: () => import(/* webpackChunkName: "BestProducts" */ '../views/BestProducts.vue') // Added '.vue'
  },
  { path: '/ProductList', component: () => import(/* webpackChunkName: "ProductList" */ '../views/ProductList.vue') },
  { path: '/OrderList', component: () => import(/* webpackChunkName: "OrderList" */ '../views/OrderList.vue') },
  { path: '/BranchList', component: () => import(/* webpackChunkName: "BranchList" */ '../views/BranchList.vue') },
  { path: '/AdminPanel', component: () => import(/* webpackChunkName: "AdminPanel" */ '../views/AdminPanel.vue') },
  { path: '/UsersList', component: () => import(/* webpackChunkName: "UsersList" */ '../views/UsersList.vue') },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;
