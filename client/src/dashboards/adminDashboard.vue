<template>
  <div class="bg-orange-50">
    <navigation />

    <div class="flex justify-start p-4">
      <button
        @click="showClientsTable"
        class="flex items-center p-2 m-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
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
        <span class="ml-3 whitespace-nowrap">My Clients</span>
      </button>
      <button
        @click="showWorkshopsTable"
        class="flex items-center p-2 m-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
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
        <span class="ml-3 whitespace-nowrap">My Workshops</span>
      </button>
      <button
        @click="showAnimateursTable"
        type="button"
        class="flex items-center p-2 m-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
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
        <span class="ml-3 whitespace-nowrap">My Animators</span>
      </button>
      <router-link
        to="/dashboard/admin/addworkshop"
        class="flex items-center p-2 m-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
      >
        <svg
          aria-hidden="true"
          class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M10.75 10.75h3.5v1.5h-3.5v3.5h-1.5v-3.5h-3.5v-1.5h3.5v-3.5h1.5v3.5z"
          />
        </svg>
        <span class="ml-3">Add Workshop</span>
      </router-link>
      <router-link
        to="/dashboard/admin/newoffer"
        class="flex items-center p-2 m-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
      >
        <svg
          aria-hidden="true"
          class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M10.75 10.75h3.5v1.5h-3.5v3.5h-1.5v-3.5h-3.5v-1.5h3.5v-3.5h1.5v3.5z"
          />
        </svg>
        <span class="ml-3">Add New Offer</span>
      </router-link>
    </div>

    <div class="p-4 bg-orange-50">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="greeting mb-8">
          <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">
            Welcome back, Admin!
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
      </div>
    </div>

    <!-- Notification -->
    <div v-if="showNotification" class="alert shadow-lg fixed bottom-4 right-4">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <div>
        <h3 class="font-bold">{{ notificationTitle }}</h3>
        <div class="text-xs">{{ notificationMessage }}</div>
      </div>
      <button @click="showNotification = false" class="btn btn-sm">Close</button>
    </div>

    <!-- Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white dark:bg-gray-900 p-6 rounded-lg w-full max-w-md h-3/4 overflow-y-auto">
        <form @submit.prevent="submitForm">
          <!-- Title Field -->
          <div class="mb-4">
            <label for="event-title" class="block mb-2">Title</label>
            <input
              v-model="newEvent.title"
              type="text"
              id="event-title"
              class="w-full p-2 border border-gray-300 rounded dark:bg-gray-800 dark:text-white"
              required
            />
          </div>

          <!-- Start Date Field -->
          <div class="mb-4">
            <label for="event-start" class="block mb-2">Start Date and Time</label>
            <input
              v-model="newEvent.start"
              type="datetime-local"
              id="event-start"
              class="w-full p-2 border border-gray-300 rounded dark:bg-gray-800 dark:text-white"
              required
            />
          </div>

          <!-- End Date Field -->
          <div class="mb-4">
            <label for="event-end" class="block mb-2">End Date and Time</label>
            <input
              v-model="newEvent.end"
              type="datetime-local"
              id="event-end"
              class="w-full p-2 border border-gray-300 rounded dark:bg-gray-800 dark:text-white"
              required
            />
          </div>

          <!-- Calendar ID Field -->
          <div class="mb-4">
            <label for="calendar-id" class="block mb-2">Calendar ID</label>
            <input
              v-model="newEvent.calendarId"
              type="text"
              id="calendar-id"
              class="w-full p-2 border border-gray-300 rounded dark:bg-gray-800 dark:text-white"
              required
            />
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end">
            <button
              type="button"
              @click="closeModal"
              class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300"
            >
              Cancel
            </button>
            <button
              type="submit"
              class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Calendar -->
    <div id="calendar" class="calendar-wrapper sx-vue-calendar-wrapper"></div>
    <button
        class="flex items-center p-2 m-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
      >
        <svg
          aria-hidden="true"
          class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M10.75 10.75h3.5v1.5h-3.5v3.5h-1.5v-3.5h-3.5v-1.5h3.5v-3.5h1.5v3.5z"
          />
        </svg>
        <span class="ml-3">Add Workshop to timetable</span>
      </button>
  </div>
  <foooter/>
</template>

<script>
import { createCalendar, viewDay, viewWeek, viewMonthGrid, viewMonthAgenda } from '@schedule-x/calendar';
import { createDragAndDropPlugin } from '@schedule-x/drag-and-drop';
import { createEventModalPlugin } from '@schedule-x/event-modal';
import '@schedule-x/theme-default/dist/index.css';
import axios from 'axios';
import navigation from '@/components/navigation.vue';
import animateursTable from '@/dashboards/animateursTable.vue';
import UsersTable from '@/tables/usersTable.vue';
import workshopTable from '@/tables/workshopTable.vue';
import foooter from '@/components/foooter.vue';

