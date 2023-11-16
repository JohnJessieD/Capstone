<template>
    <div class="registration-page">
      <div class="registration-container">
        <h1 class="registration-heading">Create an Account</h1>
        <form @submit.prevent="register" class="registration-form">
          <div class="form-group">
            <label for="username" class="label">Username:</label>
            <input type="text" id="username" v-model="username" class="input" required>
          </div>
          <div class="form-group">
            <label for="email" class="label">Email:</label>
            <input type="email" id="email" v-model="email" class="input" required>
          </div>
          <div class="form-group">
            <label for="password" class="label">Password:</label>
            <input type="password" id="password" v-model="password" class="input" required>
          </div>
          <button type="submit" class="registration-button">Register</button>
          <div v-if="registrationSuccess" class="registration-success-message">
          <p>Registration successful! Do you want to login?</p>
         
          <router-link to="/login">Go to Login</router-link>
        </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
 export default {
  data() {
    return {
      username: '',
      email: '',
      password: '',
      registrationSuccess: false, // Track registration success
    };
  },
  methods: {
    register() {
      // Simulate registration success
      // In a real-world scenario, you would send a request to the server
      // and handle success and error responses accordingly
      // For now, we'll just simulate a successful registration after 2 seconds
      setTimeout(() => {
        this.registrationSuccess = true;
      }, 2000);
    },
    goToLogin() {
      // You can implement the logic to navigate to the login page here
      // For example, using Vue Router: this.$router.push('/login');
      alert('Redirecting to login page...');
      const router = useRouter();
      router.push('/Login');
    },
  },
};
</script>
  
  <style scoped>
  .registration-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f2f2f2;
  }
  
  .registration-container {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
  }
  
  .registration-heading {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
    color: #333;
  }
  
  .registration-form {
    text-align: center;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .label {
    display: block;
    font-size: 16px;
    margin-bottom: 5px;
    color: #555;
  }
  
  .input {
    width: 100%;
    padding: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    font-size: 16px;
    color: #333;
  }
  
  .registration-button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
  }
  
  .registration-button:hover {
    background-color: #0056b3;
  }
  </style>
  