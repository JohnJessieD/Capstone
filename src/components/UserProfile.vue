<template>
  <div style="background-color: #e0d9d9;">
    <v-container>
      <v-row>
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title>User Information</v-card-title>
            <v-card-text>
              <v-form ref="userForm">
                <v-text-field
                  label="Username"
                  v-model="user.username"
                  :readonly="!isEditing"
                ></v-text-field>
                <v-text-field
                  label="Password"
                  v-model="user.password"
                  type="password"
                  :readonly="!isEditing"
                ></v-text-field>
                <v-text-field
                  label="Status"
                  v-model="user.status"
                  :readonly="!isEditing"
                ></v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="isEditing ? saveChanges() : editProfile()">
                {{ isEditing ? 'Save' : 'Edit' }}
              </v-btn>
              <v-btn v-if="isEditing" @click="cancelEdit" color="error">
                Cancel
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: {
        username: '',
        password: '',
        token: '',
        status: '',
        role: '',
      },
      originalUser: {}, // Store the original user data for comparison
      isEditing: false, // Track whether the user is in edit mode
    };
  },
  methods: {
    async getUserProfile() {
      try {
        const response = await axios.get('/api/user/profile'); // Adjust the URL if needed
        this.user = { ...response.data };
        this.originalUser = { ...response.data };
      } catch (error) {
        console.error('Error fetching user profile:', error);
      }
    },
    async updateUserProfile() {
      try {
        await axios.post('/api/profile', this.user); // Adjust the URL if needed
        console.log('User profile updated successfully');
      } catch (error) {
        console.error('Error updating user profile:', error);
      }
    },
    editProfile() {
      // Enter edit mode and fetch user profile
      this.isEditing = true;
      this.getUserProfile();
    },
    cancelEdit() {
      // Cancel the edit and revert to the original data
      this.isEditing = false;
      this.user = { ...this.originalUser };
    },
    saveChanges() {
      // Save changes to the user profile
      this.updateUserProfile();
      // Exit edit mode
      this.isEditing = false;
    },
  },
  created() {
    // Fetch user profile on component creation
    this.getUserProfile();
  },
};
</script>
