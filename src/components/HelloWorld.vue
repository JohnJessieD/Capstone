<template>
  <v-app>
    <!-- Navigation Drawer -->
    <v-navigation-drawer app v-model="drawer">
  <v-list dense>
    <v-list-item-group>
      <v-list-item>
  <v-list-item-icon>
    <v-icon>mdi-account</v-icon>
  </v-list-item-icon>
  <v-list-item-title>
    <router-link to="/UserProfile">User Profile</router-link>
  </v-list-item-title>
</v-list-item>
      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-information</v-icon>
        </v-list-item-icon>
        <v-list-item-title>
          <router-link to="/about">About</router-link>
        </v-list-item-title>
      </v-list-item>
      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-login</v-icon>
        </v-list-item-icon>
        <v-list-item-title>
          <router-link to="/login">Login</router-link>
        </v-list-item-title>
      </v-list-item>
      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-account-plus</v-icon>
        </v-list-item-icon>
        <v-list-item-title>
          <router-link to="/register">Register</router-link>
        </v-list-item-title>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</v-navigation-drawer>
<v-app-bar app class="custom-navbar" color="primary">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Malay Dynastea</v-toolbar-title>
      <v-btn @click="$router.push('/BestProducts')">BestProducts</v-btn> 
      <v-btn @click="$router.push('/shopping-cart')">Shopping Cart</v-btn>
      <v-btn @click="$router.push('/OrderHistory')">Order History</v-btn>
    </v-app-bar>
    <v-main>
      <div class="ecommerce-container">
        <div class="product-list">
          <h2>Products</h2>
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
                <v-btn @click="addToCart(product)" color="primary">Add to Cart</v-btn>
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
    </v-main>


    <!-- Add to Cart Modal -->
     <!-- Add to Cart Modal -->
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
</v-app>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: '',
    searchResults: [],
      showModal: false,
      selectedProduct: {},
      quantity: 1,
      cart: [], 
      drawer: false,
      products: [
      {
        id: 1,
        name: 'Classic Milk Tea',
        description: 'Our signature classic milk tea with rich flavor.',
        price: 4.99,
        image: 'classic-milk-tea.jpg',
        category: 'Milk Tea',
      },
      {id: 2,
        name: 'Almond Milk Tea',
        description: 'Rich almond-flavored milk tea with boba pearls.',
        price: 6.99,
        image: 'almond-milk-tea.jpg',
        category: 'Milk Tea',},
      {
        id: 3,
        name: 'Taro Milk Tea',
        description: 'Creamy taro-flavored milk tea with tapioca pearls.',
        price: 5.99,
        image: 'taro-milk-tea.jpg',
        category: 'Milk Tea',
      },
      {
        id: 4,
        name: 'Matcha Green Tea Latte',
        description: 'Delicious matcha green tea latte with foamy top.',
        price: 6.49,
        image: 'matcha-latte.jpg',
        category: 'Milk Tea',
      },
      {
        id: 5,
        name: 'Honeydew Milk Tea',
        description: 'Refreshing honeydew milk tea with a twist.',
        price: 5.49,
        image: 'honeydew-milk-tea.jpg',
        category: 'Milk Tea',
      },
      {
        id: 6,
        name: 'Strawberry Milk Tea',
        description: 'Sweet strawberry-flavored milk tea with boba pearls.',
        price: 6.99,
        image: 'strawberry-milk-tea.jpg',
        category: 'Milk Tea',
      },
      {
        id: 7,
        name: 'Bibimbap',
        description: 'Korean mixed rice with vegetables and meat.',
        price: 8.99,
        image: 'bibimbap.jpg',
        category: 'Korean Food',
      },
      {
        id: 8,
        name: 'Kimchi Fried Rice',
        description: 'Spicy fried rice with Kimchi and pork.',
        price: 7.99,
        image: 'kimchi-fried-rice.jpg',
        category: 'Korean Food',
      },
      {
        id: 9,
        name: 'Korean BBQ Ribs',
        description: 'Tender grilled pork ribs marinated in Korean BBQ sauce.',
        price: 11.99,
        image: 'korean-bbq-ribs.jpg',
        category: 'Korean Food',
      },
      // Add one more milk tea and one more Korean food product
      {
        id: 10,
        name: 'Peach Milk Tea',
        description: 'Sweet peach-flavored milk tea with boba pearls.',
        price: 7.49,
        image: 'peach-milk-tea.jpg',
        category: 'Milk Tea',
      },
      {
        id: 11,
        name: 'Japchae',
        description: 'Stir-fried glass noodles with vegetables and beef.',
        price: 9.99,
        image: 'japchae.jpg',
        category: 'Korean Food',
      },
      {
        id: 11,
        name: 'Hotteok',
        description: 'Korean sweet pancakes filled with brown sugar and nuts.',
        price: 4.99,
        image: 'hotteok.jpg',
        category: 'Korean Food',
      },
  
        // Add more milk tea and Korean food products
      ],
      categories: [
        { id: 1, name: 'Milk Tea' },
        { id: 2, name: 'Korean Food' },
  

      ],
    };
  },
  methods: {
    
    addToCart(product) {
      // Implement cart logic (e.g., add the product to the cart)
    },
    filterProducts(category) {
      // Implement filter logic (e.g., display products from the selected category)
   },
   openModal(product) {
      this.selectedProduct = product;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.selectedProduct = {};
      this.quantity = 1;
    },
    addToCartAndCloseModal() {
      // Check if the product is already in the cart
      const cartItemIndex = this.cart.findIndex(
        (item) => item.product.id === this.selectedProduct.id
      );

      if (cartItemIndex !== -1) {
        // If the product is in the cart, update the quantity
        this.cart[cartItemIndex].quantity += this.quantity;
      } else {
        // If the product is not in the cart, add it with the chosen quantity
        this.cart.push({
          product: this.selectedProduct,
          quantity: this.quantity,
        });
      }

      // Close the modal
      this.closeModal();
    },
    removeItemFromCart(index) {
      this.cart.splice(index, 1);
    },
  },
};
</script>
<style scoped>
.ecommerce-container {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  margin: 20px;
  background-image: url('https://i.pinimg.com/564x/2e/e5/37/2ee537a4ac153415c82841ad85e1940a.jpg');
  background-size: cover;
  background-position: center;
  min-height: 80vh; /* Adjusted container height */
  background-color: #add8e6; 
}
.custom-navbar {
  background: linear-gradient(to right, #8B4513, #D2B48C); /* Gradient background */
  /* You can customize the colors and background properties as needed */
}
.product-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  gap: 10px;
}

