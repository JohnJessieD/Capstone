<!-- YourView.vue -->
<template>
    <NavBar>
      <ProductCard /> <!-- Using the NavBar component -->
    </NavBar> /> <!-- Using the NavBar component -->
</template>

<script>
import NavBar from '@/components/NavBar.vue'; // Adjust the path accordingly
import ProductCard from './ProductCard.vue';
export default {
  components: {
    NavBar,
    ProductCard, // Registering the NavBar component
  },
  // Your view component logic goes here
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
