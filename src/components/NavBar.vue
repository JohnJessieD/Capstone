<template>
  <v-app>
      <v-navigation-drawer app v-model="drawer" class="drawer-custom">
  <v-list dense>
    <v-list-item-group>
      <v-list-item v-for="(item, index) in drawerItems" :key="index">
        <v-list-item-icon>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title class="nav-link">
            <router-link :to="item.route">{{ item.title }}</router-link>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</v-navigation-drawer>


<v-app-bar app color="black" class="app-bar-custom" dark>
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    <v-toolbar-title class="home-title">
      <router-link to="/HomeView" style="text-decoration: none; color: inherit;">
        <span class="logo">Malay Dynastea</span>
      </router-link>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-text-field
      v-model="searchQuery"
      label="Search for your favorite tea"
      prepend-icon="mdi-magnify"
      @input="searchProducts"
    ></v-text-field>

    <v-btn v-if="isAuthenticated" class="nav-btn" @click="handleLogout">
      Logout
    </v-btn>

    <v-btn class="nav-btn" @click="$router.push({ name: 'BestProducts' })">Best Sellers</v-btn>
    <v-btn class="nav-btn" @click="$router.push({ name: 'shopping-cart' })">Shopping Cart</v-btn>
    <v-btn class="nav-btn" @click="$router.push({ name: 'OrderHistory' })">Order History</v-btn>
  </v-app-bar>
</v-app>
</template>


  <script>

export default {

data() {
  
  return {
    isAuthenticated: false,
    drawer: false,
    drawerItems: [
      { icon: 'mdi-account', title: 'User Profile', route: { name: 'user-profile' } },
      { icon: 'mdi-information', title: 'About', route: { name: 'about' } },
      { icon: 'mdi-logout', title: 'Logout', route: { name: 'MainPage' } },
    ],
  }}}
  </script>

  
<style scoped>
/* Custom styles for your milk tea e-commerce website */

.drawer-custom {
background-color: #f5f5f5; /* Light background color */
}

.app-bar-custom {
background-color: #4caf50; /* Green primary color */
font-size: 14px;
}

.home-title {
font-size: 24px;
font-weight: bold;
color: #ffffff; /* White text color */
}

.logo {
font-family: 'Pacifico', cursive; /* Use a cursive font for the logo */
font-size: 28px;
color: #ffffff;
}

.nav-btn {
color: #ffffff;
margin-left: 10px;
}

/* Add more styles as needed for specific elements */
</style> add more style and make the font style for title 15px 