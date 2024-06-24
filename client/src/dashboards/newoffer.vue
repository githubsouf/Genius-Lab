<template>
  <div>
    <navigation />

    <div class="min-h-screen flex flex-col items-center bg-orange-50 p-5">
      <div class="flex justify-center items-start space-x-10">
        <!-- Create Offer Form -->
        <div class="card-container p-8 bg-white shadow-md rounded-lg max-w-lg w-full" data-aos="zoom-in-down">
          <h2 class="text-2xl font-semibold mb-4 text-center">Create a New Offer</h2>
          <form @submit.prevent="submitOffer">
            <!-- Title -->
            <div class="mb-4 text-center">
              <label for="offer-titre" class="block mb-2 font-semibold text-lg">What is the title</label>
              <input v-model="newOffer.titre" type="text" id="offer-titre" class="w-full p-3 border border-gray-300 rounded-lg" required />
              <p v-if="errors.titre" class="text-red-500">{{ errors.titre[0] }}</p>
            </div>
            <!-- Start Date -->
            <div class="mb-4 text-center">
              <label for="start-date" class="block mb-2 font-semibold text-lg">Start Date</label>
              <input v-model="newOffer.date_debut" type="datetime-local" id="start-date" class="w-full p-3 border border-gray-300 rounded-lg" required />
              <p v-if="errors.date_debut" class="text-red-500">{{ errors.date_debut[0] }}</p>
            </div>
            <!-- End Date -->
            <div class="mb-4 text-center">
              <label for="end-date" class="block mb-2 font-semibold text-lg">End Date</label>
              <input v-model="newOffer.date_fin" type="datetime-local" id="end-date" class="w-full p-3 border border-gray-300 rounded-lg" required />
              <p v-if="errors.date_fin" class="text-red-500">{{ errors.date_fin[0] }}</p>
            </div>
            <!-- Description -->
            <div class="mb-4 text-center">
              <label for="description" class="block mb-2 font-semibold text-lg">Description</label>
              <textarea v-model="newOffer.description" id="description" class="w-full p-3 border border-gray-300 rounded-lg" rows="5" required></textarea>
              <p v-if="errors.description" class="text-red-500">{{ errors.description[0] }}</p>
            </div>
            <!-- Image Upload -->
            <div class="mb-4 text-center">
              <label class="block mb-2 font-semibold text-lg">Drop your images here or browse</label>
              <div class="image-upload border-2 border-dashed border-black p-10 flex justify-center items-center rounded-lg">
                <input type="file" @change="handleFileUpload" class="hidden" ref="fileInput" />
                <div @click="triggerFileInput" class="cursor-pointer flex flex-col items-center">
                  <box-icon name='images' size='3rem'></box-icon>
                  <span class="mt-2">Drop your images here or browse</span>
                </div>
              </div>
            </div>
            <!-- Description -->
            <div class="mb-4 text-center">
              <label for="remise" class="block mb-2 font-semibold text-lg">Remise</label>
              <textarea v-model="newOffer.remise" id="remise" class="w-full p-3 border border-gray-300 rounded-lg" rows="5" required></textarea>
              <p v-if="errors.remise" class="text-red-500">{{ errors.remise[0] }}</p>
            </div>
            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="px-6 py-3 text-white bg-green-500 rounded-lg hover:bg-green-600">Submit</button>
            </div>
          </form>
        </div>

        <!-- Add Activities to Offer -->
        <div class="card-container p-8 bg-white shadow-md rounded-lg max-w-lg w-full" data-aos="zoom-in-down">
          <h2 class="text-2xl font-semibold mb-4 text-center">Add New Workshop to Offer</h2>
          <form @submit.prevent="addActivitiesToOffer">
            <!-- Select Offer -->
            <div class="mb-4 text-center">
              <label class="block mb-2 font-semibold text-lg">Select Offer</label>
              <select v-model="selectedOffer" class="w-full p-3 border border-gray-300 rounded-lg">
                <option v-for="offer in offers" :key="offer.id" :value="offer.id">{{ offer.titre }}</option>
              </select>
            </div>
            <!-- Select Workshops -->
            <div class="mb-4 text-center">
              <label class="block mb-2 font-semibold text-lg">Select Workshops</label>
              <div class="flex flex-col space-y-2">
                <div v-for="workshop in workshops" :key="workshop.id" class="p-4 border border-gray-300 rounded-lg flex items-center space-x-4">
                  <input type="checkbox" :value="workshop.id" v-model="selectedWorkshops" class="form-checkbox h-5 w-5 text-blue-600">
                  <div>
                    <p class="font-semibold">{{ workshop.nom }}</p>
                    <p class="text-gray-600">{{ workshop.titre }}</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="px-6 py-3 text-white bg-green-500 rounded-lg hover:bg-green-600">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <foooter />
    <Caalendar/>
  </div>