/* Add a custom style for the navigation link color */

.product-card {
  width: calc(33.33% - 20px);
  margin-bottom: 20px;
  background-color: rgba(255, 255, 255, 0.8);
  border: 1px solid #ddd;
  border-radius: 8px; /* Adjusted border-radius */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  height: 350px; /* Adjusted card height */
}

.product-card-inner {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.product-image {
  max-width: 100%;
  border-top-left-radius: 8px; /* Adjusted border-radius */
  border-top-right-radius: 8px; /* Adjusted border-radius */
}

.product-details {
  flex: 1;
  padding: 10px;
  display: flex;
  flex-direction: column;
}

.product-category {
  margin-top: auto;
}

.category-label {
  padding: 4px 8px;
  background-color: #ffca28;
  color: #333;
  border-radius: 3px;
  font-weight: bold;
}

/* Style for the modal */
.v-dialog__content {
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 10px;
}

.v-card {
  border-radius: 8px;
}

.v-card-title {
  background-color: #2196F3;
  color: #fff;
  border-top-left-radius: 8px; /* Adjusted border-radius */
  border-top-right-radius: 8px; /* Adjusted border-radius */
}

@media (max-width: 768px) {
  .product-card {
    width: calc(33.33% - 20px); /* Adjusted card width for smaller screens */
  }
}

@media (max-width: 480px) {
  .product-card {
    width: calc(50% - 20px); /* Adjusted card width for smaller screens */
  }
}
</style>