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
</script>
<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 600px;
  padding: 600px; /* Adjust padding as needed */
  background-image: url('https://scontent.fmnl30-3.fna.fbcdn.net/v/t39.30808-6/357452804_649096310600190_6371272320415800534_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=dd5e9f&_nc_eui2=AeG3OKITm-0IQHr9Td2VBL03bJXf7pBe-aFsld_ukF75oX1SXpZ8v-A2-PvPuBQNrRUxWjs6sJdSbQ_HQmcbahp5&_nc_ohc=at6gd7eo2hgAX8DvjtA&_nc_ht=scontent.fmnl30-3.fna&oh=00_AfALgn2QqLZryVI8wiVMGtvKe8XRBaimjDFWO8MQ0DG8LA&oe=657B4CA5'); /* Replace with your actual image URL */
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center bottom; /* Adjusted to lower the background */
  color: #51afdb;
  min-height: 20vh; /* Adjusted to 20vh for demonstration */
  width: 100%;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 600px;
  padding: 20px; /* Adjust padding as needed */
  background-image: url('https://scontent.fmnl30-3.fna.fbcdn.net/v/t39.30808-6/357452804_649096310600190_6371272320415800534_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=dd5e9f&_nc_eui2=AeG3OKITm-0IQHr9Td2VBL03bJXf7pBe-aFsld_ukF75oX1SXpZ8v-A2-PvPuBQNrRUxWjs6sJdSbQ_HQmcbahp5&_nc_ohc=at6gd7eo2hgAX8DvjtA&_nc_ht=scontent.fmnl30-3.fna&oh=00_AfALgn2QqLZryVI8wiVMGtvKe8XRBaimjDFWO8MQ0DG8LA&oe=657B4CA5'); /* Replace with your actual image URL */
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center top; /* Adjusted to bring the background upwards */
  color: #51afdb;
  min-height: 20vh; /* Adjusted to 20vh for demonstration */
  width: 100%;
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
