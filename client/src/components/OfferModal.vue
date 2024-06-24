<template>
    <transition name="slide-up">
      <div v-if="show" class="modal-overlay" @click.self="closeModal">
        <div class="modal-content">
          <button class="close-button" @click="closeModal">×</button>
          <div class="offer-details">
            <div class="offer-remise">{{ offer.remise }}% OFF</div>
            <h1 class="offer-title">{{ offer.titre }}</h1>
            <router-link to="/offers" class="view-offers-button">View Offers</router-link>
          </div>
        </div>
      </div>
    </transition>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const props = defineProps({
    offer: Object,
    show: Boolean
  });
  
  const emit = defineEmits(['close']);
  
  const closeModal = () => {
    emit('close');
  };
  </script>
  
  <style scoped>
  .modal-overlay {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: flex-end;
    justify-content: center;
  }
  
  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 15px 15px 0 0;
    width: 100%;
    max-width: 500px;
    position: relative;
    text-align: center;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
  }
  
  .offer-details {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .offer-remise {
    font-size: 2rem;
    color: red;
    margin-bottom: 10px;
  }
  
  .offer-title {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
  }
  
  .view-offers-button {
    padding: 10px 20px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.2rem;
  }
  
  .view-offers-button:hover {
    background-color: #555;
  }
  
  /* Slide-up transition */
  .slide-up-enter-active,
  .slide-up-leave-active {
    transition: all 0.5s ease;
  }
  
  .slide-up-enter, .slide-up-leave-to {
    transform: translateY(100%);
    opacity: 0;
  }
  </style>
  