<template>
    <div>
      <div id="calendar" ref="calendarRef"></div>
    </div>
  </template>
  
  <script>
  import { onMounted, ref } from 'vue';
  import axios from 'axios';
  import { createCalendar, viewDay, viewMonthAgenda, viewMonthGrid, viewWeek } from '@schedule-x/calendar';
  import { createDragAndDropPlugin } from '@schedule-x/drag-and-drop';
  import { createEventModalPlugin } from '@schedule-x/event-modal';
  import { createEventsServicePlugin } from '@schedule-x/events-service';
  import '@schedule-x/theme-default/dist/index.css';
  
  export default {
    name: 'App',
    setup() {
      const calendarRef = ref(null);
      const calendar = ref(null);
      const eventsServicePlugin = createEventsServicePlugin();
  
      const fetchAndDisplayEvents = async () => {
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
                start: formatDateAndTime(getDateOfNext(horaire.jour), horaire.heure_debut),
                end: formatDateAndTime(getDateOfNext(horaire.jour), horaire.heure_fin),
              }));
            })
          );
  
          const allEvents = activiteEvents.flat();
          console.log('All events:', allEvents);
  
          if (eventsServicePlugin && typeof eventsServicePlugin.set === 'function') {
            eventsServicePlugin.set(allEvents);
          } else {
            throw new Error('EventsServicePlugin is not correctly instantiated');
          }
  
          calendar.value = createCalendar({
            views: [viewMonthGrid, viewMonthAgenda, viewWeek, viewDay],
            datePicker: {
              selectedDate: new Date().toISOString().split('T')[0],
            },
            defaultView: viewWeek.name,
            events: allEvents,
            plugins: [createDragAndDropPlugin(), createEventModalPlugin(), eventsServicePlugin],
          });
  
          if (calendarRef.value) {
            calendar.value.render(calendarRef.value);
            console.log('Calendar rendered.');
          } else {
            throw new Error('Calendar element is not available');
          }
        } catch (error) {
          console.error('Error fetching data', error);
        }
      };
  
      const getDateOfNext = (dayName) => {
        const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const dayIndex = daysOfWeek.indexOf(dayName);
        const todayIndex = new Date().getDay();
        const dayOffset = (dayIndex + 7 - todayIndex) % 7;
        const nextDate = new Date();
        nextDate.setDate(nextDate.getDate() + dayOffset);
        return nextDate.toISOString().split('T')[0];
      };
  
      const formatDateAndTime = (date, time) => {
        // Format time to remove seconds
        const formattedTime = time.substring(0, 5); // 'HH:mm:ss' -> 'HH:mm'
        return `${date} ${formattedTime}`;
      };
  
      onMounted(() => {
        fetchAndDisplayEvents();
      });
  
      return {
        calendarRef,
      };
    },
  };
  </script>
  
  <style>
  #calendar {
    width: 100%;
    height: 100vh;
  }
  </style>
  