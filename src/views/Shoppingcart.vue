<template>
  <div class="shopping-cart">
    <h2>Shopping Cart</h2>
    <div v-if="cartItems.length === 0" class="empty-cart-message">
      Your shopping cart is empty.
    </div>
    <div v-else>
      <div v-for="item in cartItems" :key="item.id" class="cart-item">
        <!-- Display cart items here -->
        <div class="item-details">
          <div class="item-name">{{ item.name }}</div>
          <div class="item-quantity">Quantity: {{ item.quantity }}</div>
          <div class="item-price">Price: ${{ item.price }}</div>
        </div>
        <button @click="removeFromCart(item)" class="remove-button">Remove</button>
      </div>
    </div>
    <div v-if="cartItems.length > 0" class="cart-summary">
      <div class="total-price">Total Price: ${{ calculateTotalPrice() }}</div>
      <button @click="checkout" class="checkout-button">Checkout</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cartItems: [], // Initialize as an empty array
    };
  },
  methods: {
    removeFromCart(item) {
      // Implement logic to remove the item from the cart
      const index = this.cartItems.findIndex(cartItem => cartItem.id === item.id);
      if (index !== -1) {
        this.cartItems.splice(index, 1);
      }
    },
    calculateTotalPrice() {
      // Implement logic to calculate the total price of items in the cart
      return this.cartItems.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2);
    },
    checkout() {
      // Implement checkout logic (For example: redirect to a checkout page)
      alert('Checkout functionality to be implemented!');
    },
  },
};
</script>
<style scoped>
.shopping-cart {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
}

.empty-cart-message {
  font-size: 18px;
  text-align: center;
  color: #888;
}

.cart-item {
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid #eee;
  padding: 10px 0;
  margin-bottom: 10px;
}

.item-details {
  flex-grow: 1;
}

.item-name {
  font-size: 16px;
  font-weight: bold;
}

.remove-button {
  background-color: #dc3545;
  color: #fff;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
}

.cart-summary {
  margin-top: 20px;
}

.total-price {
  font-size: 18px;
  font-weight: bold;
}

.checkout-button {
  background-color: #28a745;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 4px;
  cursor: pointer;
}
</style> 