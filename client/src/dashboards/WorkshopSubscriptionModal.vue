<template>
    <div v-if="show" class="modal">
      <div class="modal-content">
        <h2 class="modal-title">Subscribe to Workshop</h2>
        <div v-if="loading" class="loading">Loading workshops...</div>
        <div v-else class="workshop-list">
          <div v-for="workshop in workshops" :key="workshop.id" class="workshop-item">
            <input 
              type="checkbox" 
              :id="'workshop-' + workshop.id" 
              :value="workshop.id" 
              v-model="selectedWorkshops"
            >
            <label :for="'workshop-' + workshop.id">{{ workshop.nom }}</label>
          </div>
        </div>
        <div class="modal-actions">
          <button @click="subscribeToWorkshops" :disabled="!selectedWorkshops.length" class="btn btn-primary">Subscribe</button>
          <button @click="$emit('close')" class="btn btn-secondary">Cancel</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: ['show', 'childId'],
    data() {
      return {
        workshops: [],
        selectedWorkshops: [],
        loading: true,
      };
    },
    watch: {
      show(newVal) {
        if (newVal) {
          this.fetchWorkshops();
        }
      }
    },
    methods: {
      async fetchWorkshops() {
        this.loading = true;
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/activites', {
            headers: {
              Authorization: `Bearer ${this.$store.state.token}`
            }
          });
          this.workshops = response.data;
        } catch (error) {
          console.error('Failed to fetch workshops:', error);
          // Fallback to static data in case of error
          this.workshops = [
            { id: 1, nom: 'Workshop 1' },
            { id: 2, nom: 'Workshop 2' },
            { id: 3, nom: 'Workshop 3' },
          ];
        } finally {
          this.loading = false;
        }
      },
      async subscribeToWorkshops() {
        try {
          const response = await axios.post(`http://127.0.0.1:8000/api/demandes/${this.$store.state.parentId}/activitesenfants`, {
            activite_id: this.selectedWorkshops,
            enfant_id: [this.childId],
            modalite: 'default' // You might want to add an input for this in the modal
          }, {
            headers: {
              Authorization: `Bearer ${this.$store.state.token}`
            }
          });
          console.log('Subscription successful:', response.data);
          this.$emit('subscription-complete');
          this.$emit('close');
        } catch (error) {
          console.error('Failed to subscribe to workshops:', error);
          // Handle error (show error message to user)
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }
  
  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 500px;
  }
  
  .modal-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 20px;
  }
  
  .loading {
    text-align: center;
    padding: 20px;
  }
  
  .workshop-list {
    max-height: 300px;
    overflow-y: auto;
  }
  
  .workshop-item {
    margin-bottom: 10px;
  }
  
  .modal-actions {
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
  }
  
  .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 10px;
  }
  
  .btn-primary {
    background-color: #4CAF50;
    color: white;
  }
  
  .btn-secondary {
    background-color: #f44336;
    color: white;
  }
  
  .btn:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
  }
  </style>