<template>
  <div class="wrapper bg-orange-50">
    <nav>
      <navigation @open-modal="openLoginModal" />
      <login v-if="showLoginModal" @close-modal="closeLoginModal" />
    </nav>
    <loading v-if="isLoading" position="center" />
    <main v-else>
      <section class="bg-orange-50 dark:bg-gray-900">
        <div
          class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6"
        >
          <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
            <h2
              class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"
            >
              About Us
            </h2>
            <p class="mb-4">
              Nous sommes une entreprise spécialisée dans le coaching et le
              développement personnel pour enfants, engagée à offrir des
              expériences enrichissantes et éducatives. Dans le cadre de notre
              développement continu, nous avons conçu cette plateforme web pour
              simplifier le processus d'inscription et de gestion des activités
              pour les parents et les enfants. Notre objectif est de fournir un
              accès facile et pratique à une variété d'ateliers stimulants, des
              laboratoires de sciences passionnants et des jeux éducatifs,
              adaptés aux enfants âgés de 6 à 17 ans. Que ce soit dans le
              domaine de la programmation, de l'intelligence artificielle, de la
              robotique, du calcul mental, de la chimie, de la biologie ou même
              des jeux d'échecs, notre plateforme offre une diversité d'options
              pour nourrir la curiosité et le développement des enfants. La
              Plateforme Web de Gestion des Activités pour Enfants a été conçue
              avec soin pour simplifier la vie des parents en facilitant les
              inscriptions, la consultation des plannings et la gestion des
              paiements. Pour les entreprises, notre plateforme offre également
              des outils efficaces pour une gestion optimale des activités et
              une communication transparente avec les parents. Rejoignez-nous
              dans cette aventure éducative et ludique pour offrir à vos enfants
              des opportunités d'apprentissage passionnantes et enrichissantes.
            </p>
            <p>
              We are strategists, designers and developers. Innovators and
              problem solvers. Small enough to be simple and quick.
            </p>
          </div>
          <div class="grid grid-cols-2 gap-4 mt-8" >
            <img
              class="w-full lg:w-64 rounded-lg" data-aos="flip-left"  data-aos-duration="1200"
              src="../components/icons/05n.png"
              alt="office content 1"
            />
            <!-- Adjusted width for the first image -->
            <img
              class="mt-4 w-full lg:w-64 rounded-lg" data-aos="flip-left" data-aos-duration="1500"
              src="../components/icons/07n.png"
              alt="office content 2"
            />
            <img
              class="mt-2 w-full lg:w-64 rounded-lg" data-aos="flip-left" data-aos-duration="1800"
              src="../components/icons/08n.png"
              alt="office content 3"
            />
            <img
              class="mt-6 w-full lg:w-64 rounded-lg" data-aos="flip-left" data-aos-duration="2000"
              src="../components/icons/09n.png"
              alt="office content 4"
            />
            <!-- Adjusted width for the second image -->
          </div>
        </div>
      </section>
      

      <foooter />
    </main>
    
  </div>
</template>

<script setup>
import navigation from "../components/navigation.vue";
import login from "../components/log-in.vue";
import foooter from "../components/foooter.vue";
import { ref, onMounted } from "vue";
import loading from "../components/loadinga.vue";
import camera from "../components/camera.vue";
import homepagecard0 from "@/components/homepagecard0.vue";

const showLoginModal = ref(false);
const isLoading = ref(true);

const openLoginModal = () => {
  showLoginModal.value = true;
};

const closeLoginModal = () => {
  showLoginModal.value = false;
};

// Simulate loading and hide loading button after delay
onMounted(() => {
  setTimeout(() => {
    isLoading.value = false;
  }, 600); // Adjust the delay as needed
});
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
