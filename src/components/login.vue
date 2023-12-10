<template>
    <div class="container">
  <v-sheet width="300" class="mx-auto login-container">
    <v-form fast-fail @submit.prevent="login">
      <v-text-field v-model="username" label="Username" required></v-text-field>

      <v-text-field v-model="password" label="Password" type="password" required></v-text-field>

      <v-btn type="submit" block class="mt-2">Login</v-btn>
    </v-form>
    
    <p v-if="message" class="error-message">{{ message }}</p>

    <div class="forgot-register-links">
      <router-link to="/forgot-password">Forgot Password?</router-link>
      <v-card-text>If you don't have an account, register <router-link to="/register">here</router-link> first.</v-card-text>
    </div>
  </v-sheet>
</div>
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
        const response = await axios.post('api/login', {
          username: this.username,
          password: this.password,
        });

        if ('msg' in response.data) {
          if (response.data.msg === 'okay') {
            this.$router.push('/AdminPanel');
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
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 600px;
  padding-top:10px;
  height: 10px;
  padding:relative;
  background-image: url(''); 
  background-size: cover;
  background-repeat: no-repeat;
  color: #f5ebe6;

}
.login-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-image: url('');
  background-size: cover;
  background-repeat: no-repeat;
  color: #f5ebe6;
}

.error-message {
  color: red;
  margin-top: 10px;
}

.forgot-register-links {
  text-align: center;
  margin-top: 20px;
}

.router-link {
  color: #007bff;
  text-decoration: none;
}

.router-link:hover {
  text-decoration: underline;
}
</style>
