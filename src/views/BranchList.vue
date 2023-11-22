<template>
    <BranchList />
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import BranchList from '../components/BranchList.vue';
  
  export default defineComponent({
    name: 'HomeView',
  
    components: {
      BranchList,
  
    },
  });
  </script>
  