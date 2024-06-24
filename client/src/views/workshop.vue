<template>
  <div class="bg-orange-50">
    <navigation @open-modal="openLoginModal" />
    <div class="page-container bg-orange-50">
      <login v-if="showLoginModal" @close-modal="closeLoginModal" />

      <section v-else class="mt-12 bg-orange-50">
        <loading v-if="isLoading" position="center" />
        <div v-else>
          
          <h1
            class="text-4xl mb-20 font-extrabold tracking-tight dark:text-white text-center"
          >
            What are you looking up to?
          </h1>

          <!-- Content -->
        </div>
      </section>
      <TransitionGroup1 />
    </div>
  </div>
  <foooter/>
</template>

<script setup>
import TransitionGroup1 from "../components/TransitionGroup.vue";
import navigation from "../components/navigation.vue";
import login from "../components/log-in.vue";
import loading from "../components/loadinga.vue";
import { ref, onMounted } from "vue";
import foooter from "@/components/foooter.vue";

const showLoginModal = ref(false);
const isLoading = ref(true);

const openLoginModal = () => {
  showLoginModal.value = true;
};

const closeLoginModal = () => {
  showLoginModal.value = false;
};

onMounted(() => {
  setTimeout(() => {
    isLoading.value = false;
  }, 600); // Adjust the delay as needed
});
</script>

<style scoped>
.hide-scroll-bar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.hide-scroll-bar::-webkit-scrollbar {
  display: none;
}
</style>
