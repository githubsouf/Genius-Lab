<template>
    <div>
      <div class="flex items-center justify-between mb-4">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Search users by name or email"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-offset-gray-800"
        />
        <button @click="clearSearch" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring focus:ring-blue-500 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">Clear</button>
      </div>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <!-- Table headers -->
          <!-- Table body -->
          <tbody>
            <tr v-for="user in filteredUsers" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <!-- Table columns -->
            
              <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{ user.name }}
            </td>
            <td class="px-6 py-4">
              {{ user.email }}
            </td>
            <td class="px-6 py-4">
              {{ user.created_at }}
            </td>
            <td class="flex items-center px-6 py-4">
              <button @click="deleteUser(user.id)" class="mr-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
              <button @click="showUpdateModal(user)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Update</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="updateUserModalVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-md shadow-md">
        <h2 class="text-lg font-semibold mb-4">Update User</h2>
        <div class="mb-4">
          <label for="updatedUserName" class="block text-sm font-medium text-gray-700">Name</label>
          <input
            v-model="updatedUserName"
            type="text"
            id="updatedUserName"
            name="updatedUserName"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
          />
        </div>
        <div class="mb-4">
          <label for="updatedUserEmail" class="block text-sm font-medium text-gray-700">Email</label>
          <input
            v-model="updatedUserEmail"
            type="email"
            id="updatedUserEmail"
            name="updatedUserEmail"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
          />
        </div>
        <div class="flex justify-end">
          <button @click="updateUser" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Update</button>
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
      users: [],
      searchQuery: '',
      selectedUser: null,
      updateUserModalVisible: false,
      updatedUserName: '',
      updatedUserEmail: '',
    };
  },
  computed: {
    filteredUsers() {
      return this.users.filter(user =>
        user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        user.email.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/users');
        this.users = response.data;
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
    async deleteUser(userId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/users/${userId}`);
        this.users = this.users.filter(user => user.id !== userId);
        alert('User deleted successfully!');
      } catch (error) {
        console.error('Error deleting user:', error);
        alert('Failed to delete user. Please try again.');
      }
    },
    clearSearch() {
      this.searchQuery = '';
    },
    showUpdateModal(user) {
      this.selectedUser = user;
      this.updatedUserName = user.name;
      this.updatedUserEmail = user.email;
      this.updateUserModalVisible = true;
    },
    async updateUser() {
  try {
    const response = await axios.put(`http://127.0.0.1:8000/api/users/${this.selectedUser.id}`, {
      name: this.updatedUserName,
      email: this.updatedUserEmail,
    });
    this.selectedUser.name = this.updatedUserName;
    this.selectedUser.email = this.updatedUserEmail;
    this.updateUserModalVisible = false;
    alert('User updated successfully!');
  } catch (error) {
    if (error.response && error.response.status === 422) {
      // Handle validation errors
      const errors = error.response.data.errors;
      let errorMessage = 'Validation Error:';
      for (const field in errors) {
        errorMessage += `\n${field}: ${errors[field].join(', ')}`;
      }
      alert(errorMessage);
    } else {
      console.error('Error updating user:', error);
      alert('Failed to update user. Please try again.');
    }
  }
},
    closeUpdateModal() {
      this.updateUserModalVisible = false;
      this.selectedUser = null;
      this.updatedUserName = '';
      this.updatedUserEmail = '';
    },
  },
};
</script>
