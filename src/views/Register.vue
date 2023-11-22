<!-- YourView.vue -->
<template>
  <div>
    <Register /> <!-- Using the Login component -->
    <!-- Your view content goes here -->
  </div>
</template>

<script>
import Register from '@/components/Register.vue';

export default {
  components: {
    Register,
     // Registering the Login component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
