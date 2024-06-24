<template>
    <div>
      <div class="flex items-center justify-between mb-4">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Search activities by title, type, or name"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-offset-gray-800"
        />
        <button @click="clearSearch" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring focus:ring-blue-500 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">Clear</button>
      </div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <!-- Table headers -->
          <thead>
            <tr>
              <th class="px-6 py-3">ID</th>
              <th class="px-6 py-3">Admin ID</th>
              <th class="px-6 py-3">Title</th>
              <th class="px-6 py-3">Activity Type</th>
              <th class="px-6 py-3">Name</th>
              <th class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <!-- Table body -->
          <tbody>
            <tr v-for="activity in filteredActivities" :key="activity.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="px-6 py-4">{{ activity.id }}</td>
              <td class="px-6 py-4">{{ activity.administrateur_id }}</td>
              <td class="px-6 py-4">{{ activity.titre }}</td>
              <td class="px-6 py-4">{{ activity.type_activite }}</td>
              <td class="px-6 py-4">{{ activity.nom }}</td>
              <td class="flex items-center px-6 py-4">
                <button @click="deleteActivity(activity.id)" class="mr-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                <button @click="showUpdateModal(activity)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Update Activity Modal -->
      <div v-if="updateActivityModalVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-md shadow-md">
          <h2 class="text-lg font-semibold mb-4">Update Activity</h2>
          <div class="mb-4">
            <label for="updatedActivityTitle" class="block text-sm font-medium text-gray-700">Title</label>
            <input
              v-model="updatedActivityTitle"
              type="text"
              id="updatedActivityTitle"
              name="updatedActivityTitle"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
            />
          </div>
          <div class="mb-4">
            <label for="updatedActivityType" class="block text-sm font-medium text-gray-700">Activity Type</label>
            <input
              v-model="updatedActivityType"
              type="text"
              id="updatedActivityType"
              name="updatedActivityType"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
            />
          </div>
          <!-- Add more input fields as needed -->
          <div class="flex justify-end">
            <button @click="updateActivity" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Update</button>
            <button @click="closeUpdateModal" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring focus:ring-blue-500">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        activities: [],
        searchQuery: '',
        selectedActivity: null,
        updateActivityModalVisible: false,
        updatedActivityTitle: '',
        updatedActivityType: '',
        // Add more fields as needed for updating activities
      };
    },
    computed: {
      filteredActivities() {
        return this.activities.filter(activity =>
          activity.titre.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          activity.type_activite.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          activity.nom.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      },
    },
    created() {
      this.fetchActivities();
    },
    methods: {
      async fetchActivities() {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/activites');
          this.activities = response.data;
        } catch (error) {
          console.error('Error fetching activities:', error);
        }
      },
      async deleteActivity(activityId) {
  try {
    await axios.delete(`http://127.0.0.1:8000/api/activites/${activityId}`);
    this.activities = this.activities.filter(activity => activity.id !== activityId);
    alert('Activity deleted successfully!');
  } catch (error) {
    if (error.response) {
      // The request was made and the server responded with a status code
      console.error('Error deleting activity - Status:', error.response.status);
      console.error('Response data:', error.response.data);
      alert('Failed to delete activity. Please try again.');
    } else if (error.request) {
      // The request was made but no response was received
      console.error('Error deleting activity - No response received');
      alert('Failed to delete activity. Please check your network connection.');
    } else {
      // Something else happened in making the request
      console.error('Error deleting activity - Request error:', error.message);
      alert('An unexpected error occurred. Please try again later.');
    }
  }
}
,
      clearSearch() {
        this.searchQuery = '';
      },
      showUpdateModal(activity) {
        this.selectedActivity = activity;
        this.updatedActivityTitle = activity.titre;
        this.updatedActivityType = activity.type_activite;
        this.updateActivityModalVisible = true;
      },
      async updateActivity() {
        try {
          const response = await axios.put(`http://127.0.0.1:8000/api/activites/${this.selectedActivity.id}`, {
            titre: this.updatedActivityTitle,
            type_activite: this.updatedActivityType,
            // Add more fields as needed for updating activities
          });
          this.selectedActivity.titre = this.updatedActivityTitle;
          this.selectedActivity.type_activite = this.updatedActivityType;
          this.updateActivityModalVisible = false;
          alert('Activity updated successfully!');
        } catch (error) {
          console.error('Error updating activity:', error);
          alert('Failed to update activity. Please try again.');
        }
      },
      closeUpdateModal() {
        this.updateActivityModalVisible = false;
        this.selectedActivity = null;
        this.updatedActivityTitle = '';
        this.updatedActivityType = '';
        // Clear other fields if needed
      },
    },
  };
  </script>
  