<!-- YourView.vue -->
<template>
    <NavBar /> <!-- Using the NavBar component -->
</template>

<script>
import NavBar from '@/components/NavBar.vue'; // Adjust the path accordingly

export default {
  components: {
    NavBar, // Registering the NavBar component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
