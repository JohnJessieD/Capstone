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
            <h1>Welcome to the Malay Dynastea🧋🍱</h1>
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
      this.$router.push('/Login');
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
  text-align: center;
  align-self:center; 
  background-image: url('https://image.cnbcfm.com/api/v1/image/101524695-457220551.jpg?v=1395781183&w=740&h=416&ffmt=webp&vtcrop=y'); /* Replace with your actual image URL */
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
  background-image: url('https://1.bp.blogspot.com/-kaN7Pv8hH1I/UAujD3n__AI/AAAAAAAAH_c/EHdMdORbs1c/s1600/DSCN2126a.JPG');
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
