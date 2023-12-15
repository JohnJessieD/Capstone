<!-- YourView.vue -->
<template>
    <sows /> <!-- Using the sows component -->
</template>

<script>
import sows from '@/components/sows.vue'; // Adjust the path accordingly

export default {
  components: {
    sows, // Registering the sows component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
