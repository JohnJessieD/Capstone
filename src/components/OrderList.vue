<!-- src/components/OrderHistory.vue -->

<template>
  <div>
    <h2>Order History</h2>
    <ul>
      <li v-for="order in orders" :key="order.id">
        {{ order.customer_name }} - {{ order.total_amount }} - {{ order.created_at }}
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
        const response = await this.$axios.get('api/orders');
        this.orders = response.data;
      } catch (error) {
        console.error('Error fetching orders', error);
      }
    },
  },
};
</script>
