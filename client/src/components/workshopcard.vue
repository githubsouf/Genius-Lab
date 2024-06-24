<template>
  <div class="card" v-if="workshop" @click="navigateToDetail(workshop)">
    <div class="card-image">
      <div class="card-tag">Special offer</div>
      <img :src="randomThumbnail" alt="Workshop Thumbnail">
    </div>
    <div class="card-content">
      <div class="card-header">
        <h5 class="card-title">{{ workshop.titre }}</h5>
        <div class="card-price">
          <span class="original-price">{{ originalPrice }}.00 MAD</span>
          <!-- <span class="discounted-price">{{ discountedPrice }} MAD</span> -->
        </div>
      </div>
      <div class="separator-line"></div>
      <!-- <div class="card-subtitle">{{ workshop.type_activite }}</div> -->
      <!-- <div class="card-description">{{ workshop.description }}</div> -->
      <div class="card-dates items-center">
        <span class="start-date">{{ startDate }} {{ startTime }}</span> - 
        <span class="end-date">{{ endDate }} {{ endTime }}</span>
      </div>
      <div class="separator-line"></div>

      <div>
        <div class="review ">
          <p>Score {{ averageRating }}/5</p>
          <div class="stars">
            <svg v-for="n in 5" :key="n" class="w-4 h-4" :class="n <= averageRating ? 'text-yellow-300' : 'text-gray-300'" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
              <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const props = defineProps({
  workshop: Object
});

const router = useRouter();
const duration = ref(0);
const startDate = ref('');
const startTime = ref('');
const endDate = ref('');
const endTime = ref('');
const averageRating = ref(0);
const originalPrice = ref(0);
const discountedPrice = ref(0);
const randomThumbnail = ref('');

let thumbnails = [
  'src/assets/workshop_images/math.jpg',
  'src/assets/workshop_images/others.avif',
  'src/assets/workshop_images/programming.jpg',
  'src/assets/workshop_images/s.jpg',
  'src/assets/workshop_images/a.jpg',
  'src/assets/workshop_images/sports.avif',
];

const getRandomThumbnail = () => {
  if (thumbnails.length === 0) return '';
  const randomIndex = Math.floor(Math.random() * thumbnails.length);
  const selectedThumbnail = thumbnails[randomIndex];
  thumbnails = thumbnails.filter((_, index) => index !== randomIndex);
  return selectedThumbnail;
};

const navigateToDetail = (workshop) => {
  if (workshop && workshop.id) {
    router.push(`/activities/${workshop.id}`);
  } else {
    console.error('Workshop ID not found');
  }
};

const fetchDurationAndDates = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/activites/${props.workshop.id}/horaires`);
    const horaires = response.data;
    duration.value = horaires.reduce((total, horaire) => {
      const start = new Date(`1970-01-01T${horaire.heure_debut}`);
      const end = new Date(`1970-01-01T${horaire.heure_fin}`);
      return total + (end - start) / 3600000; // Convert milliseconds to hours
    }, 0);

    if (horaires.length > 0) {
      startDate.value = horaires[0].jour;
      startTime.value = horaires[0].heure_debut;
      endDate.value = horaires[horaires.length - 1].jour;
      endTime.value = horaires[horaires.length - 1].heure_fin;
    }
  } catch (error) {
    console.error('Error fetching duration and dates', error);
  }
};

const fetchReviews = async (workshopId) => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/parentals/${props.workshop.administrateur_id}/activites/${workshopId}/reviews`
    );
    const reviews = response.data;
    if (reviews.length > 0) {
      const totalRating = reviews.reduce((sum, review) => sum + review.rating, 0);
      averageRating.value = (totalRating / reviews.length).toFixed(1);
    }
  } catch (error) {
    console.error("Failed to fetch reviews:", error);
  }
};

onMounted(() => {
  fetchDurationAndDates();
  fetchReviews(props.workshop.id);
  originalPrice.value = props.workshop.prix || 0;
  discountedPrice.value = props.workshop.discountedPrice || originalPrice.value;
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
}

.card:hover {
  transform: scale(1.05);
}

.card-image {
  position: relative;
}

.card-image img {
  width: 100%;
  height: 250px;
  object-fit: cover;
}

.card-tag {
  position: absolute;
  top: 10px;
  right: 10px;
  background-color: rgb(244, 244, 185);
  color: black;
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

.original-price {
  color: rgb(26, 222, 16);
  font-size: 1.2rem;
  font-weight: bold;
}

.separator-line {
  border-top: 1px solid lightgray;
  margin: 1rem 0;
}

.card-subtitle {
  color: gray;
  font-size: 1.1rem;
  margin: 0.5rem 0;
}

.card-description {
  color: #333;
  font-size: 1rem;
  margin: 0.5rem 0;
}

.card-dates {
  display: flex;
  justify-content: center;
  font-size: 1rem;
  color: gray;
  margin: 0.5rem 0;
}

.card-footer {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.review {
  display: flex;
  align-items: center;
  flex-direction: column;
}

.stars {
  display: flex;
  flex-direction: row;
}
</style>
