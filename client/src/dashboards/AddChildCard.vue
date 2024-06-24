<template>
    <div class="add-child-card" @click="addChild">
      <button class="add-button">+</button>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      addChild() {
        this.$emit('add-child');
      }
    }
  }
  </script>
  
  <style scoped>
  .add-child-card {
    border: 1px dashed #ddd;
    border-radius: 30px; /* Rounded corners */
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 32px; /* Bottom margin for alignment */
    background-color: #f3f4f6; /* Light gray background */
    width: 200px; /* Fixed width for the card */
    height: 350px; /* Fixed height for the card */
    flex: 0 0 auto; /* Prevent card from shrinking */
    cursor: pointer;
  }
  
  .add-button {
    font-size: 48px;
    color: #888;
    background: none;
    border: none;
    cursor: pointer;
  }
  </style>
  