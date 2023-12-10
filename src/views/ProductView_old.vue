add style on this <template>
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
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Quantity Modal -->
    <v-dialog v-model="quantityModal" max-width="400">
      <v-card>
        <v-card-title>Add Quantity</v-card-title>
        <v-card-text>
          <!-- Your quantity input field and other necessary fields go here -->
          <v-text-field v-model="quantityToAdd" label="Quantity"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="addQuantity">Add</v-btn>
          <v-btn @click="closeQuantityModal">Close</v-btn>
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
      selectedProduct: null,
      quantityToAdd: 0,
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
    async addQuantity() {
      const updatedProduct = { ...this.selectedProduct };
      updatedProduct.quantity += parseInt(this.quantityToAdd);
      await axios.post('api/updateQuantity', {
        upc: updatedProduct.upc,
        quantity: this.quantityToAdd,
      });
      const index = this.desserts.findIndex((product) => product.upc === updatedProduct.upc);
      this.getProducts();
      this.closeQuantityModal();
    },
    async getProducts() {
      const data = await axios.get('api/getProducts');
      this.desserts = data.data;
    },
  },
};
</script>
<style scoped>
.styled-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.styled-table th, .styled-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.styled-table th {
  background-color: #f2f2f2;
}

.styled-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.styled-table tbody tr:hover {
  background-color: #f5f5f5;
}
</style>
