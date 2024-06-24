<template>
  <div class="bg-orange-50">
    <navigation />

    <button
      @click="toggleSidebar"
      type="button"
      class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    >
      <span class="sr-only">Toggle sidebar</span>
      <svg
        class="w-6 h-6 transform transition-transform"
        :class="{ 'rotate-180': isSidebarOpen }"
        aria-hidden="true"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M4.949 4.879a1 1 0 0 0-1.414 1.414L8.586 10l-5.05 5.05a1 1 0 1 0 1.414 1.414l5.657-5.657a1 1 0 0 0 0-1.414L4.95 4.879z"
        />
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M15.05 15.121a1 1 0 0 0 1.414-1.414L11.414 10l5.05-5.05a1 1 0 0 0-1.414-1.414l-5.657 5.657a1 1 0 0 0 0 1.414l5.657 5.657z"
        />
      </svg>
    </button>

    <aside
      id="default-sidebar"
      class="fixed z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
      aria-label="Sidebar"
    >
      <div class="h-full px-3 py-4 overflow-y-auto bg-orange-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
          <li>
            <a
              @click="showClientsTable"
              href="#"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 18"
              >
                <!-- Your SVG icon for "My Clients" -->
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">My Clients</span>
            </a>
          </li>
          <li>
            <a
              @click="showWorkshopsTable"
              href="#"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 18 20"
              >
                <!-- Your SVG icon for "My Workshops" -->
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">My Workshops</span>
            </a>
          </li>
          <li>
            <button
              @click="showAnimateursTable"
              type="button"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <svg
                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 18 18"
              >
                <!-- Your SVG icon for "My Animators" -->
              </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">My Animators</span>
            </button>
          </li>
        </ul>
      </div>
    </aside>

    <div class="p-4 sm:ml-64 mt-10 bg-orange-50">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="greeting mb-8">
          <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">
            Welcome back, Animator!
          </h1>
          <p class="text-gray-600 dark:text-gray-400">Here's an overview of your current and upcoming workshops.</p>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-4">
          <div v-if="clientsTableVisible">
            <UsersTable />
          </div>
          <div v-if="workshopsTableVisible">
            <workshopTable />
          </div>
          <div v-if="animateursTableVisible">
            <animateursTable />
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-4">
          <div class="p-4 bg-orange-100 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Current Workshops</h2>
            <p class="text-gray-600 dark:text-gray-400">These are the workshops you are currently participating in:</p>
            <!-- Add content for current workshops -->
          </div>
          <div class="p-4 bg-orange-100 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Future Workshops</h2>
            <p class="text-gray-600 dark:text-gray-400">These are the workshops that are scheduled for the future:</p>
            <!-- Add content for future workshops -->
          </div>
        </div>
        <horaireTableVue/>
      </div>
    </div>
    
  </div>
</template>

<script>
import axios from "axios";
import navigation from "@/components/navigation.vue";
import animateursTable from "@/dashboards/animateursTable.vue";
import UsersTable from "@/tables/usersTable.vue";
import workshopTable from "@/tables/workshopTable.vue";
import horaireTableVue from '@/tables/horaireTable.vue';

export default {
  components: { animateursTable, workshopTable, UsersTable, navigation, horaireTableVue },
  data() {
    return {
      isSidebarOpen: false,
      clientsTableVisible: false,
      workshopsTableVisible: false,
      animateursTableVisible: false
    };
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    showClientsTable() {
      this.clientsTableVisible = true;
      this.workshopsTableVisible = false;
      this.animateursTableVisible = false;
    },
    showWorkshopsTable() {
      this.clientsTableVisible = false;
      this.workshopsTableVisible = true;
      this.animateursTableVisible = false;
    },
    showAnimateursTable() {
      this.clientsTableVisible = false;
      this.workshopsTableVisible = false;
      this.animateursTableVisible = true;
    }
  }
};
</script>

<style scoped>
.greeting {
  margin-bottom: 1rem;
}
</style>
