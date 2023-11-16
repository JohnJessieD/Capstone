<template>
  
    <div class="login-page">
      <div class="login-container">
        <h1 class="login-heading">Customer Login</h1>
        <form @submit.prevent="login" class="login-form">
          <div class="form-group">
            <label for="username" class="label">Username:</label>
            <input type="text" id="username" v-model="username" class="input" required>
          </div>
          <div class="form-group">
            <label for="password" class="label">Password:</label>
            <input type="password" id="password" v-model="password" class="input" required>
          </div>
          <button type="submit" class="login-button">Login</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        username: '',
        password: '',
      };
    },
    methods: {
      login() {
        // Perform authentication logic here (e.g., sending a request to a server)
        if (this.username === 'your_username' && this.password === 'your_password') {
          // Authentication successful, you can navigate to another page or set a user session here
          alert('Login successful!');
        } else {
          // Authentication failed, display an error message
          alert('Login failed. Please check your credentials.');
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .login-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f2f2f2;
  }
  
  .login-container {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
  }
  
  .login-heading {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
    color: #333;
  }
  
  .login-form {
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
  
  .login-button {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
  }
  
  .login-button:hover {
    background-color: #0056b3;
  }
  </style>
   add function where user can login through facebook gmail  or by submitting number