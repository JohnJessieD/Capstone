<template>
  <v-main>
    <v-container>
      <div>
        <label for="orderDirection">Pricing:</label>
        <select id="orderDirection" v-model="orderDirection" @change="fetchProducts">
          <option value="asc">Highest- Lowest </option>
          <option value="desc">Lowest-Highest</option>
        </select>
        <!-- Input for custom order -->
        <input v-if="orderBy === 'custom'" type="text" v-model="customOrder" placeholder="Enter custom order">
      </div>
      <v-row>
        <v-col v-for="product in sortedProducts" :key="product.id" cols="12" md="4">
          <v-card class="pa-3 mb-4">
            <v-img :src="product.image" :alt="product.name" class="mb-3"></v-img>
            <v-card-title class="headline">{{ product.name }}</v-card-title>
            <v-card-text>{{ product.description }}</v-card-text>
            <v-card-subtitle class="mb-2">$ {{ product.price }}</v-card-subtitle>
            <v-btn @click="openProductModal(product)" color="primary">Add to Cart</v-btn>
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
          <v-text-field v-model="quantity" label="Quantity" type="number" min="1" @input="updateTotalAmount"></v-text-field>
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
      orderBy: 'name', // Add orderBy for sorting
      orderDirection: 'asc', // Add orderDirection for sorting
      customOrder: '', // Add customOrder for custom sorting
    };
  },
  computed: {
    sortedProducts() {
      if (this.orderBy === 'custom') {
        // Custom order logic
        const customOrderArray = this.customOrder.split(',');
        return this.products.slice().sort((a, b) => {
          // Your custom sorting logic here
        });
      } else {
        // Default sorting logic
        return this.products.slice().sort((a, b) => {
          const orderModifier = this.orderDirection === 'desc' ? -1 : 1;
          return orderModifier * (a[this.orderBy] > b[this.orderBy] ? 1 : -1);
        });
      }
    },
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
      }

      this.total_amount = this.selectedProduct.price * this.quantity;
    },
    buy() {
      const order = {
        customer_name: this.customer_name,
        product_name: this.selectedProduct.name,
        product_description: this.selectedProduct.description,
        product_price: this.selectedProduct.price,
        quantity: parseInt(this.quantity),
        total_amount: this.total_amount,
      };

      // Add the order to the shopping cart
      this.orders.push(order);

      // Send the order to the backend for processing
      axios.post('/api/submitOrder', order)
        .then(response => {
          console.log('Order submitted successfully:', response.data);
        })
        .catch(error => {
          console.error('Error submitting order:', error);
        });

      // Reset modal and quantity
      this.showModal = false;
      this.quantity = 1;
    },
    updateTotalAmount() {
      this.total_amount = this.selectedProduct.price * this.quantity;
    },
    closeModal() {
      this.showModal = false;
    },
  },
};
</script><style scoped>
/* Card styles */
.v-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  transition: box-shadow 0.3s ease;
}

.v-card:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.v-img {
  border-radius: 8px 8px 0 0;
}

.v-card-title {
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
}

.v-card-subtitle {
  color: #4caf50; /* Green color for price */
  font-weight: bold;
}

.v-btn {
  margin-top: 1rem;
}

/* Modal styles */
.v-dialog {
  font-family: 'Arial', sans-serif;
}

.v-card-title {
  background-color: #4caf50; /* Green background for modal title */
  color: white;
}

.v-card {
  border-radius: 8px;
}

.v-text-field {
  margin-bottom: 1rem;
}

.v-btn-primary {
  color: #fff;
  background-color: #4caf50; /* Green color for primary button */
}

.v-btn-error {
  color: #fff;
  background-color: #ff5252; /* Red color for error button */
}

/* Add other styles as needed */
</style>
