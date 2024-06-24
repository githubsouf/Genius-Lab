<template>
  <div>
    <navigation />

    <div class="min-h-screen flex flex-col items-center bg-orange-50 p-5">
      <div class="flex justify-center items-start space-x-10">
        <!-- Create Workshop Form -->
        <div class="card-container p-8 bg-white shadow-md rounded-lg max-w-lg w-full" data-aos="zoom-in-down">
          <h2 class="text-2xl font-semibold mb-4 text-center">Create a New Workshop</h2>
          <form @submit.prevent="submitForm">
            <!-- Title -->
            <div class="mb-4 text-center">
              <label for="workshop-titre" class="block mb-2 font-semibold text-lg">Title</label>
              <input v-model="newWorkshop.titre" type="text" id="workshop-titre" class="w-full p-3 border border-gray-300 rounded-lg" required />
            </div>
            <!-- Description -->
            <div class="mb-4 text-center">
              <label for="workshop-description" class="block mb-2 font-semibold text-lg">Description</label>
              <textarea v-model="newWorkshop.description" id="workshop-description" class="w-full p-3 border border-gray-300 rounded-lg" rows="3" required></textarea>
            </div>
            <!-- Age Range -->
            <div class="mb-4 text-center flex justify-between space-x-4">
              <div>
                <label for="age-min" class="block mb-2 font-semibold text-lg">Min Age</label>
                <input v-model.number="newWorkshop.age_min" type="number" id="age-min" class="w-full p-3 border border-gray-300 rounded-lg" required />
              </div>
              <div>
                <label for="age-max" class="block mb-2 font-semibold text-lg">Max Age</label>
                <input v-model.number="newWorkshop.age_max" type="number" id="age-max" class="w-full p-3 border border-gray-300 rounded-lg" required />
              </div>
            </div>
            <!-- Type of Activity -->
            <div class="mb-4 text-center">
              <label for="type-activite" class="block mb-2 font-semibold text-lg">Type of Activity</label>
              <input v-model="newWorkshop.type_activite" type="text" id="type-activite" class="w-full p-3 border border-gray-300 rounded-lg" required />
            </div>
            <!-- Effort Range -->
            <div class="mb-4 text-center flex justify-between space-x-4">
              <div>
                <label for="eff-min" class="block mb-2 font-semibold text-lg">Min Effort</label>
                <input v-model.number="newWorkshop.eff_min" type="number" id="eff-min" class="w-full p-3 border border-gray-300 rounded-lg" required />
              </div>
              <div>
                <label for="eff-max" class="block mb-2 font-semibold text-lg">Max Effort</label>
                <input v-model.number="newWorkshop.eff_max" type="number" id="eff-max" class="w-full p-3 border border-gray-300 rounded-lg" required />
              </div>
            </div>
            <!-- Name -->
            <div class="mb-4 text-center">
              <label for="workshop-nom" class="block mb-2 font-semibold text-lg">Name</label>
              <input v-model="newWorkshop.nom" type="text" id="workshop-nom" class="w-full p-3 border border-gray-300 rounded-lg" required />
            </div>
            <!-- Category -->
            <div class="mb-4 text-center">
              <label for="workshop-categorie" class="block mb-2 font-semibold text-lg">Category</label>
              <input v-model="newWorkshop.categorie" type="text" id="workshop-categorie" class="w-full p-3 border border-gray-300 rounded-lg" required />
            </div>
            <!-- Service -->
            <div class="mb-4 text-center">
              <label for="workshop-service" class="block mb-2 font-semibold text-lg">Service</label>
              <input v-model="newWorkshop.service" type="text" id="workshop-service" class="w-full p-3 border border-gray-300 rounded-lg" required />
            </div>
            <!-- Mode of Realization -->
            <div class="mb-4 text-center">
              <label for="mode-de-realisation" class="block mb-2 font-semibold text-lg">Mode of Realization</label>
              <select v-model="newWorkshop.mode_de_realisation" id="mode-de-realisation" class="w-full p-3 border border-gray-300 rounded-lg" required>
                <option value="Presentiel">Presentiel</option>
                <option value="En Ligne">En Ligne</option>
                <option value="hybrid">Hybrid</option>
              </select>
            </div>
            <!-- Number of Sessions -->
            <div class="mb-4 text-center">
              <label for="nbre-seance" class="block mb-2 font-semibold text-lg">Number of Sessions</label>
              <input v-model.number="newWorkshop.nbre_seance" type="number" id="nbre-seance" class="w-full p-3 border border-gray-300 rounded-lg" required />
            </div>
            <!-- Price -->
            <div class="mb-4 text-center">
              <label for="prix" class="block mb-2 font-semibold text-lg">Price</label>
              <input v-model.number="newWorkshop.prix" type="number" id="prix" class="w-full p-3 border border-gray-300 rounded-lg" required />
            </div>
            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="px-6 py-3 text-white bg-green-500 rounded-lg hover:bg-green-600">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div v-if="showAlert" class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
      <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
      </svg>
      <span class="sr-only">Info</span>
      <div>
        <span class="font-medium">Warning alert!</span> Workshop posted successfully ! 
      </div>
    </div>
    <foooter />
    
    
  </div>
</template>

<script>
import axios from 'axios';
import navigation from '@/components/navigation.vue';
import foooter from '@/components/foooter.vue';

export default {
  components: { navigation, foooter },
  data() {
    return {
      showAlert: false,
      newWorkshop: {
        titre: '',
        description: '',
        age_min: null,
        age_max: null,
        type_activite: '',
        eff_min: null,
        eff_max: null,
        nom: '',
        categorie: '',
        service: '',
        mode_de_realisation: '',
        nbre_seance: null,
        prix: null,
      },
    };
  },
  methods: {
    async submitForm() {
      console.log('User token:', this.$store.getters.token);
      console.log("Form submitted");

      const token = this.$store.getters.token;
      console.log("Form Data:", this.newWorkshop);

      const axiosInstance = axios.create({
        baseURL: 'http://127.0.0.1:8000/api/',
        headers: {
          Authorization: `Bearer ${token}`
        }
      });

      try {
        const response = await axiosInstance.post('activites', this.newWorkshop);
        console.log('Response from server:', response.data);
        this.closeModal();
        this.showNotificationMessage('Workshop Added', 'The workshop was added successfully.');
      } catch (error) {
        console.error('Error submitting form:', error);
        if (error.response) {
          console.error('Response data:', error.response.data);
        }
      } finally {
        this.showAlert = true;
        setTimeout(() => {
          this.showAlert = false;
        }, 3000);
      }
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
