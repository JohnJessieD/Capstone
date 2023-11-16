
<template>
  <div class="page-container">
    <Navbar />
    <div class="best-products">
      <h2>Best Milk Tea Products</h2>
      <div class="product-list">
        <div class="product-card" v-for="product in bestMilkTeaProducts" :key="product.id">
          <img :src="product.image" :alt="product.name" class="product-image">
          <h3 class="product-title">{{ product.name }}</h3>
          <p class="product-description">{{ product.description }}</p>
          <div class="product-price">$ {{ product.price }}</div>
          <v-btn @click="addToCart(product)" color="primary">Add to Cart</v-btn>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import Navbar from '../views/Navbar.vue';

export default {
  components: {
    Navbar,
  },
    data() {
      return {
        bestMilkTeaProducts: [
          {
            id: 1,
            name: 'Classic Milk Tea',
            description: 'Our signature classic milk tea with rich flavor.',
            price: 4.99,
            image: 'classic-milk-tea.jpg',
          },
          {
            id: 2,
            name: 'Taro Milk Tea',
            description: 'Creamy taro-flavored milk tea with tapioca pearls.',
            price: 5.99,
            image: 'taro-milk-tea.jpg',
          },
          {
            id: 3,
            name: 'Matcha Green Tea Latte',
            description: 'Delicious matcha green tea latte with foamy top.',
            price: 6.49,
            image: 'matcha-latte.jpg',
          },
          {
            id: 4,
            name: 'Honeydew Milk Tea',
            description: 'Refreshing honeydew milk tea with a twist.',
            price: 5.49,
            image: 'honeydew-milk-tea.jpg',
          },
          // Add more best milk tea products
        ],
      };
    },
    methods: {
      addToCart(product) {
        // Implement cart logic (e.g., add the product to the cart)
      },
      // Other methods
    },
  };
  </script>
  
<style scoped>
.best-products {
  padding: 20px;
}

.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.product-card {
  width: 300px;
  margin: 20px;
  padding: 10px;
  border: 1px solid #e0e0e0;
  border-radius: 5px;
}

.product-image {
  max-width: 100%;
}
</style>
  