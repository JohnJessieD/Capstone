<template>
  <v-main>
    <v-container>
      <v-row>
        <v-col v-for="product in products" :key="product.id" cols="12" md="4">
          <v-card class="pa-3 mb-4">
            <v-img :src="product.image" :alt="product.name" class="mb-3"></v-img>
            <v-card-title class="headline">{{ product.name }}</v-card-title>
            <v-card-text>{{ product.description }}</v-card-text>
            <v-card-subtitle class="mb-2">$ {{ product.price }}</v-card-subtitle>
            <v-btn @click="openProductModal(product)" color="primary">Add to Cart</v-btn>
          </v-card>
        </v-col>
      </v-row>

      <v-row>
        <v-col>
          <v-card class="pa-3">
            <h2>Categories</h2>
            <v-list>
              <v-list-item v-for="category in categories" :key="category.id">
                <v-list-item-content @click="filterProducts(category)">
                  <v-list-item-title>{{ category.name }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-container>

    <v-dialog v-model="showModal" max-width="400">
      <v-card>
        <v-card-title>Product Details</v-card-title>
        <v-card-text>
          <h3>{{ selectedProduct.name }}</h3>
          <p>{{ selectedProduct.description }}</p>
          <div>Price: $ {{ selectedProduct.price }}</div>
          <v-text-field v-model="quantity" label="Quantity" type="number" min="1"></v-text-field>
          <v-text-field v-model="total_amount" label="Total" type="number" min="1" :readonly="true"></v-text-field>
          <v-text-field v-model="customer_name" label="Customer Name" :readonly="true"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="buy" color="primary">Buy</v-btn>
          <v-btn @click="closeModal" color="error">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-main>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      categories: [{ id: 0, name: 'All' }],
      showModal: false,
      selectedProduct: {},
      customer_name: '',
      quantity: 1,
      total_amount: 0,
      orders: [],
    };
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('/api/products');
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async fetchCategories() {
      try {
        const response = await axios.get('/api/getCategories');
        this.categories = [...this.categories, ...response.data];
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    filterProducts(category) {
      if (category.name === 'All') {
        this.fetchProducts();
      } else {
        const response = this.products.filter(product => product.category === category.name);
        this.products = response;
      }
    },
    async openProductModal(product) {
      this.selectedProduct = product;
      this.showModal = true;

      // Fetch the logged-in user's information
      try {
        const response = await axios.get('/api/user/getLoggedInUser');
        this.customer_name = response.data.username;
      } catch (error) {
        console.error('Error fetching logged-in user:', error);
        // Handle the error as needed
      }

      this.total_amount = 0;
    },
    buy() {
      const order = {
        customer_name: this.customer_name,
        product_name: this.selectedProduct.name,
        product_description: this.selectedProduct.description,
        product_price: this.selectedProduct.price,
        quantity: parseInt(this.quantity),
        total_amount: this.selectedProduct.price * parseInt(this.quantity),
      };

      // Add the order to the shopping cart
      this.orders.push(order);

      // Send the order to the backend for processing
      axios.post('/api/submitOrder', order)
        .then(response => {
          console.log('Order submitted successfully:', response.data);
          // Optionally, you can handle success actions here
        })
        .catch(error => {
          console.error('Error submitting order:', error);
          // Optionally, you can handle error actions here
        });

      // Reset modal and quantity
      this.showModal = false;
      this.quantity = 1;
    },
    closeModal() {
      this.showModal = false;
    },
  },
};
</script>

<style scoped>
/* ... your existing component-specific styles ... */
</style>
