<template>
  <v-main>
    <div class="ecommerce-container">
      <div class="product-list">
        <div class="product-card" v-for="product in products" :key="product.id">
          <div class="product-card-inner">
            <img :src="product.image" :alt="product.name" class="product-image">
            <div class="product-details">
              <h3 class="product-title">{{ product.name }}</h3>
              <p class="product-description">{{ product.description }}</p>
              <div class="product-price">$ {{ product.price }}</div>
              <div class="product-category">
                <span class="category-label" v-if="product.category === 'Milk Tea'">Milk Tea</span>
                <span class="category-label" v-else-if="product.category === 'Korean Food'">Korean Food</span>
              </div>
              <v-btn @click="openProductModal(product)" color="primary">Add to Cart</v-btn>
            </div>
          </div>
        </div>
      </div>
      <div class="category-filters">
        <h2>Categories</h2>
        <ul>
          <li v-for="category in categories" :key="category.id">
            <a @click="filterProducts(category)">{{ category.name }}</a>
          </li>
        </ul>
      </div>
    </div>

    <v-dialog v-model="showModal" max-width="400">
      <v-card>
        <v-card-title>Product Details</v-card-title>
        <v-card-text>
          <h3>{{ selectedProduct.name }}</h3>
          <p>{{ selectedProduct.description }}</p>
          <div>Price: $ {{ selectedProduct.price }}</div>
          <v-text-field v-model="quantity" label="Quantity" type="number" min="1"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="addToCartAndCloseModal" color="primary">Buy</v-btn>
          <v-btn @click="closeModal" color="error">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-main>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      categories: [],
      showModal: false,
      selectedProduct: {},
      quantity: 1,
    };
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await fetch('/api/products'); // replace with your backend API endpoint
        const data = await response.json();
        this.products = data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async fetchCategories() {
      try {
        const response = await fetch('/api/categories'); // replace with your backend API endpoint
        const data = await response.json();
        this.categories = data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    filterProducts(category) {
      // Implement logic to filter products based on the selected category
      // Update this.products with the filtered products
    },
    openProductModal(product) {
      this.selectedProduct = product;
      this.showModal = true;
    },
    addToCartAndCloseModal() {
      // Implement logic to add the selected product to the cart with the specified quantity
      // Close the modal after adding to the cart
      this.showModal = false;
    },
    closeModal() {
      this.showModal = false;
    },
  },
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
