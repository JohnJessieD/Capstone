<!-- YourView.vue -->
<template>
  <div>
    <login /> <!-- Using the Login component -->
    <!-- Your view content goes here -->
  </div>
</template>

<script>
import login from '@/components/login.vue';

export default {
  components: {
    login, // Registering the Login component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
