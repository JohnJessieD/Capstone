<template>
  <div class="admin-panel">
    <h1>User Management</h1>

    <div class="user-list">
      <table class="user-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.role }}</td>
            <td>
              <button @click="editUser(user)"><i class="fas fa-edit"></i> Edit</button>
              <button @click="deleteUser(user)"><i class="fas fa-trash-alt"></i> Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-if="editMode" class="user-form-modal">
      <div class="user-form">
        <h2>Edit User</h2>
        <form @submit.prevent="updateUser">
          <div class="form-group">
            <label for="id">ID:</label>
            <input type="number" id="id" v-model="editedUserId" readonly>
          </div>
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" v-model="editedUserName">
          </div>
          <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" id="role" v-model="editedUserRole">
          </div>
          <button type="submit"><i class="fas fa-check"></i> Update User</button>
          <button type="button" @click="cancelEdit"><i class="fas fa-times"></i> Cancel</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      editMode: false,
      editedUserId: null,
      editedUserName: '',
      editedUserRole: '',
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    cancelEdit() {
      console.log('Editing canceled!');
      this.editMode = false;
    },
    editUser(user) {
      this.editMode = true;
      this.editedUserId = user.id;
      this.editedUserName = user.username;
      this.editedUserRole = user.role;
    },
    updateUser() {
      const data = {
        username: this.editedUserName,
        role: this.editedUserRole,
      };

      axios.put(`/api/update_user/${this.editedUserId}`, data)
        .then((response) => {
          this.getUsers();
          this.editMode = false;
          this.editedUserId = null;
          this.editedUserName = '';
          this.editedUserRole = '';
        })
        .catch((error) => {
          console.error('Error updating user:', error);
        });
    },
    getUsers() {
      axios.get('/api/users')
        .then((response) => {
          this.users = response.data;
        });
    },
    deleteUser(user) {
      axios.delete(`/api/delete/${user.id}`)
        .then((response) => {
          this.getUsers();
        })
        .catch((error) => {
          console.error('Error deleting user:', error);
        });
    },
  },
};
</script>

<style scoped>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .admin-panel {
    max-width: 800px;
    margin: 0 auto;
  }

  h1, h2 {
    font-weight: bold;
  }

  .user-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  .user-table th,
  .user-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
  }

  .user-table th {
    background-color: #f5f5f5;
  }

  .user-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .user-form-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8); /* Increased opacity for better contrast */
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .user-form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  }

  .user-form button {
    margin-right: 10px;
  }

  .user-form button:last-child {
    margin-right: 0; /* Remove the right margin for the last button */
  }

  .form-group {
    margin-bottom: 20px; /* Increase the margin between form groups */
  }

  label {
    display: block;
    margin-bottom: 5px; /* Reduce the margin between labels */
  }

  input {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin-top: 5px; /* Add some space between label and input */
  }

  button i {
    margin-right: 5px;
  }

  /* Consistent button styling */
  button {
    padding: 10px 15px;
    background-color: #3498db;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 4px; /* Add border-radius for consistency */
  }

  button:hover {
    background-color: #2980b9;
  }

  /* Responsive design */
  @media (max-width: 600px) {
    .user-table th,
    .user-table td {
      padding: 8px; /* Reduce padding for smaller screens */
    }

    .user-form {
      padding: 15px; /* Adjust padding for smaller screens */
    }
  }
</style>
