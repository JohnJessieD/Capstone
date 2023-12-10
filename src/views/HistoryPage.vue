<template>
  <v-card flat title="Nutrition">
    <template v-slot:text>
      <v-text-field
        v-model="search"
        label="Search"
        prepend-inner-icon="mdi-magnify"
        single-line
        variant="outlined"
        hide-details
      ></v-text-field>
    </template>

    <div>
      <table>
        <thead>
          <tr>
            <th>UPC</th>
            <th>Name</th>
            <th>Description</th>
            <th>Old Quantity</th>
            <th>Quantity</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in desserts" :key="item.upc">
            <td>{{ item.upc }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.description }}</td>
            <td>{{ item.oldQuantity }}</td>
            <td>{{ item.quantity }}</td>
            <td>{{ item.type }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </v-card>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      search: '',
      upc: null,
      auditData: null,
      desserts: [],
    };
  },

  mounted() {
    // Access the UPC parameter passed in the route
    this.upc = this.$route.params.upc;
    this.getAudit();
  },

  methods: {
    async getAudit() {
      const data = await axios.get(`api/audit/${this.upc}`);
      this.desserts = data.data;
    },
  },
};
</script>
