<template>
    <div>
      <b-modal v-if="visible" title="Addons" @hide="closeModal">
        <div class="message-container">
          <ul>
            <li v-for="addon in addons" :key="addon.id" class="message">
              <h3>{{ addon.name }}</h3>
              <p>{{ addon.description }}</p>
              <p>Price: ${{ addon.price }}</p>
              <label>
                <input type="checkbox" v-model="addon.selected">
                Select
              </label>
            </li>
          </ul>
        </div>
        <div class="button-container">
          <b-button @click="submitOrder">Submit Order</b-button>
          <b-button @click="closeModal">Close Addons</b-button>
        </div>
      </b-modal>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: {
      visible: Boolean,
    },
    data() {
      return {
        addons: [],
      };
    },
    watch: {
      visible(newVal) {
        if (newVal) {
          this.fetchAddons();
        }
      },
    },
    methods: {
      async fetchAddons() {
        try {
          const response = await axios.get('/api/addons');
          // Add a 'selected' property to each addon
          this.addons = response.data.map(addon => ({ ...addon, selected: false }));
        } catch (error) {
          console.error('Error fetching addons:', error);
        }
      },
      closeModal() {
        this.$emit('close');
      },
      async submitOrder() {
        const selectedAddons = this.addons.filter(addon => addon.selected);
  
        // Check if there are selected addons
        if (selectedAddons.length === 0) {
          alert('Please select at least one addon before submitting the order.');
          return;
        }
  
        // You can customize this confirmation dialog based on your needs
        const isConfirmed = window.confirm('Are you sure you want to submit the order with the selected addons?');
  
        if (!isConfirmed) {
          return;
        }
  
        try {
          const response = await axios.post('/api/submitOrder', {
            addons: selectedAddons,
            // Add other necessary data for the order here
          });
  
          console.log(response.data.message);
  
          // Optionally emit an event to notify the parent component
          this.$emit('orderSubmitted', response.data);
  
          // Close the modal after submitting the order
          this.closeModal();
        } catch (error) {
          console.error('Error submitting order:', error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .message-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .message {
    margin-bottom: 16px;
    border: 1px solid #ddd;
    padding: 16px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 80%; /* Adjust the width as needed */
  }
  
  ul {
    list-style-type: none;
    padding: 0;
  }
  
  .button-container {
    display: flex;
    justify-content: space-around;
    margin-top: 16px;
  }
  </style>
  