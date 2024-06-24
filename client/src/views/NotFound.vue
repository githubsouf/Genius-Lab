<template>
    <div class="wrapper bg-orange-50">
      <nav>
        <navigation @open-modal="openLoginModal" />
        <login v-if="showLoginModal" @close-modal="closeLoginModal" />
      </nav>
      <main class="flex items-center justify-center flex-col">
        <section class="bg-orange-50 dark:bg-gray-900">
          <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-1 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400 text-center">
              <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">404 Not Found</h2>
              <p class="mb-4">Sorry, the page you are looking for does not exist.</p>
            </div>
            <div class="mt-8 flex justify-center">
              <img class="w-full lg:w-1/2 rounded-lg -mt-20"  data-aos="zoom-in-down"  src="../assets/05.png" alt="astronaut confused" />
            </div>
          </div>
        </section>
       
      </main>
    </div>
    <foooter />
  </template>
  
  <script setup>
  import navigation from "../components/navigation.vue";
  import login from "../components/log-in.vue";
  import foooter from "../components/foooter.vue";
  import { ref, onMounted } from "vue";
  
  const showLoginModal = ref(false);
  
  const openLoginModal = () => {
    showLoginModal.value = true;
  };
  
  const closeLoginModal = () => {
    showLoginModal.value = false;
  };
  </script>
  
  <style scoped>
  .wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  
  main {
    flex: 1;
  }
  
  .custom-smaller-text {
    font-size: 17px;
  }
  </style>
  