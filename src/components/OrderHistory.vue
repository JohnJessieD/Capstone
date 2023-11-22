<template>
  <div>
  
    <v-container>
      <v-row>
        <v-col cols="12">
          <h2 class="text-h6 font-weight-bold mb-4">Add New Order</h2>
          <v-form @submit.prevent="addOrder">
            <!-- Add your form fields for new orders -->
            <v-text-field v-model="newOrder.id" label="Order ID"></v-text-field>
            <v-text-field v-model="newOrder.date" label="Order Date"></v-text-field>
            <v-text-field v-model="newOrder.total" label="Total" type="number"></v-text-field>

            <v-btn type="submit" color="primary">Add Order</v-btn>
          </v-form>
        </v-col>
      </v-row>

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
  </div>
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
      newOrder: {
        id: null,
        date: null,
        total: null,
      },
    };
  },
  methods: {
    addOrder() {
      // Validate and add the new order to the orders array
      if (this.newOrder.id && this.newOrder.date && this.newOrder.total) {
        this.orders.push({
          id: this.newOrder.id,
          date: this.newOrder.date,
          total: parseFloat(this.newOrder.total),
        });

        // Clear the form fields after adding the order
        this.newOrder.id = null;
        this.newOrder.date = null;
        this.newOrder.total = null;
      }
    },
  },
};
</script>

<style scoped>
v-app {
  margin-top: 0;
}
</style>
