<template>
  <v-container class="page-container">
    <v-row class="best-products">
      <v-col v-if="loading" cols="12" class="text-center">
        <v-progress-circular indeterminate color="primary"></v-progress-circular>
      </v-col>
      <v-col v-else v-for="product in highestBoughtProduct" :key="product.product_id" cols="12" sm="6" md="4">
        <v-card class="product-card">
          <v-card-title class="text-h6">{{ product.name }}</v-card-title>
          <v-card-subtitle>{{ product.description }}</v-card-subtitle>
          <v-card-actions>
            <v-btn @click="addToCart(product)" color="primary">Add to Cart</v-btn>
            <div class="product-price">$ {{ product.price }}</div>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-row v-if="error" cols="12" class="text-center">
      <v-col>
        <div class="red--text">{{ error }}</div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      highestBoughtProduct: [],
      loading: false,
      error: null,
    };
  },
  mounted() {
    this.fetchHighestBoughtProducts(); // Fixed method name here
  },
  methods: {
    async fetchHighestBoughtProducts() {
      try {
        this.loading = true;
        const response = await axios.get('/api/highest-bought-product'); // Fixed endpoint name here
        this.highestBoughtProduct = response.data;
      } catch (error) {
        console.error('Error fetching highest bought product:', error);
        this.error = 'Failed to fetch highest bought product.';
      } finally {
        this.loading = false;
      }
    },
    addToCart(product) {
      // Implement the addToCart functionality as needed
    },
    // Other methods
  },
};
</script>

<style scoped>
.best-products {
  padding: 20px;
}

.product-card {
  margin: 20px;
  padding: 10px;
  border-radius: 5px;
}

.product-image {
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.product-price {
  margin-top: 10px;
}
</style>
