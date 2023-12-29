// router.js
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: '/homeview',
    name: 'home',
    component: () => import(/* webpackChunkName: "home" */ '../views/HomeView.vue')
  },
  {
    path: '/NavBar',
    name: 'NavBar',
    component: () => import(/* webpackChunkName: "NavBar" */ '../views/NavBar.vue')
  },
  {
    path: '/ProductCard',
    name: 'ProductCard',
    component: () => import(/* webpackChunkName: "ProductCard" */ '../views/ProductCard.vue')
  }, {
    path: '/OrderDetails',
    name: 'OrderDetails',
    component: () => import(/* webpackChunkName: "OrderDetails" */ '../views/OrderDetails.vue')
  },


  {
    path: '/Cashier',
    name: 'Cashier',
    component: () => import(/* webpackChunkName: "Cashier" */ '../views/Cashier/Cashier.vue')
  },
  
  {
    path: '/sows',
    name: 'sows',
    component: () => import(/* webpackChunkName: "sows" */ '../views/sows.vue')
  },
  {
    path: '/Riderpanel',
    name: 'Riderpanel',
    component: () => import(/* webpackChunkName: "Riderpanel" */ '../views/RiderPanel/Riderpanel.vue')
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
    path: '/Login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "login" */ '../views/Login.vue')
  },
  {
    path: '/register',
    name: 'register',
    component: () => import(/* webpackChunkName: "register" */ '../views/Register.vue')
  },{
    path: '/ProductView_old',
    name: 'ProductView_old',
    component: () => import(/* webpackChunkName: "ProductView_old" */ '../views/ProductView_old.vue')
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
     path: '/history/:upc', name: 'history',  
    component: () => import(/* webpackChunkName: "HistoryPage" */ '../views/HistoryPage.vue') // Added '.vue'
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
  { path: '/OrderList', component: () => import(/* webpackChunkName: "OrderList" */ '../views/OrderList.vue') },
  { path: '/BranchList', component: () => import(/* webpackChunkName: "BranchList" */ '../views/BranchList.vue') },
  { path: '/AdminPanel', component: () => import(/* webpackChunkName: "AdminPanel" */ '../views/AdminPanel.vue') },
  { path: '/UsersList', component: () => import(/* webpackChunkName: "UsersList" */ '../views/UsersList.vue')},
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});
export default router;
