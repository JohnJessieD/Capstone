<template>
  <v-app>
    <v-container class="login-container" fluid fill-height>
      <v-row justify="center" align="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="login-card">
            <v-card-title class="title headline">L o g i n</v-card-title>
            <v-card-text class="form">
              <v-form @submit.prevent="login">
                <v-text-field v-model="username" label="Username" required class="solid-color-text-field"></v-text-field>
                <v-text-field v-model="password" label="Password" type="password" required class="solid-background-text-field"></v-text-field>
                <v-btn type="submit" block class="login-button">Login</v-btn>
              </v-form>
            </v-card-text>
              <v-card-actions>
      <router-link to="/forgot-password" class="forgot-password">Forgot Password?</router-link>
              </v-card-actions>
            <v-card-actions>
              <router-link to="/register" class="register-link">Don't have an account? Register here</router-link>
            </v-card-actions>
            <v-alert v-if="message" type="error" dismissible class="error-message">
              {{ message }}
            </v-alert>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>
<script>
import axios from 'axios';

export default {
  data: () => ({
    username: '',
    password: '',
    message: '',
  }),
  methods: {
    async login() {
      try {
        const response = await axios.post('/api/login', {
          username: this.username,
          password: this.password,
        });

        if ('msg' in response.data) {
          if (response.data.msg === 'okay') {
            // Check the user role and redirect accordingly
            this.$router.push(response.data.role === 'admin' ? '/AdminPanel' : '/NavBar');
          } else {
            this.message = 'Login failed. Please try again.';
          }
        } else {
          this.message = 'Unexpected response structure. Please try again.';
          console.error('Unexpected response structure:', response);
        }
      } catch (error) {
        this.message = 'Error during login. Please try again later.';
        console.error('Error during login:', error);
      }
    },
  },
};
</script>

<style scoped>
.v-app {
      background-size: 100%;
      background-color: #96B6C5;
    }

.login-container {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background-size: 100%;
  background-color: #96B6C5;
  background-image: url('https://scontent.fmnl30-2.fna.fbcdn.net/v/t39.30808-6/245382281_233644962130684_5227005316872638252_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=783fdb&_nc_eui2=AeHBRmd86-co5qr_kqqCyP4BoOlZRQC8stmg6VlFALyy2SKKxDcztgADf9qBwea39DEnvvRMIC_oHbL-EVtXbLrS&_nc_ohc=tl2dNdUvIsEAX-J5zMv&_nc_ht=scontent.fmnl30-2.fna&oh=00_AfAx47Uemul0Mv6SvadILxy8XfEaT7jMHwSP7nx7ETZoow&oe=657DC1F6');
}

.login-card {
  width: 100%;
  max-width: 400px;
  margin: auto;
  background-color: #fff; /* Change to a solid color */
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border: 1px solid #095d85;
  background-image: url('https://media.istockphoto.com/id/1358932856/photo/white-rhombus-background-with-copy-space.jpg?s=1024x1024&w=is&k=20&c=YbbUIIyi_TBoLDqqHn5BMgabfOszu21l5a-mEqa8GvM=');
  background-repeat: no-repeat; 
  /* Add the following properties to move the card to the right side */
  position: absolute;
  top: 50%;
  right: 0;
  transform: translate(-25%, -50%);
}


.title {
  text-align: center;
  color: #000000;
  margin-bottom: 16px;
  font-size: 25px;
  font-weight: 1000;
}

.form {
  padding: 20px;
}

.login-button {
  margin-top: 16px;
  background-color: #1976D2;
  color: white;
  border: none;
  border-radius: 5px;
  transition: box-shadow 0.3s ease; /* Add transition for smoother effect */
}

.login-button:hover {
  box-shadow: 0 0 10px 3px rgb(2, 185, 170); /* Adjust the color and spread as needed */
}

.login-button:hover {
  background-color: #1565C0;
}

.forgot-password {
  text-align: center;
  margin-top: 16px;
  color: #303030;
  text-decoration: none;
  display: inline-block;
}

.forgot-password:hover {
  color: #1565C0;
}

.register-link {
  text-align: center;
  margin-top: 16px;
  color: #303030;
  text-decoration: none;
  display: inline-block;
}

.register-link:hover {
  color: #1565C0;
}

.error-message {
  margin-top: 16px;
}

.solid-color-text-field {
  background-color: #ffffff94; /* Replace 'yourColor' with the desired color code or name */
}

.solid-background-text-field {
  background-color: #ffffff94; /* Set the background color to your desired color */
}
</style>
