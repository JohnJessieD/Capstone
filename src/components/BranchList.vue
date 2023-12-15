<template>
  <div>
    <h1>Branches</h1>

    <button @click="fetchBranches" :disabled="loading">Fetch Branches</button>

    <div v-if="branches.length">
      <h2>Branch List</h2>
      <ul>
        <li v-for="branch in branches" :key="branch.id">
          {{ branch.name }} - {{ branch.address }} - {{ branch.phone }}
        </li>
      </ul>
    </div>

    <h2>Create Branch</h2>

    <form @submit.prevent="createBranch">
      <label for="name">Name:</label>
      <input v-model="newBranch.name" type="text" id="name" required />

      <label for="address">Address:</label>
      <input v-model="newBranch.address" type="text" id="address" required />

      <label for="phone">Phone:</label>
      <input v-model="newBranch.phone" type="text" id="phone" required />

      <button type="submit" :disabled="creating">Create Branch</button>
    </form>

    <p v-if="error" style="color: red;">{{ error }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      branches: [],
      newBranch: {
        name: '',
        address: '',
        phone: '',
      },
      loading: false,
      creating: false,
      error: '',
    };
  },
  methods: {
    async fetchBranches() {
      try {
        this.loading = true;
        const response = await axios.get('/api/branch');
        this.branches = response.data;
      } catch (error) {
        this.error = this.getErrorMessage(error);
      } finally {
        this.loading = false;
      }
    },
    async createBranch() {
      try {
        this.creating = true;
        await axios.post('/api/create', this.newBranch);
        console.log('Branch created successfully');
        this.fetchBranches(); // Refresh the branch list after creating a new branch
        this.resetForm();
      } catch (error) {
        this.error = this.getErrorMessage(error);
      } finally {
        this.creating = false;
      }
    },
    resetForm() {
      this.newBranch = {
        name: '',
        address: '',
        phone: '',
      };
    },
    getErrorMessage(error) {
      // Extract error message from the error object
      return error.response ? error.response.data : error.message;
    },
  },
};
</script>
