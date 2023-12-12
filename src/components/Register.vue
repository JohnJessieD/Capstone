  <template>
    <div class="container">
      <div class="login-container" fluid fill-height>
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
  background-size: 100%;
  background-color: #96B6C5;
  background-image: url('https://scontent.fmnl30-1.fna.fbcdn.net/v/t39.30808-6/292517389_552150166557146_8383312527456431699_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=dd5e9f&_nc_eui2=AeG51JXyG0TahPIPcmg1mUtr-gz16cq_C_P6DPXpyr8L8wOmyT9tUMKK1Dkt8l7XT8uSNBsfBB3ZOduNKu498CtB&_nc_ohc=NGE9skChFZQAX8ERpZ3&_nc_ht=scontent.fmnl30-1.fna&oh=00_AfCHjiJudrfmRpEklD26OtAqrGtcr8e3mYbKPoKr4wTKdA&oe=657DB3B9');
  background-position: center top;
}

.custom-border {
  border: 1px solid #000; /* Add your desired border style here */
}


.login-container {
  max-width: 400px; /* Adjust the maximum width as needed */
  width: 100%;
  padding: 20px;
  background-color: white;
  border-radius: 10px; /* Add border radius for rounded corners */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
  border: 1px solid #000; /* Add a 1px solid border with black color */
  height: 100%;
  background-image: url('https://media.istockphoto.com/id/1358932856/photo/white-rhombus-background-with-copy-space.jpg?s=1024x1024&w=is&k=20&c=YbbUIIyi_TBoLDqqHn5BMgabfOszu21l5a-mEqa8GvM=');
  /* Add the following properties to move the card to the right side */
  position: absolute;
  top: 50%;
  right: 0;
  transform: translate(-12%, -50%);
}


.v-text-field {
  margin: 20px 0; /* Adjust margin as needed */
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
  color: #1d89fd;
  text-decoration: none;
}

.router-link:hover {
  text-decoration: underline;
}
</style>


