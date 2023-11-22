<!-- YourView.vue -->
<template>
    <div>
      <OrderList /> <!-- Using the Login component -->
      <!-- Your view content goes here -->
    </div>
  </template>
  
  <script>
  import OrderList from '@/components/OrderList.vue';
  
  export default {
    components: {
      OrderList,
       // OrderListing the Login component
    },
    // Your view component logic goes here
  }
  </script>
  
  <style scoped>
  /* Component-specific styles go here */
  </style>
  