<!-- YourView.vue -->
<template>
  <div>
    <ProductCard /> <!-- Using the Login component -->
    <!-- Your view content goes here -->
  </div>
</template>

<script>
import ProductCard from '@/components/ProductCard.vue';

export default {
  components: {
    ProductCard,
     // ProductCarding the Login component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
