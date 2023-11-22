<template>
  <!-- The main container that holds the entire front page content -->
  <v-container fluid>

    <!-- Centering the content within a row -->
    <v-row justify="center">

      <!-- Responsive column layout, taking up 12 columns on small screens and 8 columns on medium screens -->
      <v-col cols="12" md="8">

        <!-- A card element to contain the main content with a shadow elevation of 12 -->
        <v-card class="main-container" elevation="12">

          <!-- Card title with a welcoming message -->
          <v-card-title>
            <h1>Welcome to the Malay Dynastea🍵🌿</h1>
          </v-card-title>

          <!-- Vue Router view for rendering different components based on the route -->
          <router-view v-if="showForm"></router-view>

          <!-- Card text section containing the main content -->
          <v-card-text>

            <!-- Main content area with a paragraph welcoming the user -->
            <v-main class="content">
              

              <!-- Add more content about featured products, promotions, or any other important information -->
              <p>Discover a world of exquisite teas and accessories to elevate your tea experience.</p>

              <!-- Additional sections or features can be added here -->

              <!-- Social media links or any external links for updates and offers -->
              <p>
    Check out our <a href="https://www.facebook.com/malaydynastea">Facebook page</a> for more updates and special offers.
    Follow us on <a href="https://www.instagram.com/malaydynastea">Instagram</a> for beautiful tea moments.
    Connect with us on <a href="https://twitter.com/malaydynastea">Twitter</a> for the latest news and events.
  </p>
              <!-- Call-to-action buttons for user interaction -->
              <v-btn @click="showLoginForm" color="success">Login</v-btn>
              <v-btn @click="showRegisterForm" color="primary">Register</v-btn>
            </v-main>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      showForm: false,
    };
  },
  methods: {
    showLoginForm() {
      this.showForm = true;
      this.$router.push('/login');
    },
    showRegisterForm() {
      this.showForm = true;
      this.$router.push('/register');
    },
  },
};
</script>

<style scoped>
.main-container {
  background-color: #888080;
  border-radius: 10px;
  text-align: right;
  align-self: flex-end; 
  background-image: url('https://scontent.fmnl30-2.fna.fbcdn.net/v/t39.30808-6/245382281_233644962130684_5227005316872638252_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFVy1qk9GdPAM2JDaX659I3oOlZRQC8stmg6VlFALyy2XjboV2KCFQtLTafyI73Vb79XSXI7wxqnOUPLkOTpCbi&_nc_ohc=zILGnZxZs1kAX_rprCU&_nc_ht=scontent.fmnl30-2.fna&oh=00_AfDHdtI1yrnk8O9475APGBy2QgFO_cOZyFuqJ00X_AXhhw&oe=65621276'); /* Replace with your actual image URL */
  background-size: cover;
  background-repeat: no-repeat;
  color: #f5ebe6;
  min-height: 158%;
}

h1 {
  color: #fff;
}
.v-container
{
  margin: 0;
  padding: 0;
  background-image: url('https://cdn.shopify.com/s/files/1/0410/1601/files/Untitled_design_-_2021-03-01T124523.044.jpg?v=1614595536');
  background-size: cover;
  background-repeat: no-repeat;
  height: 110vh;
  display: flex;
  align-items: center;
  justify-content: center;
} 
.v-btn {
  margin: 10px;
}
.social-links {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;
}

.social-link {
  margin-right: 20px;
  text-decoration: none;
  color: #fff;
  font-size: 18px;
  transition: color 0.3s ease;
}

.social-link:hover {
  color: #00bcd4; /* Change to the desired hover color */
}


</style>