export default {
  name: 'App',
  components: {
    navigation,
    animateursTable,
    UsersTable,
    workshopTable,
    foooter
  },
  data() {
    return {
      isSidebarOpen: false,
      isModalOpen: false,
      clientsTableVisible: false,
      workshopsTableVisible: false,
      animateursTableVisible: false,
      showNotification: false,
      notificationTitle: '',
      notificationMessage: '',
      newEvent: {
        title: '',
        start: '',
        end: '',
        calendarId: '',
      },
      calendar: null,
      calendarRef: null,
      events: [],
    };
  },
  methods: {
    async fetchAndDisplayEvents() {
      try {
        console.log('Fetching data...');
        const horairesResponse = await axios.get('http://127.0.0.1:8000/api/horaires');
        const activitesResponse = await axios.get('http://127.0.0.1:8000/api/activites');

        console.log('Data fetched:', { horaires: horairesResponse.data, activites: activitesResponse.data });

        const activites = activitesResponse.data;

        const activiteEvents = await Promise.all(
          activites.map(async (activite) => {
            const activiteHorairesResponse = await axios.get(
              `http://127.0.0.1:8000/api/activites/${activite.id}/horaires`
            );
            const activiteHoraires = activiteHorairesResponse.data;

            return activiteHoraires.map((horaire) => ({
              id: horaire.id,
              title: activite.nom,
              start: this.formatDateAndTime(this.getDateOfNext(horaire.jour), horaire.heure_debut),
              end: this.formatDateAndTime(this.getDateOfNext(horaire.jour), horaire.heure_fin),
            }));
          })
        );

        this.events = activiteEvents.flat();
        console.log('All events:', this.events);

        this.initializeCalendar();
      } catch (error) {
        console.error('Error fetching data', error);
      }
    },
    getDateOfNext(dayName) {
      const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      const dayIndex = daysOfWeek.indexOf(dayName);
      const todayIndex = new Date().getDay();
      const dayOffset = (dayIndex + 7 - todayIndex) % 7;
      const nextDate = new Date();
      nextDate.setDate(nextDate.getDate() + dayOffset);
      return nextDate.toISOString().split('T')[0];
    },
    formatDateAndTime(date, time) {
      const formattedTime = time.substring(0, 5); 
      return `${date} ${formattedTime}`;
    },
    openModalWithTime(start, end) {
      this.newEvent.start = start;
      this.newEvent.end = end;
      this.isModalOpen = true;
    },
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
    },
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    showNotificationMessage(title, message) {
      this.notificationTitle = title;
      this.notificationMessage = message;
      this.showNotification = true;
      setTimeout(() => {
        this.showNotification = false;
      }, 3000);
    },
    submitForm() {
      this.events.push({
        ...this.newEvent,
        id: Date.now(), // Generating a unique ID for the new event
      });

      this.initializeCalendar();
      this.closeModal();
      this.showNotificationMessage('Event Added', 'The event was added successfully.');
    },
    initializeCalendar() {
      this.calendar = createCalendar({
        views: [viewMonthGrid, viewMonthAgenda, viewWeek, viewDay],
        datePicker: {
          selectedDate: new Date().toISOString().split('T')[0],
        },
        defaultView: viewWeek.name,
        events: this.events,
        plugins: [createDragAndDropPlugin(), createEventModalPlugin()],
      });

      if (this.calendarRef) {
        this.calendar.render(this.calendarRef);
        console.log('Calendar rendered.');
      } else {
        throw new Error('Calendar element is not available');
      }
    },
  },
  mounted() {
    this.calendarRef = document.getElementById('calendar');
    this.fetchAndDisplayEvents();
  },
};
</script>

<style scoped>
#calendar {
  width: 80%;
  height: 800px;
  margin: 40px;
}
.greeting {
  margin-bottom: 1rem;
}
.alert {
  display: flex;
  align-items: center;
  background-color: #fefcbf;
  border: 1px solid #fbd38d;
  border-radius: 8px;
  padding: 16px;
  margin: 16px 0;
}

.alert svg {
  margin-right: 8px;
}

.alert .btn {
  margin-left: auto;
}
.sx-vue-calendar-wrapper {
  width: 100%;
  height: 800px;
  max-height: 90vh;
}
</style>
