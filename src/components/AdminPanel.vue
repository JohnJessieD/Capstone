<template>
  <v-app>
    <!-- Vuetify Navbar -->
    <v-navigation-drawer app v-model="drawer" class="drawer-custom">
      <v-list dense>
        <v-list-item-group>
          <!-- Use v-list-item-group for better structure -->
          <v-list-item v-for="(item, index) in drawerItems" :key="index">
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="nav-link">
                <!-- Use router-link directly in v-list-item-title -->
                <router-link :to="item.route.name" class="router-link">
                  {{ item.title }}
                </router-link>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app class="app-bar-custom" dark style="background-color: #96B6C5; border-bottom: 1px solid #374259;">
      <!-- Other content of the app bar -->
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class="home-title">
        <!-- Use router-link directly in v-toolbar-title -->
        <router-link to="/HomeView" class="router-link" style="text-decoration: none; font-family: 'Times New Roman', Times, serif; color: white;">
          Malay Dynas<span style="color: green; text-shadow: 1px 1px 1px black; font-family: 'Times New Roman', Times, serif;">Tea</span>🧋🍃
        </router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <!-- Add the logout button -->
      <v-btn @click="logout" text class="white-text">
        Logout
      </v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        Ang sabi ni Mama mag-aral ako ng mabuti
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      drawerItems: [
        { icon: 'mdi-account-circle', title: 'Users', route: { name: 'UsersList' } },
        { icon: 'mdi-format-list-bulleted', title: 'OrderList', route: { name: 'OrderList' } },
        { icon: 'mdi-shopping', title: 'ProductList', route: { name: 'ProductList' } },
        { icon: 'mdi-store', title: 'BranchList', route: { name: 'BranchList' } },
      ],
    };
  },
  methods: {
    // Add a method for logout
    logout() {
      // Perform logout logic here
      console.log('Logout clicked');
      this.$router.push('/');
      // You can redirect to the login page or perform other logout actions
    },
  },
};
</script>

<style scoped>
.router-link {
  text-decoration: none;
  font-family: 'Times New Roman', Times, serif;
}

.white-text {
  color: white;
}

.green-text {
  color: green;
  text-shadow: 1px 1px 1px black;
}
</style>
