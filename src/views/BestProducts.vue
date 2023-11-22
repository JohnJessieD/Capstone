<!-- YourView.vue -->
<template>
    <BestProducts /> <!-- Using the BestProducts component -->
</template>

<script>
import BestProducts from '@/components/BestProducts.vue'; // Adjust the path accordingly

export default {
  components: {
    BestProducts, // Registering the BestProducts component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
