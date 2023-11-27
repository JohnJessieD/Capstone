<!-- UserListComponent.vue -->
<template>
  <div>
    <h1>User List</h1>
    <ul>
      <li v-for="user in userList" :key="user.id">{{ user.name }}</li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      userList: [],
    };
  },
  mounted() {
    // Fetch user list data on component mount
    this.fetchUserList();
  },
  methods: {
    fetchUserList() {
      // Use Axios to fetch data from the API
      axios.get('/api/userlist') // Assuming your API endpoint is '/api/userlist'
        .then(response => {
          this.userList = response.data.userlist;
        })
        .catch(error => {
          console.error('Error fetching user list:', error);
        });
    },
  },
};
</script>

<style scoped>
/* Add your component styles here */
</style>