</template>

<script>
import Caalendar from './Calendar.vue';
import 'boxicons';
import axios from 'axios';
import navigation from '@/components/navigation.vue';
import foooter from '../components/foooter.vue';

export default {
  components: { navigation, foooter },
  data() {
    return {
      newOffer: {
        titre: '',
        date_debut: '',
        date_fin: '',
        description: '',
        remise: null,
      },
      offers: [],
      workshops: [],
      selectedOffer: null,
      selectedWorkshops: [],
      image: null,
      errors: {},
    };
  },
  mounted() {
    this.fetchOffers();
    this.fetchWorkshops();
  },
  methods: {
    async fetchOffers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/offres');
        this.offers = response.data;
      } catch (error) {
        console.error('Error fetching offers:', error);
      }
    },
    async fetchWorkshops() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/activites');
        this.workshops = response.data;
      } catch (error) {
        console.error('Error fetching workshops:', error);
      }
    },
    triggerFileInput() {
      this.$refs.fileInput.click();
    },
    handleFileUpload(event) {
      this.image = event.target.files[0];
    },
    formatDateTime(date) {
      const d = new Date(date);
      const year = d.getFullYear();
      const month = (`0${d.getMonth() + 1}`).slice(-2);
      const day = (`0${d.getDate()}`).slice(-2);
      const hours = (`0${d.getHours()}`).slice(-2);
      const minutes = (`0${d.getMinutes()}`).slice(-2);
      return `${year}-${month}-${day} ${hours}:${minutes}`;
    },
    async submitOffer() {
      const token = this.$store.getters.token;
      const axiosInstance = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/',
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      // Format dates correctly
      this.newOffer.date_debut = this.formatDateTime(this.newOffer.date_debut);
      this.newOffer.date_fin = this.formatDateTime(this.newOffer.date_fin);

      try {
        // First, create the new offer
        const offerResponse = await axiosInstance.post('offres', this.newOffer);
        const offerId = offerResponse.data.id;

        this.showNotificationMessage('Offer Added', 'The offer was added successfully.');
      } catch (error) {
        console.error('Error submitting offer:', error);
        if (error.response) {
          this.errors = error.response.data.errors || {};
          console.error('Response data:', error.response.data);
        }
      }
    },
    async addActivitiesToOffer() {
      const token = this.$store.getters.token;
      const axiosInstance = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/',
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      try {
        const offerId = this.selectedOffer;

        // Loop through each selected workshop and associate it with the selected offer
        const promises = this.selectedWorkshops.map(workshopId => {
          return axiosInstance.post(`offres/${offerId}/activites`, { activite_id: workshopId });
        });

        // Await all promises
        await Promise.all(promises);

        this.showNotificationMessage('Activities Added', 'Activities were added to the offer successfully.');
      } catch (error) {
        console.error('Error adding activities to offer:', error);
        if (error.response) {
          console.error('Response data:', error.response.data);
        }
      }
    },
    showNotificationMessage(title, message) {
      // Implement a notification system here if desired
      alert(`${title}: ${message}`);
    },
  },
};
</script>

<style scoped>
body {
  font-family: 'Arial', sans-serif;
}

nav {
  background-color: #fff;
  border-bottom: 1px solid #eaeaea;
}

.card-container {
  background-color: #fff;
  border: 2px dashed black;
  border-radius: 30px;
}

label {
  display: block;
  font-size: 16px;
  margin-bottom: 5px;
}

input, select, textarea {
  width: calc(100% - 20px);
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #4caf50;
  color: white;
  text-align: center;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.form-container {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.image-upload {
  height: 200px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.bg-orange-50 {
  background-color: #FFF8E1;
}
</style>
