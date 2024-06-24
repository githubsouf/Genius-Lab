<template>
    <div class="review-form bg-white p-4 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold mb-4">Add a Review</h2>
      <form @submit.prevent="submitReview">
        <div class="mb-4">
          <label for="review-description" class="block mb-2">Your Review</label>
          <textarea
            v-model="reviewDescription"
            id="review-description"
            class="w-full p-2 border border-gray-300 rounded"
            required
          ></textarea>
        </div>
        <div class="mb-4">
          <label for="review-rating" class="block mb-2">Rating</label>
          <select
            v-model="reviewRating"
            id="review-rating"
            class="w-full p-2 border border-gray-300 rounded"
            required
          >
            <option v-for="n in 5" :key="n" :value="n">{{ n }} Star(s)</option>
          </select>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Submit Review
        </button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useStore } from 'vuex';
  import axios from 'axios';
  
  const store = useStore();
  const reviewDescription = ref('');
  const reviewRating = ref(1);
  
  const submitReview = async () => {
    const parentId = store.getters.parentId;
    const workshopId = 1; // Replace with the actual workshop ID
  
    if (!parentId) {
      alert('You must be a parent to submit a review.');
      return;
    }
  
    try {
      await axios.post(`http://127.0.0.1:8000/api/parentals/${parentId}/activites/${workshopId}/reviews`, {
        description: reviewDescription.value,
        rating: reviewRating.value,
      }, {
        headers: {
          Authorization: `Bearer ${store.getters.token}`
        }
      });
  
      reviewDescription.value = '';
      reviewRating.value = 1;
      alert('Review submitted successfully!');
    } catch (error) {
      console.error('Failed to submit review:', error);
      alert('Failed to submit review');
    }
  };
  </script>
  
  <style scoped>
  .review-form {
    margin-bottom: 2rem;
  }
  </style>
  