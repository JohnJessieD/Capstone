<!-- ShoppingCart.vue -->
<template>
  <div class="shopping-cart-container">
    <head>
      <title>Shopping Cart</title>
    </head>
    <h2>Shopping Cart</h2>
    <p v-if="loggedInUser" class="user-info">Logged in as: {{ loggedInUser.username }}</p>
    <ul class="product-list">
      <li v-for="product in orderedProducts" :key="product.id" class="product-item">
        <strong>Customer:</strong> {{ product.customer_name }}<br>
        <strong>Product:</strong> {{ product.product_name }}<br>
        <strong>Quantity:</strong> {{ product.quantity }}<br>
        <strong>Total Amount:</strong> {{ product.total_amount }}<br>
        <strong>Status:</strong> {{ product.status }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      orderedProducts: [],
      loggedInUser: null,
    };
  },
  mounted() {
    this.fetchOrderedProducts();
    this.fetchLoggedInUser();
  },
  methods: {
    async fetchOrderedProducts() {
      try {
        const response = await axios.get('/api/orderProducts');
        const data = response.data;
        this.orderedProducts = data;
      } catch (error) {
        console.error('Error fetching ordered products:', error);
      }
    },
    async fetchLoggedInUser() {
      try {
        const response = await axios.get('/api/loggedInUser');
        this.loggedInUser = response.data;
      } catch (error) {
        console.error('Error fetching logged-in user:', error);
      }
    },
  },
};
</script>

<style scoped>
.shopping-cart-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
  font-size: 24px;
  margin-bottom: 16px;
}

.user-info {
  font-weight: bold;
  margin-bottom: 12px;
}

.product-list {
  list-style-type: none;
  padding: 0;
}

.product-item {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 8px;
  margin-bottom: 8px;
  background-color: #f9f9f9;
}

/* Add more styles as needed */
</style>
