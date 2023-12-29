<template>
  <v-app>
    <!-- Product Management Section -->
    <v-row>
      <v-col cols="12" sm="6">
        <v-card class="product-management-card">
          <v-card-title>Product Management</v-card-title>
          <v-card-text>
            <v-btn @click="addProductDialog">Add Product</v-btn>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <!-- Product Display Card -->
    <v-card class="product-display-card">
      <v-card-title>Products</v-card-title>
      <v-row>
        <v-col v-for="(product, index) in prod" :key="index" cols="12" sm="4">
          <v-card @click="showQuantity(index)">
            <img :src="product.image" alt="Product Image" class="product-image">
            <v-card-title>{{ product.name }}</v-card-title>
            <v-card-subtitle>{{ product.category }}</v-card-subtitle>
            <v-card-subtitle>{{ product.price }}</v-card-subtitle>
            <v-card-subtitle>{{ product.quantity }}</v-card-subtitle>
            <v-card-subtitle>{{ product.upc }}</v-card-subtitle>
            <v-btn @click="removeProduct(product.y)">Remove Product</v-btn>
          </v-card>
        </v-col>
      </v-row>
      <v-row v-if="loadingProducts">
        <v-col cols="12">
          <v-skeleton-loader type="list-item-three-line"></v-skeleton-loader>
        </v-col>
      </v-row>
      <v-row v-if="prod.length === 0 && !loadingProducts">
        <v-col cols="12">
          <v-card>
            <v-card-text>No products available</v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-card>

    <!-- Sales Summary Card -->
    <v-row>
      <v-col cols="12" sm="6">
        <v-card class="sales-summary-card">
          <v-card-title>Sales Summary</v-card-title>
          <v-card-text>
            <div v-if="salesTransactionNumber">
              Sales Transaction Number: <b>{{ salesTransactionNumber }}</b>
            </div>
            <div>Total Price: <b>{{ totalSalesPrice.toFixed(2) }}</b></div>
            <div>Total Items Sold: <b>{{ totalItemsSold }}</b></div>
          </v-card-text>
          <v-data-table :items="tableData" :headers="tableHeaders" dense>
            <template v-slot:items="props">
              <td>{{ props.item.name }}</td>
              <td>{{ props.item.category }}</td>
              <td>{{ props.item.price }}</td>
              <td>{{ props.item.quantity }}</td>
              <td>{{ props.item.quantity * props.item.price }}</td>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>

    <!-- Quantity Modal -->
    <v-dialog v-model="showQuantityModal" max-width="400">
      <v-card class="quantity-modal-card">
        <v-card-title>Enter Quantity</v-card-title>
        <v-card-text>
          <v-text-field v-model="selectedProduct.quantity" label="Quantity"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="confirmQuantity">Confirm</v-btn>
          <v-btn @click="cancelQuantity">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Add Product Dialog -->
    <v-dialog v-model="showAddProductDialog" max-width="400">
      <v-card>
        <v-card-title>Add Product</v-card-title>
        <v-card-text>
          <form @submit.prevent="addProduct">
            <v-text-field v-model="products.name" label="Product Name" required></v-text-field>
            <v-text-field v-model="products.upc" label="UPC" required></v-text-field>
            <v-text-field v-model="products.category" label="Category" required></v-text-field>
            <v-text-field v-model="products.price" label="Price" type="number" required></v-text-field>
            <v-text-field v-model="products.quantity" label="Quantity" type="number" required></v-text-field>
            <!-- Image Upload -->
            <v-file-input
              v-model="imageFile"
              label="Product Image"
              accept="image/*"
              @change="handleImageUpload"
            ></v-file-input>
            <v-btn type="submit">Add</v-btn>
          </form>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      prod: [],
      salesTransactionNumber: null,
      totalSalesPrice: 0,
      totalItemsSold: 0,
      tableData: [],
      tableHeaders: [
        { text: 'Product Name', value: 'name' },
        { text: 'Category', value: 'category' },
        { text: 'Price', value: 'price' },
        { text: 'Quantity', value: 'quantity' },
        { text: 'Total', value: 'total' },
      ],
      showQuantityModal: false,
      selectedProduct: null,
      showAddProductDialog: false,
      products: { name: '', category: '', price: 0, quantity: 0, upc: '', image: null },
      loadingProducts: false,
    };
  },
  computed: {
    totalProducts() { return this.prod.length; },
    averagePrice() { 
      if (this.prod.length === 0) return 0; 
      const total = this.prod.reduce((sum, product) => sum + product.price, 0); 
      return total / this.prod.length; 
    },
  },
  methods: {
    handleImageUpload() {
      if (this.imageFile instanceof Blob) {
        const reader = new FileReader();

        reader.onload = (e) => {
          this.products.image = e.target.result;
        };

        reader.readAsDataURL(this.imageFile);
      } else {
        console.error('Invalid file type');
      }
    },
    addProductDialog() {
      this.showAddProductDialog = true;
    },
    addProduct() {
      if (!this.products.name || !this.products.category || this.products.price <= 0 || !this.products.upc)  {
        // Show error message
        return;
      }

      axios.post('/api/add-product', this.products)
        .then(response => {
          console.log('Product added successfully:', response.data);
          this.prod.push({ ...this.products });
          this.products = { name: '', category: '', price: 0, quantity: 0, upc: '', image: null };
          this.showAddProductDialog = false;
        })
        .catch(error => {
          console.error('Error adding product:', error);
        });
    },
    removeProduct(productName) {
    const productIndex = this.prod.findIndex(product => product.name === productName);

    if (productIndex !== -1) {
        this.prod.splice(productIndex, 1);

        axios.delete(`/api/products/delete/${productName}`)
            .then(response => {
                console.log(response.data.msg); // Assuming the server sends a 'msg' in the response
            })
            .catch((error) => {
                console.error('Error deleting product:', error);
            });
    } else {
        console.error('Product not found');
    }
},
    showQuantity(index) {
      this.selectedProduct = this.prod[index];
      this.showQuantityModal = true;
    },
    confirmQuantity() {
      this.showQuantityModal = false;
      this.calculateTotalPrice();
    },
    cancelQuantity() {
      this.showQuantityModal = false;
    },
    calculateTotalPrice() {
      this.totalSalesPrice = this.tableData.reduce((total, item) => total + item.quantity * item.price, 0);
      this.totalItemsSold = this.tableData.reduce((total, item) => total + item.quantity, 0);
    },
    fetchProducts() {
      this.loadingProducts = true;

      axios.get('/api/products')
        .then(response => {
          this.prod = response.data;
          this.loadingProducts = false;
        })
        .catch(error => {
          console.error('Error fetching products:', error);
          this.loadingProducts = false;
        });
    },
  },
  mounted() {
    this.fetchProducts();
  },
};
</script>

