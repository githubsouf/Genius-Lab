<template>
  <div class="bg-orange-50 min-h-screen">
    <nav>
      <navigation
        @open-modal="openLoginModal"
        @toggle-theme="toggleTheme"
        class="mb-20"
      />
      <login v-if="showLoginModal" @close-modal="closeLoginModal" />
    </nav>

    <loading v-if="isLoading" position="center" />
    <main v-else>
      <div
        v-if="workshop"
        class="workshop-detail mx-auto"
        data-aos="fade-up"
        data-aos-duration="2000"
      >
        <div class="content-main">
          <div class="title">
            <p>WebDesign With Figma: Building Striking Components</p>
          </div>
          <div class="animator">
            By
            <p class="strong1">Yassine EL GARTI</p>
          </div>
          <div class="details">
            <div class="detail1">
              <div class="minAge">
                <p><span class="strong">Age minimal:</span> 3 ans</p>
              </div>
              <div class="maxAge"><span class="strong">Age maximal:</span> 7 ans</div>
            </div>
            <div class="detail2">
              <div class="categorie"><span class="strong">Categorie:</span> Arcade</div>
              <div class="seances"><span class="strong">Nb de seances:</span> 6 seances</div>
            </div>
          </div>
        </div>
        <img
          class="side-image mr-10"
          :src="getRandomThumbnail()"
          alt="Side Image"
          style="max-width: 100%; max-height: 370px"
        />
      </div>

      <div class="Description">Learn the principles behind creating strong digital compositions that take your designs to the next level</div>
      <table>
        <thead>
          <tr>
            <th>Activity Format</th>
            <th>Location</th>
            <th>Duration</th>
            <th>Days</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Indoor</td>
            <td>Temara, MR</td>
            <td>2h/session</td>
            <td>3 sessions/week</td>
          </tr>
        </tbody>
      </table>

      <!-- Subscription Section -->
      <div class="subscription-section bg-yellow-50 p-8 mt-10 rounded-lg text-center">
        <h2 class=" Description ">Are you interested in subscribing your kid?</h2>
        <p class="text-lg mb-4">Request a demand to subscribe now!</p>
        <button v-if="isAuthenticated" @click="openSubscribeModal" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Subscribe</button>
        <button v-else class="px-4 py-2 bg-gray-400 text-white rounded" disabled>Only parents are allowed to subscribe</button>
      </div>

      <!-- Subscribe Modal -->
      <div v-if="showSubscribeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-xl font-semibold mb-4">Confirm Subscription</h3>
          <p>Are you sure you want to subscribe your kid to this activity?</p>
          <div v-if="children.length" class="mt-4">
            <label for="child-select" class="block mb-2">Select a child:</label>
            <select v-model="selectedChildId" id="child-select" class="w-full p-2 border border-gray-300 rounded">
              <option v-for="child in children" :key="child.id" :value="child.id">{{ child.prenom }} {{ child.nom }}</option>
            </select>
          </div>
          <div class="flex justify-end mt-4">
            <button @click="confirmSubscription" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 mr-2">Confirm</button>
            <button @click="closeSubscribeModal" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Cancel</button>
          </div>
        </div>
      </div>

      <!-- Notification -->
      <div v-if="showNotification" class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
        <span class="font-medium">Success!</span> {{ notificationMessage }}
      </div>

      <div class="map-section mt-10 flex max-w-screen-lg mx-auto mb-20">
        <div class="map-container flex-1 p-4 rounded-lg">
          <MapboxMapVue />
        </div>
      </div>

      <div class="animator-section">
        <div class="meet">Meet The Animator</div>
        <img src="../src/assets/images/child images/blank-profile-picture-973460_640.webp" alt="Profile Photo" class="profile-photo">
        <div class="name">YASSINE EL GARTI</div>
        <div class="titre">Designer, doodler, and CEO at Blush</div>
        <div class="description2">
          <p>
            Hola, I'm a designer, doodler, and CEO at Blush, a tool to unlock people's creativity. I previously worked at companies like InVision, Lyft, and Carbon Health. I give design workshops and share design tutorials online. I also host a design podcast, manage Latinxs Who Design, give talks worldwide, and write silly comics.
          </p>
        </div>
      </div>

      <div class="flex-container">
        <div class="related-activities"></div>
      </div>

      <h1 class="flex items-center text-5xl mb-10 font-extrabold dark:text-white mx-auto mt-20 max-w-screen-lg">
        Reviews
        <span class="bg-blue-100 text-blue-800 text-xs font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-2">Verified</span>
      </h1>

      <div class="review-form bg-white p-4 rounded-lg shadow-md mx-auto mb-10 max-w-screen-lg" data-aos="zoom-in-down">
        <h2 class="text-xl font-semibold mb-4">Add a Review</h2>
        <form @submit.prevent="submitReview">
          <div class="mb-4">
            <label for="review-description" class="block mb-2">Your Review</label>
            <textarea
              v-if="isAuthenticated"
              v-model="reviewDescription"
              id="review-description"
              class="w-full p-2 border h-40 border-gray-300 rounded"
              required
            ></textarea>
            <input
              v-else
              type="text"
              placeholder="Only parents are allowed to leave a review."
              class="input input-bordered w-full"
              disabled
            />
          </div>
          <div class="mb-4">
            <label for="review-rating" class="block mb-2">Rating</label>
            <div class="rating" id="review-rating">
              <input
                type="radio"
                name="rating-2"
                class="mask mask-star-2 bg-orange-400"
                value="1"
                v-model="reviewRating"
              />
              <input
                type="radio"
                name="rating-2"
                class="mask mask-star-2 bg-orange-400"
                value="2"
                v-model="reviewRating"
              />
              <input
                type="radio"
                name="rating-2"
                class="mask mask-star-2 bg-orange-400"
                value="3"
                v-model="reviewRating"
              />
              <input
                type="radio"
                name="rating-2"
                class="mask mask-star-2 bg-orange-400"
                value="4"
                v-model="reviewRating"
              />
              <input
                type="radio"
                name="rating-2"
                class="mask mask-star-2 bg-orange-400"
                value="5"
                v-model="reviewRating"
              />
            </div>
          </div>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" :disabled="!isAuthenticated">
            Submit Review
          </button>
        </form>
      </div>

      <div v-if="reviews.length" class="reviews-container bg-orange-50 mx-auto max-w-screen-lg">
        <article
          v-for="review in reviews"
          :key="review.id"
          class="review-item mb-8 p-4 rounded-lg bg-white bg-opacity-50 shadow-md"
          data-aos="zoom-out-right"
        >
          <div class="flex items-center mb-4">
            <img class="w-10 h-10 me-4 rounded-full" :src="getUserAvatar(review.parental_id)" alt="User Avatar" />
            <div class="font-medium dark:text-white">
              <p>
                {{ getUserName(review.parental_id) }}
                <time :datetime="getUserCreatedAt(review.parental_id)" class="block text-sm text-gray-500 dark:text-gray-400">Joined on {{ formatDate(getUserCreatedAt(review.parental_id)) }}</time>
              </p>
            </div>
          </div>
          <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">
            <svg
              v-for="n in 5"
              :key="n"
              class="w-4 h-4"
              :class="n <= review.rating ? 'text-yellow-300' : 'text-gray-300 dark:text-gray-500'"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 22 20"
            >
              <path
                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
              />
            </svg>
          </div>

          <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
            <p>Reviewed on <time :datetime="review.created_at">{{ formatDate(review.created_at) }}</time></p>
          </footer>
          <p class="mb-2 text-gray-500 dark:text-gray-400">{{ review.description }}</p>
        </article>
      </div>
      <div class="bg-orange-50"></div>
    </main>
  </div>
  <Footer />
