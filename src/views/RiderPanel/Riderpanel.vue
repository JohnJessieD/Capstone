<template>
    <div>
      <div class="card mt-4">
        <div class="card-body">
          <h1 class="card-title">Rider Panel</h1>
  
          <transition name="fade">
            <div v-if="loading" class="loading-message card-text">
              <i class="fas fa-spinner fa-spin"></i> Loading...
            </div>
            <div v-else>
              <div v-if="orders.length === 0" class="no-orders-message card-text">
                No orders available.
              </div>
              <div v-else>
                <div v-for="order in orders" :key="order.id">
                  <div class="order-item card">
                    <!-- Order details go here -->
                    <div v-if="order.name !== undefined" class="order-detail card-body">
                      <h3>Name: {{ order.name }}</h3>
                    </div>
                    <div v-if="order.product_name !== undefined" class="order-detail card-body">
                      <h3>Product: {{ order.product_name }}</h3>
                    </div>
                    <div v-if="order.quantity !== undefined" class="order-detail card-body">
                      <h3>Quantity: {{ order.quantity }}</h3>
                    </div>
                    <div v-if="order.status !== undefined" class="order-detail card-body">
                      <p>Status: {{ order.status }}</p>
                    </div>
                    <button @click="confirmDelivery(order.id, 'ongoing')" class="confirm-button card-body">
                      Set Ongoing
                    </button>
                    <button @click="confirmDelivery(order.id, 'delivered')" class="confirm-button card-body">
                      Set Delivered
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </transition>
  
          <div v-if="error" class="error-message card-text">{{ error }}</div>
        </div>
      </div>
    </div>
  </template>
  
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        orders: [],
        loading: false,
        error: null,
      };
    },
    mounted() {
      this.fetchOrders();
    },
    methods: {
      async fetchOrders() {
        this.loading = true;
        try {
          const response = await axios.get('/api/orderProducts');
          this.orders = response.data;
          this.error = null; // Clear any previous errors
        } catch (error) {
          this.handleError(error);
        } finally {
          this.loading = false;
        }
      },
      async confirmDelivery(orderId, status) {
        this.loading = true;
        try {
          const orderIndex = this.orders.findIndex(order => order.id === orderId);
  
          if (orderIndex !== -1 && this.orders[orderIndex].status !== 'delivered') {
            await axios.put(`/api/update/${orderId}`, { status });
            this.orders[orderIndex].status = status; // Update status in the local data
            this.error = null; // Clear any previous errors
          } else {
            // Order has already been delivered, do nothing or handle accordingly
            console.warn('Order has already been delivered.');
          }
        } catch (error) {
          this.handleError(error);
        } finally {
          this.loading = false;
        }
      },
      handleError(error) {
        // Error handling logic
      },
    },
  };
  </script>
 
  


  <style scoped>
  .rider-panel {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #3498db; /* Updated background color to a delivery-themed blue */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .panel-title {
    font-size: 24px;
    color: #fff; /* White text color for better contrast on the blue background */
    margin-bottom: 20px;
  }
  
  .loading-message,
  .no-orders-message,
  .error-message {
    font-size: 18px;
    margin-top: 20px;
    padding: 10px;
    background-color: #e74c3c; /* Updated error message background color to a delivery-themed red */
    border: 1px solid #c0392b; /* Corresponding border color */
    border-radius: 5px;
    color: #fff; /* White text color for better contrast on the red background */
  }
  
  .order-item {
    margin-bottom: 20px;
    padding: 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  
  .order-detail {
    margin-bottom: 10px;
    color: #333; /* Text color for order details */
  }
  
  .confirm-button {
    background-color: #2ecc71; /* Updated button color to a delivery-themed green */
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .confirm-button:hover {
    background-color: #27ae60; /* Darker green on hover */
  }
  
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.5s;
  }
  
  .fade-enter,
  .fade-leave-to {
    opacity: 0;
  }
  </style>  