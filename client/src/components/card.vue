<template>
  <div v-if="visibleWorkshops.length > 0" class="  gap-2 ">
    <div v-for="workshop in visibleWorkshops" :key="workshop.id" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
      <a :href="'#workshop/' + workshop.id">
        <img class="rounded-t-lg" :src="workshop.imageUrl" alt="" />
      </a>
      <div class="p-5">
        <a :href="'#workshop/' + workshop.id">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ workshop.title }}</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ workshop.description }}</p>
        
        <RouterLink
          :to="'/WorkshopID' + workshop.id + 'page'"
          class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button"
        >
          Read more
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
          </svg>
        </RouterLink>
      </div>
    </div>
  </div>
  <div v-else>Loading workshops...</div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted, computed } from 'vue';

export default {
  setup() {
    const workshops = ref([]);

    const fetchWorkshops = async () => {
      try {
        const response = await axios.get('/api/activites');
        workshops.value = response.data;
      } catch (error) {
        console.error('Error fetching workshops:', error);
      }
    };

    onMounted(fetchWorkshops);

    // Computed property to limit workshops to 10
    const visibleWorkshops = computed(() => {
      return workshops.value.slice(0,10);
    });

    return {
      visibleWorkshops,
    };
  },
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>
