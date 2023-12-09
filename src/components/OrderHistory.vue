<!-- src/components/OrderHistory.vue -->

<template>
  <div>
    <h2>Order History</h2>
    <ul>
      <li v-for="order in orders" :key="order.id">
        {{ order.customer_name }} - {{ order.product_name }} - {{ order.quantity }} - {{ order.total_amount }}
      </li>
    </ul>
  </div>
</template>

<script>
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
        // Make sure to replace 'http://your-backend-url/' with the actual URL of your CodeIgniter backend
        const response = await this.$axios.get('http://your-backend-url/api/orders');
        this.orders = response.data;
      } catch (error) {
        console.error('Error fetching orders', error);
      }
    },
  },
};
</script>
