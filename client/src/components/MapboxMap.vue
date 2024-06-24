<template>
    <div id="map" class="map-container"></div>
  </template>
  
  <script>
  import mapboxgl from 'mapbox-gl';
  import MapboxClient from '@mapbox/mapbox-sdk';
  
  const mapboxClient = MapboxClient({ accessToken: 'pk.eyJ1Ijoic291Zmk0bmUiLCJhIjoiY2xkd2xlYXV1MDhqbzNvcnh3ODZyMXdtdCJ9.EwBR4XaanvVtVtwJ4gSd8w' });
  
  export default {
    name: 'MapboxMap',
    data() {
      return {
        map: null,
        userLocation: null,
      };
    },
    mounted() {
      this.initializeMap();
    },
    methods: {
      async initializeMap() {
        try {
          
          const position = await this.getUserLocation();
          this.userLocation = [position.coords.longitude, position.coords.latitude];
  
          //this is my token guys : 
          mapboxgl.accessToken = 'pk.eyJ1Ijoic291Zmk0bmUiLCJhIjoiY2xkd2xlYXV1MDhqbzNvcnh3ODZyMXdtdCJ9.EwBR4XaanvVtVtwJ4gSd8w';
          this.map = new mapboxgl.Map({
            container: 'map', 
            style: 'mapbox://styles/mapbox/streets-v11', 
            center: this.userLocation, 
            zoom: 12 
          });
  
          // Add marker for user's location
          new mapboxgl.Marker()
            .setLngLat(this.userLocation)
            .addTo(this.map);
  
          // Search for nearby places
          this.searchNearbyPlaces('football field');
          this.searchNearbyPlaces('school');
          this.searchNearbyPlaces('activity place');
        } catch (error) {
          console.error('Error initializing map:', error);
        }
      },
      getUserLocation() {
        return new Promise((resolve, reject) => {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(resolve, reject);
          } else {
            reject(new Error('Geolocation is not supported by this browser.'));
          }
        });
      },
      async searchNearbyPlaces(query) {
        try {
          const response = await mapboxClient.geocoding
            .forwardGeocode({
              query,
              proximity: this.userLocation,
              types: ['poi'],
              limit: 10
            })
            .send();
  
          const places = response.body.features;
          places.forEach((place) => {
            new mapboxgl.Marker()
              .setLngLat(place.center)
              .setPopup(new mapboxgl.Popup({ offset: 25 }).setText(place.place_name))
              .addTo(this.map);
          });
        } catch (error) {
          console.error(`Error searching for ${query}:`, error);
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .map-container {
    width: 600px; 
    height: 400px; 
    border-radius: 30px; 
    margin: 0 auto; 
  }
  </style>
  