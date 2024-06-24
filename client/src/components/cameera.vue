<template>
    <div>
      <!-- Modal toggle -->
  
      <!-- Main modal -->
      <div
        id="authentication-modal"
        tabindex="-1"
        aria-hidden="true"
        class="fixed inset-0 z-50 overflow-y-auto modal-background"
      >
        <div class="flex items-center justify-center min-h-screen px-4">
          <div class="w-full md:max-w-md">
            <div class="bg-white rounded-lg shadow-md dark:bg-gray-900">
              <!-- Modal header -->
              <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
              >
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                  Sign in to our platform
                </h3>
                <button
                  @click="closeLoginModal"
                  type="button"
                  class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                >
                  <svg
                    class="w-3 h-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                <form @submit.prevent="submitForm" class="space-y-4">
                  <div>
                    <label
                      for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Your email</label
                    >
                    <input
                      v-model="email"
                      type="email"
                      name="email"
                      id="email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      placeholder="name@company.com"
                      required
                    />
                  </div>
                  <div>
                    <label
                      for="password"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Your password</label
                    >
                    <input
                      v-model="password"
                      type="password"
                      name="password"
                      id="password"
                      placeholder="••••••••"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      required
                    />
                  </div>
                  <div class="flex justify-between">
                    <div class="flex items-start">
                      <div class="flex items-center h-5">
                        <input
                          v-model="rememberMe"
                          id="remember"
                          type="checkbox"
                          value=""
                          class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        />
                      </div>
                      <label
                        for="remember"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Remember me</label
                      >
                    </div>
                    <a
                      href="#"
                      class="text-sm text-blue-700 hover:underline dark:text-blue-500"
                      >Lost Password?</a
                    >
                  </div>
                  <button
                    type="submit"
                    class="w-full text-white bg-gray-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-white-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Login to your account
                  </button>
                  <div
                    class="text-sm font-medium text-gray-500 dark:text-gray-300"
                  >
                    Not registered?
                    <a
                      href="#"
                      class="text-blue-700 hover:underline dark:text-blue-500"
                      >Create account</a
                    >
                    
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
  export default {
    data() {
      return {
        showModal: true,
        email: "",
        password: "",
        rememberMe: false,
      };
    },
    methods: {
      toggleModal() {
        this.showModal = !this.showModal;
      },
      closeLoginModal() {
        this.$emit("close-modal");
      },
      openModal() {
        this.showModal = true;
      },
      submitForm() {
        // Handle form submission here
        console.log("Form submitted");
        this.hideModal(); // Hide the modal after form submission (you can modify this logic)
      },
    },
  };
  </script>
  
  <style scoped>
  .modal-background {
    background-color: rgba(
      112,
      108,
      108,
      0.446
    ); /* Adjust the opacity as needed */
    transition: background-color 0.3s ease; /* Add a transition effect for smooth appearance */
  }
  </style>