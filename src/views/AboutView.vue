<!-- YourView.vue -->
<template>
  <div>
    
    <AboutView /> <!-- Using the About component -->
  </div>
</template>

<script>
import AboutView from '@/components/AboutView.vue'; // Adjust the path accordingly

export default {
  components: {
    AboutView, // Registering the About component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
