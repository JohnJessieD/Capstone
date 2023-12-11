<!-- resources/js/components/ProductList.vue -->
<template>
  <div>
    <div class="product-list">
      <div v-for="product in products" :key="product.id" class="product-card">
        <strong class="product-name">{{ product.name }}</strong>
        <p class="product-description">{{ product.description }}</p>
        <p class="product-info">Price: {{ product.price }}</p>
        <p class="product-info">Category: {{ product.category }}</p>
        <p class="product-info">Status: {{ product.status }}</p>
        <button @click="addOrder(product)" class="add-to-cart-button">Add to Cart</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get(`/api/getProducts`);
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async addOrder(product) {
      try {
        // Assuming you have a route like /api/addOrder in your backend
        const response = await axios.post(`/api/addOrder`, { product_id: product.id });

        console.log('Order added successfully:', response.data);
        // You might want to update the product status or handle the response as needed
      } catch (error) {
        console.error('Error adding order:', error);
      }
    },
  },
};
</script>

<style scoped>
/* Your existing styles remain unchanged */
</style>


<style scoped>
.product-list {
  display: flex;
  flex-wrap: wrap;
}

.product-card {
  border: 1px solid #ccc;
  padding: 15px;
  margin: 10px;
  width: 300px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

.product-name {
  font-size: 1.2em;
}
.product-card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around; /* Align cards in the center with space around */
  padding: 20px; /* Add some padding around the cards */
}

/* Additional styles for ProductCard component */
.product-card {
  width: 300px;
  margin-bottom: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden; /* Hide overflowing content within the card */
}

.product-card img {
  width: 100%;
  height: 200px; /* Adjust the height of the product image */
  object-fit: cover; /* Maintain the aspect ratio and cover the container */
  border-bottom: 1px solid #ddd; /* Add a subtle border at the bottom of the image */
}

.product-card-content {
  padding: 15px;
}

.product-card-title {
  font-size: 1.2em;
  margin-bottom: 10px;
}

.product-card-description {
  color: #555;
  margin-bottom: 15px;
}

.product-card-info {
  font-size: 0.9em;
  color: #777;
}

</style>
