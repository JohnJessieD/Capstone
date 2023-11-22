<!-- YourView.vue -->
<template>
    <div>
      <UsersList /> <!-- Using the UsersLists component -->
      <!-- Your view content goes here -->
    </div>
  </template>
  
  <script>
  import UsersList from '@/components/UsersList.vue';
  
  export default {
    components: {
      UsersList, // Registering the UsersLists component
    },
    // Your view component logic goes here
  }
  </script>
  
  <style scoped>
  /* Component-specific styles go here */
  </style>
  