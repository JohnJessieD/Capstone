<!-- YourView.vue -->
<template>
  <div>
    <Shoppingcart /> <!-- Using the Login component -->
 
  </div>
</template>

<script>
import Shoppingcart from '@/components/Shoppingcart.vue';

export default {
  components: {
    Shoppingcart,
     // Registering the Login component
  },
}
</script>

<style scoped>
/* Component-specific styles go here */
</style>
