<template>
    <v-app>
      <!-- Vuetify Navbar -->
      <v-navigation-drawer app v-model="drawer" class="drawer-custom">
        <v-list dense>
          <v-list-item-group>
            <v-list-item v-for="(item, index) in drawerItems" :key="index">
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="nav-link">
                  <router-link :to="item.route.name" style="text-decoration: none; color: inherit;">
                    {{ item.title }}
                  </router-link>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-navigation-drawer>
        <v-app-bar app color="#F1C27B" class="app-bar-custom" dark>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title class="home-title">
          <router-link to="/HomeView" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
  <img src="/img/Logo2.png" alt="" style="width: 55px; height:50px; margin-right: 5px;">
  <span class="malay">Malay Dynas</span><span class="tea">Tea</span>
</router-link>



          
        </v-toolbar-title>
        <v-spacer></v-spacer>
  
        <!-- Add the logout button -->
        <v-btn @click="logout" text class="lo">
          Logout
        </v-btn>
      </v-app-bar>
  
      <v-main>
        <v-container>
          :)
          <br>
          :)
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
          { icon: 'mdi-shopping', title: 'ProductList', route: { name: 'ProductView_old' } },
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
  /* Add your custom styles here if needed */
  .drawer-custom {
    /* Add styles for the drawer */
  }
  
  .app-bar-custom {
    /* Add styles for the app bar */
  }
  
  .home-title {
    /* Add styles for the toolbar title if needed */
  }
.malay{
font-family: 'Times New Roman', Times, serif;
font-weight: bolder;
font-size: 25px;
color: white;
text-shadow: 1px 1px 1px black;
}
.tea{
  font-family: 'Times New Roman', Times, serif;
  font-weight: bolder;
  font-size: 28px;
  color: green;
  text-shadow: 1px 1px 1px black;
}

.lo{
  font-family: 'Times New Roman', Times, serif;
  font-weight: bolder;
  font-size: 15px;
  color: black;
}

.lo:hover{
  background-color: #e7af7d;
}

</style>
  