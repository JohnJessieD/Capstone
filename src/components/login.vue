<template>
  <div class="container">
    <div class="login-container">
      <h2>Login</h2>
      <form @submit.prevent="login" class="login-form">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" v-model="username" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" v-model="password" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
      </form>

      <!-- Link to the registration page -->
      <router-link to="/Register">Don't have an account? Register here.</router-link>
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
      // Here you can add your authentication logic
      // For simplicity, let's just log the credentials for now
      console.log('Username:', this.username);
      console.log('Password:', this.password);

      // After successful login, you can redirect to another route
      // For example, redirect to a dashboard
      this.$router.push('/HomeView');
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
  width: 300px;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  height: relative;
  background-image: url('https://cdn.shopify.com/s/files/1/0410/1601/files/Untitled_design_-_2021-03-01T124523.044.jpg?v=1614595536');
  background-size: cover;
  background-repeat: no-repeat;
}

.login-form .form-group {
  margin-bottom: 15px;
}

.login-form label {
  display: block;
  margin-bottom: 5px;
}

.login-form input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.login-form button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.login-form button:hover {
  background-color: #0056b3;
}

/* Style for the registration link */
.router-link {
  display: block;
  margin-top: 10px;
  text-align: center;
  color: #007bff;
  text-decoration: none;
}
</style>