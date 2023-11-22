<!-- YourView.vue -->
<template>
  <div>
    <UserProfile /> <!-- Using the Login component -->
    <!-- Your view content goes here -->
  </div>
</template>

<script>
import UserProfile from '@/components/UserProfile.vue';

export default {
  components: {
    UserProfile,
     // Registering the Login component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
