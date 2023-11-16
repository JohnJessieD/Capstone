// router.js
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import(/* webpackChunkName: "home" */ '../views/HomeView.vue')
  },
  {
    path: '/about',
    name: 'about',
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../views/Login.vue')
  },
  {
    path: '/Navbar',
    name: 'Navbar',
    component: () => import(/* webpackChunkName: "Navbar" */ '../views/Navbar.vue')
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
    component: () => import(/* webpackChunkName: "UserProfile" */ '../views/UserProfile')
  },
  {
    path: '/OrderHistory', // Add the route for order history
    name: 'OrderHistory',
    component:() => import(/* webpackChunkName: " OrderHistory" */ '../views/OrderHistory')
  },
  {
    path: '/BestProducts',
    name: 'BestProducts',
    component:() => import(/* webpackChunkName: " BestProducts" */ '../views/BestProducts')
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
