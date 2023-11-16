<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="6">
        <h2>User Profile</h2>
        <v-card>
          <v-card-title>
            Personal Information
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-text-field
                label="Name"
                v-model="user.name"
                :readonly="!isEditing"
              ></v-text-field>
              <v-text-field
                label="Email"
                v-model="user.email"
                disabled
              ></v-text-field>
              <v-text-field
                label="Phone Number"
                v-model="user.phone"
                :readonly="!isEditing"
              ></v-text-field>
              <v-text-field
                label="Address"
                v-model="user.address"
                :readonly="!isEditing"
              ></v-text-field>
              <!-- Add more profile fields as needed -->

              <!-- Additional fields for English site -->
              <v-text-field
                label="Birthdate"
                v-model="user.birthdate"
                :readonly="!isEditing"
              ></v-text-field>
              <v-text-field
                label="Gender"
                v-model="user.gender"
                :readonly="!isEditing"
              ></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="isEditing ? saveChanges() : editProfile">
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
</template>

<script>
export default {
  data() {
    return {
      user: {
        name: 'John Doe',
        email: 'johndoe@example.com',
        phone: '010-1234-5678',
        address: 'Seoul, Gangnam-gu',
        birthdate: '1990-01-01',
        gender: 'Male',
      },
      originalUser: {}, // Store the original user data for comparison
      isEditing: false, // Track whether the user is in edit mode
    };
  },
  methods: {
    editProfile() {
      // Enter edit mode and store a copy of the original user data
      this.isEditing = true;
      this.originalUser = { ...this.user };
    },
    cancelEdit() {
      // Cancel the edit and revert to the original data
      this.isEditing = false;
      this.user = { ...this.originalUser };
    },
    saveChanges() {
      // Simulate an API call to save changes
      // In a real application, you would make an actual API request here
      // For now, we'll just log the changes to the console
      console.log('Changes saved:', this.user);

      // Exit edit mode
      this.isEditing = false;
    },
  },
};
</script>
