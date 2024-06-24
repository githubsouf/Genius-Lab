<template>
    <div>
      <div class="flex items-center justify-between mb-4">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Search animateurs by name or email"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-offset-gray-800"
        />
        <button @click="clearSearch" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring focus:ring-blue-500 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">Clear</button>
      </div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="p-4">
                <div class="flex items-center">
                  <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
              </th>
              <th scope="col" class="px-6 py-3">
                user_id
              </th>
              <th scope="col" class="px-6 py-3">
                Title
              </th>
              <th scope="col" class="px-6 py-3">
                Telephone
              </th>
              <th scope="col" class="px-6 py-3">
                Photo
              </th>
              <th scope="col" class="px-6 py-3">
                Created At
              </th>
              <th scope="col" class="px-6 py-3">
                 Act
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="animateur in filteredAnimateurs" :key="animateur.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="w-4 p-4">
                <div class="flex items-center">
                  <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                </div>
              </td>
              
              <td class="px-6 py-4">
                {{ animateur.user_id }}
              </td>
              <td class="px-6 py-4">
                {{ animateur.title }}
              </td>
              <td class="px-6 py-4">
                {{ animateur.telephone }}
              </td>
              <td class="px-6 py-4">
                <img :src="animateur.photo" alt="Animateur Photo" class="w-12 h-12 rounded-full">
              </td>
              <td class="px-6 py-4">
                {{ animateur.created_at }}
              </td>
              <td class="flex items-center px-6 py-4">
                <button @click="deleteAnimateur(animateur.user_id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        animateurs: [],
        searchQuery: '',
      };
    },
    computed: {
      filteredAnimateurs() {
        return this.animateurs.filter(animateur =>
          animateur.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          animateur.telephone.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      },
    },
    created() {
      this.fetchAnimateurs();
    },
    methods: {
      async fetchAnimateurs() {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/animateurs');
          this.animateurs = response.data;
        } catch (error) {
          console.error('Error fetching animateurs:', error);
        }
      },
      async deleteAnimateur(animateurId) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/animateurs/${animateurId}`);
          this.animateurs = this.animateurs.filter(animateur => animateur.id !== animateurId);
          alert('Animateur deleted successfully!');
        } catch (error) {
          console.error('Error deleting animateur:', error);
          alert('Failed to delete animateur. Please try again.');
        }
      },
      clearSearch() {
        this.searchQuery = '';
      },
    },
  };
  </script>
  