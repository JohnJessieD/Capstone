<template>
  <div class="shopping-cart-container">
    <head>
      <title>Shopping Cart</title>
    </head>
    <h2>Shopping Cart</h2>
    <p v-if="loggedInUser" class="user-info">Logged in as: {{ loggedInUser.username }}</p>
    
    <ul class="product-list">
      <li v-for="(product, index) in displayedProducts" :key="product.id" class="product-item">
        <strong>Customer:</strong> {{ product.customer_name }}<br>
        <strong>Product:</strong> {{ product.product_name }}<br>
        <strong>Quantity:</strong> {{ product.quantity }}<br>
        <strong>Total Amount:</strong> {{ product.total_amount }}<br>
        <strong>Status:</strong> {{ product.status }}
        
      </li>
    </ul>
    
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
  <div class="cancel-button">
    <button @click="cancelOrder">Cancel Order</button>
  </div>
</template>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      orderedProducts: [],
      loggedInUser: null,
      itemsPerPage: 5, // Adjust the number of items per page as needed
      currentPage: 1,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.orderedProducts.length / this.itemsPerPage);
    },
    displayedProducts() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.orderedProducts.slice(start, end);
    },
  },
  mounted() {
    this.fetchOrderedProducts();
    this.fetchLoggedInUser();
  },
  methods: {
    cancelOrder() {
      if (confirm('Are you sure you want to cancel your order?')) {
        // Add logic to cancel the order, for example, send a request to the server
        console.log('Order canceled!');
      }
    },
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
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
  },
};
</script>

<style scoped>
/* Existing styles remain unchanged */

.pagination {
  margin-top: 16px;
  display: flex;
  justify-content: space-between;
}

.pagination button {
  padding: 8px;
  cursor: pointer;
}

.pagination button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
