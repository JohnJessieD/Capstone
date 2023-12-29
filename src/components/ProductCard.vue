<template>
  <v-main>
    <v-container>
      <!-- Search input -->
      <v-text-field v-model="searchKeyword" label="Search" @input="searchProducts"></v-text-field>

      <!-- Category filter -->
      <div>
        <label for="category">Category:</label>
        <select id="category" v-model="selectedCategory" @change="filterProductsByCategory">
          <option v-for="category in categories" :key="category.id" :value="category.name">{{ category.name }}</option>
        </select>
      </div>

      <!-- Sorting options -->
      <div>
        <label for="orderBy">Sort By:</label>
        <select id="orderBy" v-model="orderBy" @change="fetchProducts">
          <option value="name">Name</option>
          <option value="price">Price</option>
          <option value="custom">Custom Order</option>
          <!-- Add more sorting options as needed -->
        </select>

        <!-- Input for custom order -->
        <input v-if="orderBy === 'custom'" type="text" v-model="customOrder" placeholder="Enter custom order">
      </div>

      <!-- Product cards -->
      <v-row>
        <v-col v-for="product in paginatedProducts" :key="product.id" cols="12" md="4">
          <v-card class="pa-3 mb-4">
            <v-img :src="product.image" class="mb-3"></v-img>
            <v-card-title class="headline">{{ product.name }}</v-card-title>
            <v-card-text>{{ product.description }}</v-card-text>
            <v-card-subtitle class="mb-2">$ {{ product.price }}</v-card-subtitle>
            <v-btn @click="openProductModal(product)" color="primary">Add to Cart</v-btn>
          </v-card>
        </v-col>
      </v-row>

      <!-- Pagination -->
      <v-pagination v-model="currentPage" :length="Math.ceil(filteredProducts.length / itemsPerPage)"></v-pagination>

      <!-- Product details modal -->
      <v-dialog v-model="showModal" max-width="400">
        <v-card>
          <v-card-title>Product Details</v-card-title>
          <v-card-text>
            <h3>{{ selectedProduct.name }}</h3>
            <p>{{ selectedProduct.description }}</p>
            <div>Price: $ {{ selectedProduct.price }}</div>
            <div>UPC: {{ selectedProduct.upc }}</div>
            <v-text-field v-model="quantity" label="Quantity" type="number" min="1" @input="updateTotalAmount"></v-text-field>

            <!-- Dropdown for sugar variety -->
            <v-select v-model="selectedSugarVariety" :items="sugarVarieties" label="Sugar Variety"></v-select>

            <!-- Dropdown for sugar level -->
            <v-select v-model="selectedSugarLevel" :items="sugarLevels" label="Sugar Level"></v-select>

            <!-- Dropdown for size -->
            <v-select v-model="selectedSize" :items="sizes" label="Size"></v-select>

            <!-- Add these fields for user input -->
            <v-text-field v-model="customer_name" label="Customer Name"></v-text-field>
            <v-text-field v-model="customer_address" label="Customer Address"></v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="buy" color="primary">Buy</v-btn>
            <v-btn @click="closeModal" color="error">Cancel</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
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
      customer_name: '',
      customer_address: '',
      orders: [],
      orderBy: 'name',
      orderDirection: 'asc',
      customOrder: '',
      searchKeyword: '',
      selectedCategory: 'All',
      currentPage: 1,
      itemsPerPage: 9,
      image: '',
      sugarVarieties: ['White Sugar', 'Brown Sugar', 'Raw Sugar', 'Maple Sugar'],
      selectedSugarVariety: 'White Sugar',
      sugarLevels: ['Low', 'Medium', 'High'],
      selectedSugarLevel: 'Medium',
      sizes: ['Small', 'Medium', 'Large'],
      selectedSize: 'Medium',
    };
  },
  computed: {
    sortedProducts() {
      if (this.orderBy === 'custom') {
        const customOrderArray = this.customOrder.split(',');
        return this.products.slice().sort((a, b) => {
          // Your custom sorting logic here
        });
      } else {
        return this.products.slice().sort((a, b) => {
          const orderModifier = this.orderDirection === 'desc' ? -1 : 1;
          return orderModifier * (a[this.orderBy] > b[this.orderBy] ? 1 : -1);
        });
      }
    },
    filteredProducts() {
      let filtered = this.sortedProducts;

      if (this.selectedCategory !== 'All') {
        filtered = filtered.filter(product => product.category === this.selectedCategory);
      }

      if (this.searchKeyword) {
        const keywordLower = this.searchKeyword.toLowerCase();
        filtered = filtered.filter(product =>
          product.name.toLowerCase().includes(keywordLower) ||
          product.description.toLowerCase().includes(keywordLower)
        );
      }

      return filtered;
    },
    paginatedProducts() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredProducts.slice(start, end);
    },
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  },
  methods: {
    handleImageChange(event) {
      this.formData.image = event.target.files[0];
    },
    async fetchProducts() {
      try {
        const response = await axios.get('/api/products');
        this.products = response.data;
        console.log('Product Images:', this.products.map(product => product.image));
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
    filterProductsByCategory() {
      this.fetchProducts();
    },
    async openProductModal(product) {
      this.selectedProduct = product;
      this.showModal = true;

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
        customer_address: this.customer_address,
        product_name: this.selectedProduct.name,
        product_description: this.selectedProduct.description,
        product_price: this.selectedProduct.price,
        quantity: parseInt(this.quantity),
        total_amount: this.total_amount,
        product_upc: this.selectedProduct.upc,
        sugar_variety: this.selectedSugarVariety,
        sugar_level: this.selectedSugarLevel,
        size: this.selectedSize,
      };

      this.orders.push(order);

      axios.post('/api/submitOrder', order)
        .then(response => {
          console.log('Order submitted successfully:', response.data);
          const submittedOrder = response.data.order;
          const localOrderIndex = this.orders.findIndex(o => o.product_upc === submittedOrder.product_upc);
          if (localOrderIndex !== -1) {
            this.orders[localOrderIndex] = submittedOrder;
          }
        })
        .catch(error => {
          console.error('Error submitting order:', error);
        });

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
</script>

<style scoped>
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
  color: #4caf50;
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
  background-color: #4caf50;
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
  background-color: #4caf50;
}

.v-btn-error {
  color: #fff;
  background-color: #ff5252;
}

/* Add other styles as needed */
</style>