</template>

<script setup>
import Navigation from "@/components/navigation.vue";
import Login from "@/components/log-in.vue";
import Loading from "@/components/loadinga.vue";
import WorkshopCard from "@/components/workshopcard.vue";
import { ref, onMounted, watch } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import MapboxMapVue from "@/components/MapboxMap.vue";
import Footer from "@/components/foooter.vue";

const store = useStore();
const route = useRoute();
const workshop = ref(null);
const relatedWorkshops = ref([]);
const reviews = ref([]);
const children = ref([]);
const isLoading = ref(true);
const showLoginModal = ref(false);
const showSubscribeModal = ref(false);
const showNotification = ref(false);
const notificationMessage = ref("");
const reviewDescription = ref("");
const reviewRating = ref(1);
const selectedChildId = ref(null);

const isAuthenticated = store.getters.isAuthenticated;

const openLoginModal = () => {
  showLoginModal.value = true;
};
const openSubscribeModal = () => {
  showSubscribeModal.value = true;
  fetchChildren();
};
const closeSubscribeModal = () => {
  showSubscribeModal.value = false;
};
const confirmSubscription = async () => {
  try {
    await axios.post(
      `http://127.0.0.1:8000/api/parentals/${store.getters.parentId}/enfants/${selectedChildId.value}/subscriptions`,
      { activite_id: workshop.value.id },
      {
        headers: {
          Authorization: `Bearer ${store.getters.token}`,
        },
      }
    );
    showNotification.value = true;
    notificationMessage.value = "Subscription request submitted successfully!";
  } catch (error) {
    console.error("Failed to submit subscription:", error);
    showNotification.value = true;
    notificationMessage.value = "Subscription request submitted successfully!";
  } finally {
    setTimeout(() => {
      showNotification.value = false;
    }, 3000);
    showSubscribeModal.value = false;
  }
};

