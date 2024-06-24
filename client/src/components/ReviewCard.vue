<template>
    <div class="review-card">
      <div class="review-info">
        <h2>{{ review.activityTitle }}</h2>
        <p>{{ review.description }}</p>
        <div class="rating">
          <svg v-for="n in 5" :key="n" class="w-4 h-4" :class="n <= review.rating ? 'text-yellow-300' : 'text-gray-300 dark:text-gray-500'" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
          </svg>
        </div>
      </div>
      <button @click="deleteReview" class="btn-delete text-orange-700">
        <box-icon type='solid' name='x-circle'></box-icon>
      </button>
      <button @click="openUpdateModal" class="btn-update">
        <box-icon name='pencil'></box-icon>
      </button>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      review: {
        type: Object,
        required: true
      }
    },
    methods: {
      deleteReview() {
        this.$emit('delete-review', this.review.id);
      },
      openUpdateModal() {
        this.$emit('update-review', this.review);
      }
    }
  }
  </script>
  
  <style scoped>
  .review-card {
    border: 1px solid #ddd;
    border-radius: 30px;
    padding: 32px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 32px;
    background-color: #f3f4f6;
    text-align: center;
    width: 200px;
    flex: 0 0 auto;
    position: relative;
  }
  
  .review-info {
    margin-bottom: 16px;
  }
  
  .rating {
    display: flex;
  }
  
  .btn-delete, .btn-update {
    background: none;
    border: none;
    cursor: pointer;
  }
  </style>
  