<!-- YourView.vue -->
<template>
    <AdminPanel /> <!-- Using the AdminPanel component -->
</template>

<script>
import AdminPanel from '@/components/AdminPanel.vue'; // Adjust the path accordingly

export default {
  components: {
    AdminPanel, // Registering the AdminPanel component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
