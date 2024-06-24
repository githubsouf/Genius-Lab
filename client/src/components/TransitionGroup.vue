<script setup>
import axios from 'axios';
import WorkshopCard from './workshopcard.vue';
import { ref, computed, onMounted } from 'vue';

const filtersVisible = ref(false);
const query = ref('');
const searchQuery = ref('');
const workshops = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/activites');
    workshops.value = response.data;
  } catch (error) {
    console.error('Failed to fetch workshops:', error);
  }
});

const filteredWorkshops = computed(() => {
  const filtered = workshops.value.filter(workshop => JSON.stringify(workshop).includes(query.value));
  if (searchQuery.value) {
    return filtered.filter(workshop => JSON.stringify(workshop).toLowerCase().includes(searchQuery.value.toLowerCase()));
  }
  return query.value ? filtered : workshops.value;
});
</script>

<template>
  <main>
    <header>
      <div class="header-flex">
        <h1>Workshop Grid</h1>
        <button @click="filtersVisible = !filtersVisible">
          {{ filtersVisible ? 'Hide Filters' : 'Show Filters' }}
        </button>
      </div>

      <transition>
        <div v-show="filtersVisible" class="header-filters">
          <input type="search" v-model="searchQuery" placeholder="Search Workshops">
          <div class="button-group">
            <button @click="query = ''" :class="{ active: query === '' }">Clear Filters</button>
            <button @click="query = 'Math'" :class="{ active: query === 'math' }">math</button>
            <button @click="query = 'physics'" :class="{ active: query === 'physics' }">physics</button>
            <button @click="query = 'AI'" :class="{ active: query === 'AI' }">AI</button>
            <button @click="query = 'Robotics'" :class="{ active: query === 'Robotics' }">Robotics</button>
            <button @click="query = 'Sport'" :class="{ active: query === 'Sport' }">Sport</button>
            <button @click="query = 'Adventure'" :class="{ active: query === 'Adventure' }">Adventure</button>
            <button @click="query = 'Games'" :class="{ active: query === 'Games' }">Games</button>
          </div>
        </div>
      </transition>
    </header>
    <div class="movie-grid -ml-40 mt-20">
      <transition-group name="list">
        <WorkshopCard v-for="workshop in filteredWorkshops" :key="workshop.id" :workshop="workshop" />
      </transition-group>
    </div>
  </main>
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

.movie-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 3rem 2rem;
}

@media screen and (max-width: 1024px) {
  .movie-grid {
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
