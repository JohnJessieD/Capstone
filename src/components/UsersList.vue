<!-- UsersList.vue -->
<template>
    <div>
      <h2>User List</h2>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  // Import Axios if you haven't already
  // import axios from 'axios';
  
  export default {
    data() {
      return {
        users: [] // Users data fetched from the backend
      };
    },
    mounted() {
      // Fetch users from the backend API and update the users data
      // Example: Use Axios or Fetch API
  
      // If using Axios:
      // axios.get('/api/users')
      //   .then(response => this.users = response.data)
      //   .catch(error => console.error('Error fetching users:', error));
  
      // If using Fetch API:
      // fetch('/api/users')
      //   .then(response => response.json())
      //   .then(data => this.users = data)
      //   .catch(error => console.error('Error fetching users:', error));
  
      // Note: Replace '/api/users' with the actual endpoint of your backend API.
      // Ensure that the API returns a JSON array with user data.
    }
  };
  </script>
  