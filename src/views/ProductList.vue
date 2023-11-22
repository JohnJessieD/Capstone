<!-- YourView.vue -->
<template>
    <div>
      <ProductList /> <!-- Using the Login component -->
      <!-- Your view content goes here -->
    </div>
  </template>
  
  <script>
  import ProductList from '@/components/ProductList.vue';
  
  export default {
    components: {
      ProductList,
       // ProductListing the Login component
    },
    // Your view component logic goes here
  }
  </script>
  
  <style scoped>
  /* Component-specific styles go here */
  </style>
  