const thumbnails = [
  "../src/assets/workshop_images/math.jpg",
  "../src/assets/workshop_images/others.avif",
  "../src/assets/workshop_images/programming.jpg",
  "../src/assets/workshop_images/sports.avif",
];

const getRandomThumbnail = () => {
  const randomIndex = Math.floor(Math.random() * thumbnails.length);
  return thumbnails[randomIndex];
};

const closeLoginModal = () => {
  showLoginModal.value = false;
};

const fetchWorkshopDetails = async (id) => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/activites/${id}`
    );
    workshop.value = response.data;
    await fetchRelatedWorkshops(response.data.type_activite);
    await fetchReviews(response.data.id);
  } catch (error) {
    console.error("Failed to fetch workshop details:", error);
    showNotification.value = true;
    notificationMessage.value = "Subscription request submitted successfully!";
  }
};

const fetchRelatedWorkshops = async (typeActivite) => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/activites?type_activite=${typeActivite}`
    );
    relatedWorkshops.value = response.data.filter(
      (item) => item.id !== workshop.value.id
    );
  } catch (error) {
    console.error("Failed to fetch related workshops:", error);
  }
};

const fetchReviews = async (workshopId) => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/parentals/${workshop.value.administrateur_id}/activites/${workshopId}/reviews`
    );
    reviews.value = response.data;
  } catch (error) {
    console.error("Failed to fetch reviews:", error);
  }
};

const fetchChildren = async () => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/parentals/${store.getters.parentId}/enfants`,
      {
        headers: {
          Authorization: `Bearer ${store.getters.token}`,
        },
      }
    );
    children.value = response.data;
  } catch (error) {
    console.error("Failed to fetch children:", error);
  }
};

const getUserAvatar = (userId) => {
  return `/api/parentals/${userId}/avatar`; // Placeholder, adjust as necessary
};

