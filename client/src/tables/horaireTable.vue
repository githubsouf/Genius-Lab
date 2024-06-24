<template>
    <div class="horaire-card">
      <div class="horaire-container">
        <h1 class="title">Horaire Table</h1>
        <div class="table-wrapper">
          <table class="horaire-table">
            <thead>
              <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="horaire in horaires" :key="horaire.id">
                <td>{{ horaire.jour }}</td>
                <td>{{ formatTime(horaire.heure_debut) }}</td>
                <td>{{ formatTime(horaire.heure_fin) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        horaires: []
      };
    },
    methods: {
      fetchHoraires() {
        axios.get('http://127.0.0.1:8000/api/horaires')
          .then(response => {
            this.horaires = response.data;
          })
          .catch(error => {
            console.error('There was an error fetching the horaires:', error);
          });
      },
      formatTime(time) {
        const date = new Date(`1970-01-01T${time}Z`);
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
      }
    },
    mounted() {
      this.fetchHoraires();
    }
  };
  </script>
  
  <style scoped>
  .horaire-card {
    margin: 20px auto;
    padding: 20px;
    background: transparent;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 1500px; /* Make the card smaller */
  }
  
  .title {
    text-align: center;
    font-size: 1.5rem; /* Make the title smaller */
    margin-bottom: 20px;
    color: #333;
  }
  
  .table-wrapper {
    overflow-y: auto;
    max-height: 300px; /* Set a fixed height and make it scrollable */
  }
  
  .horaire-table {
    width: 100%;
    border-collapse: collapse;
    background: transparent;
    border-radius: 8px;
  }
  
  .horaire-table th,
  .horaire-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  .horaire-table th {
    background-color: #ff8c00; /* Use orange color */
    color: white;
    font-weight: normal; /* Lower boldness */
    font-size: 1rem; /* Smaller font size */
    text-transform: uppercase;
  }
  
  .horaire-table tr {
    transition: background 0.3s ease;
  }
  
  .horaire-table tr:hover {
    background-color: #f1f1f1;
  }
  
  .horaire-table td {
    font-size: 0.9rem; /* Smaller font size */
    color: #555;
  }
  </style>
  