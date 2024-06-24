<template>
    <div class="card" v-if="offer">
      <div class="card-image">
        <div class="card-tag">Exclusive</div>
        <img :src="randomThumbnail" alt="Workshop Thumbnail">
        <div class="hover-overlay">ADD TO CART</div>
      </div>
      <div class="card-content">
        <div class="card-header">
          <h5 class="card-title">{{ offer.titre }}</h5>
          <div class="card-price">
            <span class="discount">{{ offer.remise }}% OFF</span>
          </div>
        </div>
        <div class="separator-line"></div>
        <div class="activities">
          <ul>
            <li v-for="activity in activities" :key="activity.id">{{ activity.titre }}</li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const props = defineProps({
    offer: Object
  });
  
  const activities = ref([]);
  const randomThumbnail = ref('');

const thumbnails = [
  'src/assets/offers_images/Eid Al Adha.jpg',
  'src/assets/offers_images/summer-offer.webp',
  'src/assets/offers_images/back-to-school.jpg',
];
const getRandomThumbnail = () => {
  const randomIndex = Math.floor(Math.random() * thumbnails.length);
  return thumbnails[randomIndex];
};
  
  onMounted(async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/offres/${props.offer.id}/activites`);
      activities.value = response.data;
      offerThumbnail.value = `src/assets/offer_images/${props.offer.photo}`;
    } catch (error) {
      console.error('Error fetching activities for offer', error);
    }
    randomThumbnail.value = getRandomThumbnail();
  });
  </script>
  
  <style scoped>
  .card {
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.3s;
    width: 450px;
    height: auto;
    position: relative;
  }
  
  .card:hover {
    transform: scale(1.05);
  }
  
  .card-image {
    position: relative;
  }
  
  .card-image img {
    width: 100%;
    height: 170px;
    object-fit: cover;
  }
  
  .card-tag {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: rgb(243, 7, 7);
    color: rgb(245, 239, 239);
    padding: 0.3rem 0.6rem;
    border-radius: 5px;
    font-size: 0.9rem;
  }
  
  .card-content {
    padding: 1.5rem;
  }
  
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .card-title {
    font-size: 1.4rem;
    font-weight: bold;
  }
  
  .card-price {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  }
  
  .discount {
    color: rgb(255, 0, 0);
    font-size: 1.2rem;
    font-weight: bold;
  }
  
  .separator-line {
    border-top: 1px solid lightgray;
    margin: 1rem 0;
  }
  
  .activities {
    display: flex;
    flex-direction: column;
    font-size: 1.1rem;
  }
  
  .activities ul {
    padding: 0;
    margin: 0;
    list-style-type: none;
  }
  
  .activities li {
    margin-bottom: 0.5rem;
  }
  
  .hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.8);
    opacity: 0;
    transition: opacity 0.3s;
    color: black;
    font-size: 1.5rem;
    font-weight: bold;
  }
  
  .card:hover .hover-overlay {
    opacity: 1;
  }
  </style>
  