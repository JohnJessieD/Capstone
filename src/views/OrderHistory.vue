<!-- YourView.vue -->
<template>
  <div>
    <OrderHistory /> <!-- Using the Navbar component -->
    <!-- Your view content goes here -->
  </div>
</template>

<script>
import OrderHistory from '@/components/OrderHistory.vue';

export default {
  components: {
    OrderHistory, // Registering the Navbar component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