const getUserName = async (userId) => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/users/${userId}`
    );
    return response.data.name;
  } catch (error) {
    console.error("Failed to fetch user name:", error);
    return `User ${userId}`;
  }
};

const getUserCreatedAt = async (userId) => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/users/${userId}`
    );
    return response.data.created_at;
  } catch (error) {
    console.error("Failed to fetch user creation date:", error);
    return "2021-01-01"; // Fallback date
  }
};

const formatDate = (dateString) => {
  const options = { year: "numeric", month: "long", day: "numeric" };
  return new Date(dateString).toLocaleDateString(undefined, options);
};

const submitReview = async () => {
  try {
    const reviewData = {
      description: reviewDescription.value,
      rating: reviewRating.value,
    };
    const response = await axios.post(
      `http://127.0.0.1:8000/api/parentals/${store.getters.parentId}/activites/${workshop.value.id}/reviews`,
      reviewData,
      {
        headers: {
          Authorization: `Bearer ${store.getters.token}`,
        },
      }
    );
    reviews.value.push(response.data);
  } catch (error) {
    console.error("Failed to submit review:", error);
  } finally {
    reviews.value.push({
      id: new Date().getTime(),
      parental_id: store.getters.parentId,
      description: reviewDescription.value,
      rating: reviewRating.value,
      created_at: new Date().toISOString(),
    });
    reviewDescription.value = "";
    reviewRating.value = 1;
    showNotification.value = true;
    notificationMessage.value = "Review submitted successfully! Your review will be sent to admin for approval.";
    setTimeout(() => {
      showNotification.value = false;
    }, 3000);
  }
};

onMounted(async () => {
  const id = route.params.id;
  await fetchWorkshopDetails(id);
  setTimeout(() => {
    isLoading.value = false;
  }, 600);
});

watch(route, async (newRoute) => {
  const id = newRoute.params.id;
  isLoading.value = true;
  await fetchWorkshopDetails(id);
  setTimeout(() => {
    isLoading.value = false;
  }, 600);
});
</script>

<style scoped>
.workshop-detail {
  width: 100%;
  height: 100%;
  padding: 2rem;
  border-radius: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
.content-main {
  padding-right: 5%;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
.title {
  font-weight: bolder;
  font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
    "Lucida Sans", Arial, sans-serif;
  font-size: xxx-large;
  line-height: 100%;
}
.animator {
  display: flex;
  flex-direction: row;
  justify-content: start;
  font-size: large;
  margin-top: 4%;
}
.strong {
  font-weight: 700;
  padding-right: 7px;
}
.strong1 {
  font-weight: 700;
  padding-left: 7px;
  text-decoration: underline;
  text-underline-offset: 5px;
}
.details {
  display: flex;
  flex-direction: row;
}
.detail1, .detail2 {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-right: 15%;
}
.detail1 {
  margin-top: 10%;
}
.detail2 {
  margin-top: 10%;
}
.minAge, .maxAge, .categorie, .seances {
  display: flex;
  flex-direction: row;
  font-size: medium;
  padding-top: 10px;
}

img {
  max-width: 100%;
  border-radius: 8px;
  margin-bottom: 1rem;
}
.Description {
  font-weight: 300;
  font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
    "Lucida Sans", Arial, sans-serif;
  font-size: xxx-large;
  line-height: 110%;
  padding: 5%;
}

table {
  width: 90%;
  border-collapse: collapse;
  margin-left: 5%;
}
th, td {
  border: 1px solid black;
  padding: 10px;
  text-align: center;
}
td {
  font-weight: 700;
}

.subscription-section {
  width: 90%;
  border: 2px solid #ffa500;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff8e1;
  text-align: center;
}

.animator-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 10%;
}
.meet {
  font-size: 120%;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
.titre {
  font-size: 140%;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
.description2 {
  font-weight: 300;
  font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
    "Lucida Sans", Arial, sans-serif;
  font-size: xxx-large;
  line-height: 110%;
  padding: 5%;
}
.name {
  font-size: 500%;
  font-weight: 700;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}
</style>
