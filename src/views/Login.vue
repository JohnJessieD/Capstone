<!-- YourView.vue -->
<template>
  <v-container class="login-container">
    <v-row justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="login-card">
          <v-card-title class="title headline">Login</v-card-title>
          <v-card-text class="form">
            <v-form @submit.prevent="login">
              <v-text-field v-model="username" label="Username" required></v-text-field>
              <v-text-field v-model="password" label="Password" type="password" required></v-text-field>
              <v-btn type="submit" block class="login-button">Login</v-btn>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <router-link to="/forgot-password" class="forgot-password">Forgot Password?</router-link>
          </v-card-actions>
        </v-card>

        <v-alert v-if="message" type="error" dismissible class="error-message">
          {{ message }}
        </v-alert>
      </v-col>
    </v-row>
  </v-container>
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
.login-container {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: url('');
  background-size: 100%;
  background-color: #96B6C5;
}

.login-card {
  width: 100%;
  max-width: 400px;
  margin: auto;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  color: #1976D2;
  margin-bottom: 16px;
}

.form {
  padding: 16px;
}

.login-button {
  margin-top: 16px;
  background-color: #1976D2;
  color: white;
  border: none;
  border-radius: 5px;
}

.login-button:hover {
  background-color: #1565C0;
}

.forgot-password {
  text-align: center;
  margin-top: 16px;
  color: #757575;
  text-decoration: none;
  display: inline-block;
}

.forgot-password:hover {
  color: #333;
}

.error-message {
  margin-top: 16px;
}
</style>

