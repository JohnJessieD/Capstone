<template>
  <div class="order-history-container" style="background-color: #1a1a1a; color: #fff; padding: 20px;">
    <div class="order-history-card" v-for="(order, index) in displayedOrders" :key="order.id">
      <div class="order-card-header" style="border-bottom: 2px solid #4d4d4d; padding-bottom: 1rem; margin-bottom: 1rem;">
        <h2 style="color: #ffbf00; font-size: 1.5rem; margin-bottom: 0.5rem;">{{ order.product_name }}</h2>
        <p class="order-id" style="color: #a0a0a0; font-size: 0.9rem; margin-bottom: 0.5rem;">
          <i class="fas fa-receipt" style="color: #4d4d4d;"></i> Order #{{ order.id }} - {{ formatDate(order.date) }}
        </p>
        <p class="order-status" style="color: #a0a0a0; font-size: 0.9rem;">
          <i class="fas fa-info-circle" style="color: #4d4d4d;"></i> Status: {{ order.status }}
        </p>
      </div>
      <div class="order-card-details">
        <label style="color: #ffbf00; font-size: 1rem;"><i class="fas fa-info-circle"></i> Product Description:</label>
        <p style="color: #a0a0a0;">{{ order.product_description }}</p>

        <p class="price-and-quantity" style="display: flex; justify-content: space-between; margin-top: 1rem;">
          <span style="color: #ffbf00; font-size: 1rem;">
            <i class="fas fa-dollar-sign"></i> Price: {{ order.product_price | currency }}
          </span>

          <span style="color: #ffbf00; font-size: 1rem;">
            <i class="fas fa-shopping-cart"></i> Quantity: x{{ order.quantity }}
          </span>
        </p>

        <label style="color: #ffbf00; font-size: 1rem; margin-top: 1rem;"><i class="fas fa-coins"></i> Total Amount:</label>
        <p class="total-amount" style="color: #ffbf00; font-size: 1.2rem; margin: 0;">
          {{ order.total_amount | currency }}
        </p>
      </div>
      <button @click="viewOrderDetails(order.id)" style="background-color: #ffbf00; color: #1a1a1a; padding: 0.5rem 1rem; border: none; cursor: pointer;">
        View Details
      </button>
    </div>

    <!-- Pagination -->
    <div class="pagination" style="margin-top: 2rem; display: flex; justify-content: center;">
      <button @click="loadPreviousPage" :disabled="currentPage === 1" style="background-color: #007bff; color: #fff; padding: 0.5rem 1rem; border: none; cursor: pointer; border-radius: 5px;">
        Previous
      </button>
      <span style="color: #ffbf00; font-size: 1rem; margin: 0 1rem;">{{ currentPage }}</span>
      <button @click="loadNextPage" :disabled="currentPage === totalPages" style="background-color: #007bff; color: #fff; padding: 0.5rem 1rem; border: none; cursor: pointer; border-radius: 5px;">
        Next
      </button>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      orders: [],
      currentPage: 1,
      ordersPerPage: 10,
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.orders.length / this.ordersPerPage);
    },
    displayedOrders() {
      const startIndex = (this.currentPage - 1) * this.ordersPerPage;
      const endIndex = startIndex + this.ordersPerPage;
      return this.orders.slice(startIndex, endIndex);
    },
  },
  mounted() {
    this.fetchOrders();
  },
  methods: {
    async fetchOrders() {
      try {
        const response = await axios.get('/api/FindOrders');
        this.orders = response.data;
      } catch (error) {
        console.error('Error fetching orders', error);
      }
    },
    viewOrderDetails(order_id) {
     this.$router.push(`/OrderDetails/${order_id}`);
    },
    loadPreviousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    loadNextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    formatDate(date) {
      // Implement the date formatting logic here
      // You can use a library like moment.js for this purpose
      // Example: return moment(date).format('MMMM Do YYYY, h:mm:ss a');
    },
  },
};
</script>
<style scoped>
.order-history-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.order-history-card {
  width: 30%;
  margin: 1rem;
  padding: 1rem;
  border: 2px solid #4d4d4d;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  background-color: #333333;
}
.order-card-header {
  margin-bottom: 1rem;
}

.order-card-details label {
  font-weight: bold;
}

.price-and-quantity {
  display: flex;
  justify-content: space-between;
}

.pagination {
  margin-top: 1rem;
  display: flex;
  justify-content: center;
}
.pagination button {
  margin: 0 0.5rem;
  padding: 0.5rem 1rem;
  cursor: pointer;
  border: none;
  border-radius: 5px;
}

.pagination button:disabled {
  background-color: #ccc;
  border-color: #ccc;
  cursor: not-allowed;
}
</style>