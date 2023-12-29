<template>
    <div id="app">
      <h1>Sales Report</h1>
      <div v-if="highestSales">
        <p>Highest Sales:</p>
        <p>Product ID: {{ highestSales.product_id }}</p>
        <p>Total Quantity: {{ highestSales.total_quantity }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        highestSales: null,
      };
    },
    mounted() {
      this.fetchHighestSales();
    },
    methods: {
      async fetchHighestSales() {
        try {
          const response = await axios.get('/api/getHighestSales'); // Adjust the endpoint URL
          const orders = response.data;
  
          if (orders.length > 0) {
            // Find the order with the highest total quantity
            this.highestSales = orders.reduce((prev, current) =>
              prev.total_quantity > current.total_quantity ? prev : current
            );
          } else {
            console.error('No data received from the API');
          }
        } catch (error) {
          console.error('Error fetching highest sales:', error);
        }
      },
    },
  };
  </script>
  
  <style>
  #app {
    text-align: center;
    margin-top: 60px;
  }
  </style>
  