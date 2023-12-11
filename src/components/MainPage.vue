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
            <h1  style="color: white; text-shadow: 1px 1px 1px black;  font-family: 'Times New Roman', Times, serif;">Welcome to</h1>
            <h2 style="color: white; text-shadow: 1px 1px 1px black; font-family: 'Times New Roman', Times, serif; font-size: 36px;">
  Malay Dynas<span style="color: green; text-shadow: 1px 1px 1px black; font-family: 'Times New Roman', Times, serif; ">Tea</span>🧋🍃
</h2>

          </v-card-title>

          <!-- Vue Router view for rendering different components based on the route -->
          <router-view v-if="showForm"></router-view>

          <!-- Card text section containing the main content -->
          <v-card-text>

            <!-- Main content area with a paragraph welcoming the user -->
            <v-main class="content">
              

              <!-- Add more content about featured products, promotions, or any other important information -->
              <p style="font-size: 18px; text-shadow: 1px 1px 1px whitesmoke; color: black; font-family: 'Times New Roman', Times, serif;">
  Discover a world of exquisite teas and accessories to elevate your tea experience.
  </p>



              <!-- Additional sections or features can be added here -->

              <!-- Social media links or any external links for updates and offers -->
              <p style="font-size: 18px; text-shadow: 1px 1px 1px whitesmoke; color: black; font-family: 'Times New Roman', Times, serif;">
    Check out our 👉🏻<a href="https://www.facebook.com/malaydynastea">Facebook</a>👈🏻 page for more updates and special offers.</p>
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
  background: linear-gradient(rgba(190, 173, 250, 0.7), rgba(190, 173, 250, 0.7)), #96B6C5;
  border-radius: 10px;
  text-align: center;
  align-self: center;
  background-image: url('https://images.unsplash.com/photo-1464618663641-bbdd760ae84a?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); /* Replace with your actual image URL */
  background-size: 100%;
  background-repeat: no-repeat;
  background-position: center;
  color: #f5ebe6;
  min-height: 20vh; /* Adjusted to 20vh for demonstration */
  width: 100%;
  margin-top: 45vh; /* Adjust the top margin as needed */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

}



h1 {
  color: #fff;
}
.v-container
{
  margin: 0;
  padding: 0;
  background-image: url('https://scontent.fmnl30-2.fna.fbcdn.net/v/t39.30808-6/292847367_552151036557059_2547609809036160958_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd5e9f&_nc_eui2=AeGsksjpA05NluuDr372_8Kn8Dyg_tBUdZHwPKD-0FR1kXbJ7twjDTkZWSLX3A-zgkccPV7QXtqS_MhLjKeA4qRG&_nc_ohc=BA4tIR_R_AsAX9vUoiW&_nc_ht=scontent.fmnl30-2.fna&oh=00_AfB1iGFo8xP459B3MAZMw0XW8SkKE4Y2OgC1ZBYn4WMLgA&oe=657B868B');
  background-size: 100%;
  background-repeat: no-repeat;
  background-position: center;
  height: 110vh;
  display: flex;
  align-items: center;
  justify-content: center;
} 
.v-btn {
  margin: 13px;
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
