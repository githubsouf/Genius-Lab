<template>
    
    <navigation />
    <div class="bg-orange-50">
    <loadinga v-if="isLoading" position="center" />
    <div v-else >
    <div class="bg-orange-50 min-h-screen flex flex-col justify-center p-5">
      <div class="text-center mb-10">
        <h1 class="text-8xl font-extrabold text-gray-800 dark:text-white md:text-4xl lg:text-5xl">
          Hello <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ userName }}</span><br>
          To proceed with your registration, <br> please fill out the form.<br>
          Choose your role to continue.
        </h1>
      </div>
  
      
      <div class="flex flex-col lg:flex-row justify-center items-center space-y-5 lg:space-y-0 lg:space-x-10">
        <div @click="navigateToParent" class="card-container p-8 bg-white shadow-md rounded-lg max-w-lg w-full cursor-pointer" data-aos="zoom-in-down">
          <h2 class="text-2xl font-semibold mb-4 text-center">Parent</h2>
          <p class="text-center">Discover current workshops and offers. Easily subscribe your kids to workshops.</p>
        </div>
        <div @click="navigateToAnimator" class="card-container p-8 bg-white shadow-md rounded-lg max-w-lg w-full cursor-pointer" data-aos="zoom-in-down">
          <h2 class="text-2xl font-semibold mb-4 text-center">Animator</h2>
          <p class="text-center">Register for workshops that suit you based on your availability.</p>
        </div>
      </div>
    </div>
    </div>
</div>
    <foooter />
  </template>
<script>
import loadinga from '@/components/loadinga.vue';
import { mapGetters } from 'vuex';
import Navigation from '@/components/navigation.vue';
import Foooter from '@/components/foooter.vue';
import VueTypedJs from 'vue-typed-js';

export default {
  components: {
    Navigation,
    Foooter,
    VueTypedJs,
    loadinga
  },
  computed: {
    ...mapGetters({
      currentUser: 'currentUser'
    }),
    userName() {
      return this.currentUser ? this.currentUser.name : 'Guest';
    }
  },
  data() {
    return {
      typedStrings: [
        'Hello sir!',
        'To proceed with your registration, please fill out the form.',
        'Choose your role to continue.'
      ],
      isLoading: true
    };
  },
  methods: {
    navigateToParent() {
      this.$router.push('/register-parent');
    },
    navigateToAnimator() {
      this.$router.push('/register-animateur');
    },
    fetchData() {
      // Simulate an API call
      setTimeout(() => {
        this.isLoading = false;
      }, 2000); // Adjust the timeout duration as needed
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

.typing {
  font-size: 2rem;
  font-weight: 700;
}

.card-container {
  background-color: #fff;
  border: 2px dashed black;
  border-radius: 30px;
  transition: transform 0.2s;
}

.card-container:hover {
  transform: scale(1.05);
}
</style>
  