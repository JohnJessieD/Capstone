<template>
  <v-app>
    <!-- Navigation Drawer -->
    <v-navigation-drawer app v-model="drawer">
      <v-list dense>
        <v-list-item-group>
          <v-list-item v-for="(item, index) in drawerItems" :key="index">
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title class="nav-link">
              <router-link :to="item.route">{{ item.title }}</router-link>
            </v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="primary">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <router-link to="/">
        <v-toolbar-title class="home-title">Malay Dynastea</v-toolbar-title>
      </router-link>
      <v-btn @click="$router.push('/BestProducts')">BestProducts</v-btn>
      <v-btn @click="$router.push('/shopping-cart')">Shopping Cart</v-btn>
      <v-btn @click="$router.push('/OrderHistory')">Order History</v-btn>
    </v-app-bar>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      drawerItems: [
        { icon: 'mdi-account', title: 'User Profile', route: '/UserProfile' },
        { icon: 'mdi-information', title: 'About', route: '/about' },
        { icon: 'mdi-login', title: 'Login', route: '/login' },
        { icon: 'mdi-account-plus', title: 'Register', route: '/register' },
      ],
    };
  },
};
</script>

<style scoped>
/* Add a custom style for the navigation link color */


/* Add a custom style for the home title color */
.home-title {
  color: #ffffff; /* Change the color to your preferred value */
}
</style>
