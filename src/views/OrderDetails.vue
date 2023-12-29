<template>
    <div class="order-details-container" style="background-color: #1a1a1a; color: #fff; padding: 20px;">
      <h2 v-if="order">Order Details for Order #{{ order.id }}</h2>
      
      <div v-if="order">
        <p><strong>Customer Name:</strong> {{ order.customer_name }}</p>
        <p><strong>Customer Address:</strong> {{ order.customer_address }}</p>
        <p><strong>Product Name:</strong> {{ order.product_name }}</p>
        <p><strong>Status:</strong> {{ order.status }}</p>
        <p><strong>Product Description:</strong> {{ order.product_description }}</p>
        <p><strong>Product Price:</strong> {{ order.product_price }}</p>
        <p><strong>Quantity:</strong> {{ order.quantity }}</p>
        <p><strong>Total Amount:</strong> {{ order.total_amount }}</p>
      </div>
  
      <div v-else>
        <p>Loading...</p>
      </div>
  
      <div v-if="error">
        <p>Error fetching order details: {{ error }}</p>
      </div>
    </div>
  </template>
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        order: null,
        error: null,
        loading: true, // Add loading state
      };
    },
    mounted() {
      // Fetch order details when the component is mounted
      this.fetchOrderDetails();
    },
    methods: {
      async fetchOrderDetails() {
        const orderId = this.$route.params.id;
  
        try {
          // Set up Axios request with a timeout (e.g., 10 seconds)
          const response = await axios.get(`/api/GetOrderDetails/${orderId}`, { timeout: 10000 });
          this.order = response.data;
        } catch (error) {
          console.error('Error fetching order details', error);
          this.error = error.message || 'Unknown error';
        } finally {
          this.loading = false; // Set loading to false, regardless of success or failure
        }
      },
    },
  };
  </script>
  