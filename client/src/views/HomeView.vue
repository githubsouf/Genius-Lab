<template>
  <div class="bg-orange-50">
    <nav>
      <navigationn @open-modal="openLoginModal" />
      <logina v-if="showLoginModal" @closeLoginModal="closeLoginModal" />
    </nav>
    <loading v-if="isLoading" position="center" />

    <main v-else>
      <section class="bg-orange-50 transition-opacity duration-500" data-aos-anchor-placement="bottom-center">
        <div class="grid max-w-screen-xl px-5 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-10 mb-10 lg:grid-cols-12">
          <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-5 text-4xl font-extrabold tracking-tight leading-none md:text-xl xl:text-5xl">
              Les activités de vos enfants, parfaitement synchronisées et sans stress
            </h1>
            <i class="bx bx-hot"></i>
            <p class="max-w-xl font-light custom-smaller-text text-gray-500 lg:mb-5 md:text-s lg:text-s">
              Orchestrez avec aisance les activités de vos enfants, des activités récréatives aux ateliers éducatifs, en veillant à ce qu'ils ne ratent jamais un moment.
            </p>
            <router-link to="/register" type="button" class="text-white -10 bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-small rounded-full text-lg px-5 py-2.5 me-2" @click="openLoginModal">Register Now!!</router-link>
            <div class="flex mt-20 gap-2" data-aos="fade-up" data-aos-duration="1200" data-aos-anchor-placement="top-bottom">
              <homepagecard0 />
              <homepagecard4 />
            </div>
          </div>
          <div class="lg:col-span-5 flex justify-center items-center">
            <img class="fixed-size-image-1" src="../components/icons/Design sans titre (11)-modified.png" alt="Parenting Image" />
          </div>
        </div>
      </section>

      <div class="center-content">
        <div class="flex align-center mb-20 gap-4 fixed-card" data-aos="zoom-out-up">
          <homepagecard class="mr-10"/>
          <homepagecard2 class="mr-10 ml-10"/>
          <homepagecard1 class="ml-10"/>
        </div>
        <div class="flex flex-col items-center mt-20 lg:m-5">
          <img src="@/assets/COC.svg" alt="SVG Image" class="fixed-size-image mt-10" data-aos="zoom-in-up"/>
          <img src="@/assets/COC (1).svg" alt="SVG Image" class="fixed-size-image -mt-40" data-aos-duration="1500" data-aos="zoom-in-up"/>
          <div class="koba mb-10 -ml-40">
          <img src="@/assets/Copie de COC (4).svg" alt="SVG Image" class="fixed-size-image"   data-aos="zoom-in-up"/>
    <button @click="navigateToOffers" class="discover-offers-button -ml-20">
      Discover All Current Offers
    </button>
  </div>
          <h1 class="mb-4  -ml-80 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">
            Why choose <br />
            <span class="underline underline-offset-3 decoration-8 decoration-blue-400">Our services ?</span>
          </h1>
          <p class="mt-20 text-m font-small align-right text-gray-500 lg:text-xl">
            we offer workshops for parents. You can easily register your children online, ensuring security and confidentiality throughout the process.
          </p>
        </div>
        
        <div class="flex justify-center items-center space-x-ml-20 mt-20">
          <div id="lottie-animation-left" class="lottie-animation"></div>
          <homestack  />
          <div id="lottie-animation-right" class="lottie-animation"></div>
        </div>
        
        <section class="-mt-40 py-8">
          <h1 class="cool-title text-xl h-12 underline decoration-dotted">
            Latest Workshops and Offers
          </h1>
          <div class="flex overflow-x-auto">
            <!-- <transition-group name="list" tag="div" class="flex m-40">
              <WorkshopCard v-for="workshop in workshops" :key="workshop.id" :workshop="workshop" />
            </transition-group> -->
          </div>
          <button @click="goToWorkshops" class="mt-8 bg-gray-800 text-white py-2 px-4 rounded-full hover:bg-gray-700">Discover All Workshops</button>
        </section>
      </div>
      <ScrollingCards class="mb-40"/>

      <foooter />
    </main>
  </div>
</template>

