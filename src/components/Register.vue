  <template>
    <div class="container">
      <div class="login-container">
        <v-sheet width="300" class="mx-auto">
          <v-form @submit.prevent="register">
            <div v-if="message === 'error'">Invalid response</div>
            <v-text-field v-model="username" label="Username" required></v-text-field>
            <v-text-field v-model="password" label="Password" type="password" required></v-text-field>
            <v-text-field v-model="passwordConfirm" label="Password Confirm" type="password" required></v-text-field>
            <div v-if="message === 'passwordMismatch'">Passwords do not match</div>
            <div v-if="message === 'registrationFailed'">Registration failed. Please try again.</div>
            <v-btn type="submit" block class="mt-2" color="blue">Submit</v-btn>
          </v-form>
        </v-sheet>
      </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      username: '',
      password: '',
      passwordConfirm: '',
      message: '',
    };
  },
  methods: {
    async register() {
      if (this.password === this.passwordConfirm) {
        try {
          const response = await axios.post("api/register", {
            username: this.username,
            password: this.password
          });

          if (response.data.msg === 'okay') {
            alert("Registered successfully");
            this.$router.push('/login');
          } else {
            this.message = 'registrationFailed';
          }
        } catch (error) {
          console.error("Error during registration:", error);
          this.message = 'error';
        }
      } else {
        this.message = "passwordMismatch";
      }
    }
  }
};
</script><style scoped>
.container {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;  
  background: url('');
  background-size: 100%;
  background-color: #96B6C5;
}

.login-container {
  max-width: 400px; /* Adjust the maximum width as needed */
  width: 100%;
  padding: 20px;
  background-color: #fff; /* Set the background color as needed */
  border-radius: 8px; /* Add border radius for rounded corners */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
}

.v-text-field {
  margin: 10px 0; /* Adjust margin as needed */
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
