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

    <v-app-bar app color="#F1C27B" class="app-bar-custom" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class="home-title">
        <router-link to="/HomeView" style="text-decoration: none; color: inherit;">
          <span class="logo">Malay  Dynas<span class="tea">Tea</span></span>

        </router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-text-field
      v-model="searchQuery"
      label="Search"
      append-icon="mdi-magnify"
      @click:append="search"
  style="margin-left: -210px; margin-right: 30px;"
  ></v-text-field>

      <v-btn v-if="isAuthenticated" class="nav-btn" @click="handleLogout">
        Logout
      </v-btn>

      <v-btn class="nav-btnBP" @click="$router.push({ name: 'BestProducts' })" style="font-family: 'Times New Roman'; font-weight: bolder;">Best Sellers</v-btn>
      <v-btn class="nav-btnSC" @click="$router.push({ name: 'shopping-cart' })" style="font-family: 'Times New Roman'; font-weight: bolder;"> <v-icon>mdi-cart</v-icon>Shopping Cart</v-btn>
      <v-btn class="nav-btnOH" @click="$router.push({ name: 'OrderHistory' })" style="font-family: 'Times New Roman'; font-weight: bolder;">Order History</v-btn>
    </v-app-bar>

    <v-main style="background-color: #eee7e7;">
    <div class="product-card-container">
      <ProductCard :products="products" />
    </div>
  </v-main>
</v-app>
</template>


<script>
import axios from 'axios';
import ProductCard from '@/components/ProductCard.vue';

export default {
  components: {
    ProductCard,
  },
  data() {
    return {
      isAuthenticated: false,
      drawer: false,
      drawerItems: [
        { icon: 'mdi-account', title: 'User Profile', route: { name: 'user-profile' } },
        { icon: 'mdi-information', title: 'About', route: { name: 'about' } },
        { icon: 'mdi-logout', title: 'Logout', route: { name: 'MainPage' } },
      ],
      searchQuery: '',
      products: [],
    };
  },
  methods: {
    search() {
      // Make an Axios request to your API endpoint for product search
      axios.get(`/api/search?query=${this.searchQuery}`)
        .then(response => {
          // Handle successful response
          this.products = response.data; // Assuming the API returns an array of products
        })
        .catch(error => {
          // Handle error
          console.error('Error fetching search results:', error);
        });
    },
    handleLogout() {
      // Implement your logout functionality here
    },
  },
};
</script>

<style scoped>
/* Custom styles for your milk tea e-commerce website */

.drawer-custom {
  background-color: #ffffff; /* Light background color */
}

.app-bar-custom {
  border-bottom: 1px solid #232424; /* Adjust the color and size as needed */
}

.app-bar-custom {
  background-color: #4caf50; /* Green primary color */
  font-size: 14px;
}

.home-title {
  font-size: 15px; /* Adjusted font size */
  font-weight: bold;
  color: #ffffff; /* White text color */
}

.logo {
  font-family: 'Times New Roman', serif; /* Use Times New Roman font for the logo */
  font-size: 28px;
  color: #ffffff;
  text-shadow: 1px 1px 1px black;
}

.tea {
  color: #4caf50;/* Your styles for the "Tea" part */
  font-size: 35px;
}

.nav-btn {
  color: #ffffff;
  margin-left: 10px;
  text-shadow: 1px 1px 1px black;
}

.drawer-item {
  transition: background-color 0.3s; /* Smooth transition for background color change on hover */
}

.drawer-item:hover {
  background-color: #e0e0e0; /* Lighter background color on hover */
}

.drawer-link {
  text-decoration: none;
  color: #333; /* Text color for drawer links */
}

.drawer-link:hover {
  color: #00f008; /* Text color for drawer links on hover */
}

/* Add more styles as needed for specific elements */

.nav-btnBP:hover {
  background-color: #e7af7d;
}
.nav-btnSC:hover {
  background-color: #e7af7d;
}
.nav-btnOH:hover {
  background-color: #e7af7d;
}
</style>
