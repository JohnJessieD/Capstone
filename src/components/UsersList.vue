<!-- UserList.vue -->
<template>
  <div>
    <h2>User List</h2>
    <ul>
      <li v-for="user in users" :key="user.id">{{ user.username }}</li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await this.$axios.get('/api/users');
        this.users = response.data;
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
  },
};
</script>
