<template>
  <v-container class="page-container">
    <v-row class="best-products">
      <v-col v-for="product in highestBoughtProducts" :key="product.product_id" cols="12" sm="6" md="4">
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
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      highestBoughtProducts: [],
    };
  },
  mounted() {
    // Fetch highest bought products from the server when the component is mounted
    this.fetchHighestBoughtProducts();
  },
  methods: {
    async fetchHighestBoughtProducts() {
      try {
        // Make an Axios request to get highest bought products
        const response = await axios.get('/api/highest-bought-products');
        console.log('Response from server:', response.data); // Log the response
        this.highestBoughtProducts = response.data;
      } catch (error) {
        console.error('Error fetching highest bought products:', error);
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
