<template>
  <div>
    <table class="styled-table">
      <thead>
        <tr>
          <th>UPC</th>
          <th>Name</th>
          <th>Description</th>
          <th>Current Stocks</th>
          <th>Price</th>
          <th>Category</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in desserts" :key="item.upc">
          <td>{{ item.upc }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.description }}</td>
          <td>{{ item.quantity }}</td>
          <td>{{ item.price }}</td>
          <td>{{ item.category }}</td>
          <td>
            <v-btn @click="openQuantityModal(item)">Add Quantity</v-btn>
            <br />
            <router-link :to="{ path: '/history/:upc' + item.upc }" class="button">Audit</router-link>
            <v-btn @click="editProduct(item)">Edit</v-btn>
            <v-btn @click="deleteProduct(item.upc)">Delete</v-btn>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Quantity Modal -->
    <v-dialog v-model="quantityModal" max-width="400">
      <v-card>
        <v-card-title>Add Quantity</v-card-title>
        <v-card-text>
          <v-text-field v-model="quantityToAdd" label="Quantity"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="addQuantity">Add</v-btn>
          <v-btn @click="closeQuantityModal">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Edit Product Modal -->
    <v-dialog v-model="editProductModal" max-width="600">
      <v-card>
        <v-card-title>Edit Product</v-card-title>
        <v-card-text>
          <v-text-field v-model="editedProduct.name" label="Name"></v-text-field>
          <v-text-field v-model="editedProduct.description" label="Description"></v-text-field>
          <v-text-field v-model="editedProduct.quantity" label="Quantity"></v-text-field>
          <v-text-field v-model="editedProduct.price" label="Price"></v-text-field>
          <v-text-field v-model="editedProduct.category" label="Category"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="updateProduct">Update</v-btn>
          <v-btn @click="closeEditProductModal">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- ... (other modals if needed) ... -->

    <v-btn @click="openAddProductModal">Add Product</v-btn>

    <!-- Add Product Modal -->
    <v-dialog v-model="addProductModal" max-width="600">
      <v-card>
        <v-card-title>Add Product</v-card-title>
        <v-card-text>
          <v-text-field v-model="newProduct.name" label="Name"></v-text-field>
          <v-text-field v-model="newProduct.description" label="Description"></v-text-field>
          <v-text-field v-model="newProduct.quantity" label="Quantity"></v-text-field>
          <v-text-field v-model="newProduct.price" label="Price"></v-text-field>
          <v-text-field v-model="newProduct.category" label="Category"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="addProduct">Add</v-btn>
          <v-btn @click="closeAddProductModal">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      quantityModal: false,
      editProductModal: false,
      addProductModal: false,
      selectedProduct: null,
      quantityToAdd: 0,
      editedProduct: {
        name: '',
        description: '',
        quantity: 0,
        price: 0,
        category: '',
      },
      newProduct: {
        name: '',
        description: '',
        quantity: 0,
        price: 0,
        category: '',
      },
      search: '',
      desserts: [],
    };
  },
  created() {
    this.getProducts();
  },
  methods: {
    openQuantityModal(item) {
      this.selectedProduct = item;
      this.quantityToAdd = 0;
      this.quantityModal = true;
    },

    closeQuantityModal() {
      this.selectedProduct = null;
      this.quantityToAdd = 0;
      this.quantityModal = false;
    },

    editProduct(item) {
      this.editedProduct = { ...item };
      this.editProductModal = true;
    },

    closeEditProductModal() {
      this.editedProduct = {
        name: '',
        description: '',
        quantity: 0,
        price: 0,
        category: '',
      };
      this.editProductModal = false;
    },

    updateProduct() {
      // Implement logic to update the product on the server
      axios.put(`api/updateProduct/${this.editedProduct.upc}`, this.editedProduct)
        .then(() => {
          this.getProducts();
          this.closeEditProductModal();
        })
        .catch(error => {
          console.error('Error updating product:', error);
        });
    },

    openAddProductModal() {
      this.addProductModal = true;
    },

    closeAddProductModal() {
      this.newProduct = {
        name: '',
        description: '',
        quantity: 0,
        price: 0,
        category: '',
      };
      this.addProductModal = false;
    },

    addProduct() {
      // Implement logic to add a new product on the server
      axios.post('api/newproduct', this.newProduct)
        .then(() => {
          this.getProducts();
          this.closeAddProductModal();
        })
        .catch(error => {
          console.error('Error adding product:', error);
        });
    },

    deleteProduct(upc) {
      // Implement logic to delete the product on the server
      axios.delete(`api/removeProduct/${upc}`)
        .then(() => {
          this.getProducts();
        })
        .catch(error => {
          console.error('Error deleting product:', error);
        });
    },

    getProducts() {
      axios.get('api/getProducts')
        .then(response => {
          this.desserts = response.data;
        })
        .catch(error => {
          console.error('Error fetching products:', error);
        });
    },

    // ... (other methods if needed) ...

  },
};
</script>

<style scoped>
/* ... (existing styles) ... */
</style>
