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
  background-image: url('https://scontent.fmnl30-2.fna.fbcdn.net/v/t39.30808-6/245382281_233644962130684_5227005316872638252_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFVy1qk9GdPAM2JDaX659I3oOlZRQC8stmg6VlFALyy2XjboV2KCFQtLTafyI73Vb79XSXI7wxqnOUPLkOTpCbi&_nc_ohc=zILGnZxZs1kAX_rprCU&_nc_ht=scontent.fmnl30-2.fna&oh=00_AfDHdtI1yrnk8O9475APGBy2QgFO_cOZyFuqJ00X_AXhhw&oe=65621276'); /* Replace with your actual image URL */
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
  background-image: url('https://cdn.shopify.com/s/files/1/0410/1601/files/Untitled_design_-_2021-03-01T124523.044.jpg?v=1614595536');
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