<script setup>
import ScrollingCards from "@/components/ScrollingCards.vue";
import 'boxicons';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import AOS from 'aos';
import 'aos/dist/aos.css';
import lottie from 'lottie-web';
import axios from 'axios';
import herocard from "@/components/herocard.vue";
import homepagecard from "@/components/homepagecard.vue";
import homepagecard0 from "@/components/homepagecard0.vue";
import homepagecard1 from "@/components/homepagecard1.vue";
import homepagecard4 from "@/components/homepagecard4.vue";
import homepagecard2 from "@/components/homepagecard2.vue";
import homestack from "@/components/homestack.vue";
import navigationn from "@/components/navigation.vue";
import logina from "@/components/log-in.vue";
import WorkshopCard from '@/components/workshopcard.vue';
import loading from "@/components/loadinga.vue";
import foooter from "@/components/foooter.vue";
import { useRouter } from 'vue-router';
import MapboxMap from '@/components/MapboxMap.vue'; // Import the MapboxMap component
import ScrollingCardsVue from '@/components/ScrollingCards.vue';

const router = useRouter();


const navigateToOffers = () => {
  router.push('/offers');
};
const isLoading = ref(true);
const topThreeAnimators = ref([
  { id: 1, name: "Animator 1", description: "Description 1" },
  { id: 2, name: "Animator 2", description: "Description 2" },
  { id: 3, name: "Animator 3", description: "Description 3" },
]);

const isHidden = ref(false);
const opacityValue = ref(1);
const workshops = ref([]);

const handleScroll = () => {
  const scrollY = window.scrollY;
  if (scrollY > 50) {
    isHidden.value = true;
    opacityValue.value = Math.max(1 - (scrollY - 200) / 100, 0);
  } else {
    isHidden.value = false;
    opacityValue.value = 1;
  }
};

const goToWorkshops = () => {
  router.push('/workshop');
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
  AOS.init();
  loadLottieAnimation('lottie-animation-left', './Animation - 1716176554817 (1).json');
  loadLottieAnimation('lottie-animation-right', './Animation - 1716176554817 (1).json');
  loadLottieAnimation('lottie-animation-bottom', './Animation - 1716176554817 (1).json');

  axios.get('http://127.0.0.1:8000/api/activites')
    .then(response => {
      workshops.value = response.data;
    })
    .catch(error => {
      console.error('Failed to fetch workshops:', error);
    });

  setTimeout(() => {
    isLoading.value = false;
  }, 600);
});

onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll);
});

const loadLottieAnimation = (elementId, animationPath) => {
  lottie.loadAnimation({
    container: document.getElementById(elementId),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: animationPath,
  });
};
</script>

<style scoped>


.koba {
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-align: center;
  padding: 50px;
}

.discover-offers-button {
  margin-top: 20px;
  padding: 40px 30px;
  font-size: 40px;
  border: none;
  border-radius: 30%;
  background-color: #000000;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s;
}

.discover-offers-button:hover {
  background-color: #ffb700;
}
.flech-button {
  background-color: transparent;
  border: none;
  font-size: 24px;
  cursor: pointer;
}

.card {
  min-width: calc(33.333%);
  transition: transform 0.2s ease-in-out;
}

.jump-on-hover:hover {
  transform: translateY(-5px);
}

@media (max-width: 1024px) {
  .fixed-size-image {
    width: 100%;
    height: auto;
    max-width: 700px;
  }
  .fixed-card {
    margin: 0 5px;
  }
  .space-x-ml-20 {
    margin-left: 5px;
    margin-right: 5px;
  }
  .mx-30 {
    margin-left: 10px;
    margin-right: 10px;
  }
}

.hidden-on-scroll {
  display: none;
}

.transition-opacity {
  transition: opacity 0.7s ease-in-out;
}

.typewriter {
  font-family: monospace;
  overflow: hidden;
  border-right: .15em solid orange;
  white-space: nowrap;
  margin: 0 auto;
  letter-spacing: .15em;
  animation: typing 3s steps(30, end), blink-caret .5s step-end infinite;
}

@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}

@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: rgb(0, 0, 0) }
}

.center-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
  margin-bottom: 20px;
}

.fixed-card {
  margin: 0 5px;
}

.lottie-animation {
  width: 150px;
  height: 150px;
}

.fixed-size-image {
  width: auto;
  height: auto;
  max-width: 1200px;
}
</style>
