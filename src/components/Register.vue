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
            <v-btn type="submit" block class="mt-2">Submit</v-btn>
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
</script>
<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 600px;
  padding: 20px; /* Adjust padding as needed */
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