<style>
/* Center the entire application */
.v-app {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(to right, #c9d6ff, #e2e2e2) url('') repeat;
}

/* Common styling for cards */
.v-card {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  border-radius: 15px;
  overflow: hidden;
  margin-bottom: 20px;
}

/* Styling for the Product Management Card */
.product-management-card {
  background: linear-gradient(to right, #66cc99, #4CAF50); /* Gradient background */
  color: white;
  padding: 20px;
}

/* Styling for the Product Display Card */
.product-display-card {
  background: linear-gradient(to right, #64b5f6, #2196F3); /* Gradient background */
  color: white;
  padding: 20px;
}

/* Styling for the Sales Summary Card */
.sales-summary-card {
  background: linear-gradient(to right, #ffd54f, #FFC107); /* Gradient background */
  color: white;
  padding: 20px;
}

/* Styling for the Quantity Modal */
.quantity-modal-card {
  background: linear-gradient(to right, #ab47bc, #9C27B0); /* Gradient background */
  color: white;
  padding: 30px;
}

/* Styling for the Order Management Card */
.order-management-card {
  background: linear-gradient(to right, #ff8a65, #FF5722); /* Gradient background */
  color: white;
  padding: 20px;
}

/* Styling for Buttons */
.v-btn {
  background: #ff8a65; /* Orange */
  color: white;
  margin: 5px;
  border-radius: 8px;
  transition: background 0.3s ease, transform 0.2s ease;
}

.v-btn:hover {
  background: #ff7043; /* Darker Orange on hover */
  transform: scale(1.05);
}

/* Styling for DataTable */
.v-data-table {
  background: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

/* Custom Fonts */
.v-card-title,
.v-card-subtitle,
.v-btn,
.v-data-table th,
.v-data-table td {
  font-family: 'Roboto', sans-serif; /* Modern font */
}
</style>