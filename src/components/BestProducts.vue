<template>
  <v-container class="page-container">

    <v-row class="best-products">
      <v-col v-for="product in bestMilkTeaProducts" :key="product.id" cols="12" sm="6" md="4">
        <v-card class="product-card">
         

          <v-card-title class="text-h6">{{ product.name }}</v-card-title>
          <v-card-subtitle>{{ product.description }}</v-card-subtitle>

          <v-card-actions>
            <v-btn @click="addToCart(product)" color="primary">Add to Cart</v-btn>
            <div class="product-price">$ {{ product.price }}</div>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

  
<script>

export default {
  
    data() {
      return {
        bestMilkTeaProducts: [
          {
            id: 1,
            name: 'Classic Milk Tea',
            description: 'Our signature classic milk tea with rich flavor.',
            price: 4.99,

          },
          {
            id: 2,
            name: 'Taro Milk Tea',
            description: 'Creamy taro-flavored milk tea with tapioca pearls.',
            price: 5.99,
          },
          {
            id: 3,
            name: 'Matcha Green Tea Latte',
            description: 'Delicious matcha green tea latte with foamy top.',
            price: 6.49,
         },
          {
            id: 4,
            name: 'Honeydew Milk Tea',
            description: 'Refreshing honeydew milk tea with a twist.',
            price: 5.49,

          },
          // Add more best milk tea products
        ],
      };
    }, methods: {
    addToCart(product) {

    },
    // Other methods
  },
};
</script>

<style scoped>
.best-products {
  padding: 20px;
}

.product-card {
  margin: 20px;
  padding: 10px;
  border-radius: 5px;
}

.product-image {
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.product-price {
  margin-top: 10px;
}
</style>