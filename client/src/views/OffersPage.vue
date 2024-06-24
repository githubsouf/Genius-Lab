<script setup>
import navigation from "../components/navigation.vue";
import login from "../components/log-in.vue";
import loading from "../components/loadinga.vue";
import foooter from "@/components/foooter.vue";
import axios from 'axios';
import OfferCard from '../components/OfferCard.vue';
import { ref, computed, onMounted } from 'vue';

const filtersVisible = ref(false);
const query = ref('');
const searchQuery = ref('');
const offers = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/offres');
    offers.value = response.data;
  } catch (error) {
    console.error('Failed to fetch offers:', error);
  }
});

const filteredOffers = computed(() => {
  const filtered = offers.value.filter(offer => JSON.stringify(offer).includes(query.value));
  if (searchQuery.value) {
    return filtered.filter(offer => JSON.stringify(offer).toLowerCase().includes(searchQuery.value.toLowerCase()));
  }
  return query.value ? filtered : offers.value;
});
</script>

<template>
  <div class="bg-orange-50">
    <navigation @open-modal="openLoginModal" />
    <div class="page-container bg-orange-50">
      <login v-if="showLoginModal" @close-modal="closeLoginModal" />

      <section v-else class="mt-12 bg-orange-50">
        <loading v-if="isLoading" position="center" />
        <div v-else>
          
          

          <!-- Content -->
        </div>
      </section>
  <main>
    <header>
      <div class="header-flex">
        <h1>Offers Grid</h1>
        
      </div>

      <transition>
        <div  class="header-filters">
          <input type="search" v-model="searchQuery" placeholder="Search Offers">
          <div class="button-group">
           
          </div>
        </div>
      </transition>
    </header>
    <div class="offer-grid -ml-40 mt-20">
      <transition-group name="list">
        <OfferCard v-for="offer in filteredOffers" :key="offer.id" :offer="offer" />
      </transition-group>
    </div>
  </main>
</div>
  </div>
  <foooter/>
</template>

<style scoped>
main {
  text-align: center;
  max-width: 1100px;
  align-items: center;
  margin: 0 auto;
  position: relative;
}

header {
  margin-bottom: 2rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.header-flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.header-filters {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

input {
  height: 50px;
  border-radius: 6px;
  border: 1px solid rgba(2, 28, 62, .1);
  font-size: 1rem;
  padding: 0 1rem;
}

.button-group {
  display: -webkit-box;
  max-width: 100%;
  overflow: auto;
}

button {
  font-size: 1rem;
  height: 40px;
  display: grid;
  place-items: center;
  margin-right: 0.4rem;
  padding: 0 1rem;
  border: 1px solid #b100ec;
  border-radius: 6px;
  color: #54009d;
  background: #fffbf4;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}

button.active {
  background: #a805e3;
  color: #fffbf4;
}

h1 {
  font-weight: 700;
}

.offer-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 3rem 2rem;
}

@media screen and (max-width: 1024px) {
  .offer-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* TRANSITION CLASS NAMES - DEFAULT */
.v-move,
.v-enter-active,
.v-leave-active {
  transition: 0.3s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

/* TRANSITION GROUP CLASS NAMES - LIST */
.list-move,
.list-enter-active,
.list-leave-active {
  transition: 0.3s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

/* ADDING SOME STYLES TO THE EXIT TRANSITION CLASS CAN MAKE THE ANIMATION A LOT SMOOTHER */
.list-leave-active {
  position: absolute;
  right: 0;
  left: 0;
}
</style>
