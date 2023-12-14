<!-- src/components/OrderHistory.vue -->

<template>
  <div class="container mt-5">
    <div class="card p-4">
      <h2 class="text-center mb-4">Order History</h2>

      <div class="row">
        <div v-for="order in orders" :key="order.id" class="col-lg-3 mb-3">
          <div class="card border-primary custom-card">
            <div class="card-body">
              <h5 class="card-title">Orders{{ order.id }}</h5>

              <p class="card-text">
                <strong>Customer:</strong> {{ order.customer_name }} <br>
                <strong>Product:</strong> {{ order.product_name }} <br>
                <strong>Price:</strong> {{ order.product_price | currency }} <br>
                <strong>Quantity:</strong> {{ order.quantity }} <br>
                <strong>Total Amount:</strong> {{ order.total_amount | currency }}
              </p>
            </div>
          </div>
        </div>
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
    };
  },
  mounted() {
    this.fetchOrders();
  },
  methods: {
    async fetchOrders() {
      try {
        // Replace 'http://your-backend-url/' with the actual URL of your CodeIgniter backend
        const response = await axios.get('/api/FindOrders');
        this.orders = response.data;
      } catch (error) {
        console.error('Error fetching orders', error);
      }
    },
  },
};
</script>

<style scoped>
.custom-card {
  border-radius: 10px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s;
  overflow: hidden; /* Ensure content doesn't overflow */
}

.custom-card:hover {
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.card.border-primary {
  border-color: #007bff;
}

.card.border-primary:hover {
  border-color: #0056b3;
}

.card-title {
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
}

.card-text {
  font-size: 0.9rem;
  line-height: 1.4;
}

</style>
