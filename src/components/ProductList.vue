<template>
    <div>
      <h1>Product List</h1>
      <v-data-table :items="products" :headers="headers"></v-data-table>
      <!-- Add buttons and forms for managing products -->
    </div>
  </template>
  
  <script>
  export default {
    name: 'ProductListView',
    data() {
      return {
        products: [
          { id: 1, name: 'Milk Tea 1', price: 4.99 },
          { id: 2, name: 'Milk Tea 2', price: 5.99 },
          // Add more product data
        ],
        headers: [
          { text: 'ID', value: 'id' },
          { text: 'Name', value: 'name' },
          { text: 'Price', value: 'price' },
          // Add more headers as needed
        ],
      };
    },
  };
  </script>
  