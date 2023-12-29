<template>
  <div class="milk-tea-shopping-cart-container">
    <head>
      <title>Milk Tea Shop - Shopping Cart</title>
    </head>
    <h2 class="page-title">Your Milk Tea Order</h2>
    <p v-if="loggedInUser" class="user-info">Welcome, {{ loggedInUser.username }}!</p>
    
    <ul class="product-list">
      <li v-for="(product, index) in displayedProducts" :key="product.order_id" class="product-item">
        <img :src="product.image" class="product-image">
        <div class="product-details">
          <strong class="product-name">{{ product.product_name }}</strong><br>
          <div class="product-meta">
            <strong>Quantity:</strong> {{ product.quantity }}<br>
            <strong>Total Amount:</strong> ${{ product.total_amount.toFixed(2) }}<br>
            <strong>Status:</strong> {{ product.status }}
            <button @click="cancelOrder(product.order_id)">Cancel Order</button>
          </div>
        </div>
      </li>
    </ul>
    
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      orderedProducts: [],
      loggedInUser: null,
      itemsPerPage: 5,
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
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        await this.fetchOrderedProducts();
        await this.fetchLoggedInUser();
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    async cancelOrder(order_id) {
  if (confirm('Are you sure you want to cancel your order?')) {
    try {
      const reason = prompt('Please provide a reason for cancellation:');
      if (!reason) {
        throw new Error('Cancellation reason is required.');
      }

      // Send cancellation request to the server
      await axios.post('/api/cancelOrder', { order_id, reason });

      // Delete the order on the server
      await this.deleteOrder(order_id);

      // Update the orderedProducts array in the component's data
      this.orderedProducts = this.orderedProducts.filter(product => product.order_id !== order_id);

      console.log('Order canceled!');
    } catch (error) {
      console.error('Error canceling order:', error.message);
      // You can display an error message to the user if needed
    }
  }
},

    async deleteOrder(order_id) {
      try {
        // Send request to delete the order
        await axios.delete(`/api/deleteOrder/${order_id}`);
      } catch (error) {
        console.error('Error deleting order:', error.message);
        // You can display an error message to the user if needed
      }
    },
    async fetchOrderedProducts() {
      try {
        const response = await axios.get('/api/orderProducts');
        const data = response.data;
        
        // Ensure that total_amount is converted to a number
        this.orderedProducts = data.map(product => ({
          ...product,
          total_amount: Number(product.total_amount),
          image: `/images/${product.image}.jpg`,
        }));
      } catch (error) {
        console.error('Error fetching ordered products:', error);
        throw error; // Propagate the error to handle it in the calling code
      }
    },
    async fetchLoggedInUser() {
      try {
        const response = await axios.get('/api/loggedInUser');
        this.loggedInUser = response.data;
      } catch (error) {
        console.error('Error fetching logged-in user:', error);
        throw error; // Propagate the error to handle it in the calling code
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
/* Your existing styles remain unchanged */
</style>


<style scoped>
.milk-tea-shopping-cart-container {
  text-align: center;
  padding: 20px;
}

.page-title {
  color: #8B4513; /* SaddleBrown */
}

.user-info {
  margin-top: 10px;
  font-size: 18px;
}

.product-list {
  list-style-type: none;
  padding: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.product-item {
  background-color: #F5F5F5; /* LightGray */
  border: 1px solid #D3D3D3; /* LightGray */
  border-radius: 8px;
  margin: 10px;
  padding: 15px;
  width: 200px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-image {
  width: 100%;
  border-radius: 8px;
  margin-bottom: 10px;
}

.product-details {
  text-align: left;
}

.product-name {
  color: #8B4513; /* SaddleBrown */
  font-size: 1.2em;
  margin-bottom: 5px;
}

.product-meta {
  font-size: 0.9em;
  color: #696969; /* DimGray */
}

.pagination {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.pagination button {
  padding: 10px 20px;
  margin: 0 10px;
  cursor: pointer;
  background-color: #8B4513; /* SaddleBrown */
  color: #FFF;
  border: none;
  border-radius: 5px;
  font-size: 1em;
  transition: background-color 0.3s;
}

.pagination button:disabled {
  background-color: #D3D3D3; /* LightGray */
  cursor: not-allowed;
}
</style>
