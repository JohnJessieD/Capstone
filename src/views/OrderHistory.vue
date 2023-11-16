<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <h2 class="text-h6 font-weight-bold mb-4">Order History</h2>
        <v-list>
          <v-list-item-group v-if="orders.length > 0">
            <v-list-item v-for="order in orders" :key="order.id">
              <v-list-item-content>
                <v-list-item-title class="font-weight-bold">Order ID: {{ order.id }}</v-list-item-title>
                <v-list-item-subtitle>Date: {{ order.date }}</v-list-item-subtitle>
                <v-list-item-subtitle>Total: ${{ order.total.toFixed(2) }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
          <v-list-item v-else>
            <v-list-item-content>
              <v-list-item-title class="font-weight-bold">No orders yet.</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      orders: [
        {
          id: 1,
          date: '2023-11-01',
          total: 99.99,
          // Add more order data
        },
        {
          id: 2,
          date: '2023-10-15',
          total: 49.99,
          // Add more order data
        },
        // Add more order data
      ],
    };
  },
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
