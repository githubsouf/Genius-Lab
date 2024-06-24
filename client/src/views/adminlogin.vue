<template>
    <navigation />
    <div id="app">
      <div class="signup-container bg-orange-50">
        <!-- Login Card -->
        <div class="signup-card flip-card" data-aos="flip-left">
          <h2 class="welcome-back">Login to Your Account! (Admins Only) </h2>
          <p class="sign-in-text">Please enter your details to Login</p>
          <form @submit.prevent="loginUser">
            <label for="email" class="input-label">Email</label>
            <input type="email" id="login-email" v-model="email" placeholder="Enter your Email" class="input-field" required />
  
            <label for="password" class="input-label">Password</label>
            <input type="password" id="login-password" v-model="password" placeholder="Enter your Password" class="input-field" required />
  
            <div class="checkbox-container">
              <label class="checkbox-label">
                <input type="checkbox" v-model="rememberMe">
                Remember me
              </label>
            </div>
  
            <button type="submit" class="signup-button">Login</button>
          </form>
  
          <div class="social-login">
            <p class="sign-in-text">Or login with:</p>
            <button class="social-button" @click="socialLogin('facebook')">
              <box-icon type='logo' name='meta'></box-icon> Facebook
            </button>
            <button class="social-button" @click="socialLogin('google')">
              <box-icon name='google' type='logo'></box-icon> Google
            </button>
          </div>
        </div>
      </div>
  
      <!-- Notification -->
      <div v-if="showNotification" class="notification-alert">
        <div class="notification-content">
          <h3 class="font-bold">{{ notificationTitle }}</h3>
          <p>{{ notificationMessage }}</p>
        </div>
      </div>
    </div>
    <foooter />
  </template>
  
  <script>
  import navigation from '@/components/navigation.vue';
  import foooter from '@/components/foooter.vue';
  import { mapActions, mapGetters } from 'vuex';
  import AOS from 'aos';
  import 'aos/dist/aos.css';
  
  export default {
    components: { foooter, navigation },
    data() {
      return {
        email: '',
        password: '',
        rememberMe: false,
        showNotification: false,
        notificationTitle: '',
        notificationMessage: ''
      };
    },
    methods: {
      ...mapActions(['loginUser']),
      async loginUser() {
        try {
            const response = await this.$store.dispatch('loginUser', { email: this.email, password: this.password });
          if (this.email.includes('@gmail.com')) {
            this.showNotificationMessage('Login Error', 'You are not authorized to access this page.');
          } else {
            this.$router.push('/dashboard/admin');
          }
        } catch (error) {
          this.showNotificationMessage('Login Error', error.response?.data.message || 'An error occurred.');
          console.error('Login error:', error);
        }
      },




    //   async loginUser() {
    //   try {
    //     const response = await this.$store.dispatch('loginUser', { email: this.email, password: this.password });
    //     this.showNotificationMessage('Login Successful', 'Welcome back!');
    //     const userType = this.$store.getters.userType;
    //     if (userType === 'parent') {
    //       this.$router.push('/dashboard/parent');
    //     } else if (userType === 'animateur') {
    //       this.$router.push('/dashboard/animateur');
    //     } else {
    //       this.$router.push('/register-type');
    //     }
    //   } catch (error) {
    //     this.showNotificationMessage('Login Error', error.message || 'An error occurred.');
    //     console.error('Login error:', error);
    //   }



      socialLogin(provider) {
        window.location.href = `http://127.0.0.1:8000/api/login/${provider}`;
      },
      showNotificationMessage(title, message) {
        this.notificationTitle = title;
        this.notificationMessage = message;
        this.showNotification = true;
        setTimeout(() => {
          this.showNotification = false;
        }, 3000);
      }
    },
    mounted() {
      AOS.init();
    }
  };
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
  
  #app {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }
  
  .signup-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
    perspective: 1000px;
  }
  
  .signup-card {
    background-color: #fff;
    border-radius: 30px;
    border: 2px dashed black;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 40px;
    width: 400px;
    height: auto;
    text-align: center;
    position: absolute;
    backface-visibility: hidden;
  }
  
  .flip-container {
    position: relative;
    width: 400px;
    height: auto;
    transform-style: preserve-3d;
    transition: transform 0.6s;
  }
  
  .flip-container.flipped {
    transform: rotateY(180deg);
  }
  
  .login-card {
    transform: rotateY(180deg);
  }
  
  .welcome-back {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 8px;
  }
  
  .sign-in-text {
    color: #6c757d;
    margin-bottom: 16px;
  }
  
  .input-label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
    font-weight: 500;
    font-size: 16px;
  }
  
  .input-field {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    margin-bottom: 8px;
  }
  
  .signup-button {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    width: 100%;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
  }
  
  .signup-button:hover {
    background-color: #45a049;
  }
  
  .checkbox-container {
    margin-bottom: 16px;
  }
  
  .checkbox-label {
    display: flex;
    align-items: center;
    font-size: 14px;
  }
  
  .question-mark {
    display: inline-block;
    margin-left: 5px;
    cursor: pointer;
  }
  
  .social-login {
    margin-top: 20px;
  }
  
  .social-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .social-button:hover {
    background-color: #e5e5e5;
  }
  
  .login-text {
    margin-top: 16px;
    font-size: 14px;
  }
  
  .notification-alert {
    position: fixed;
    top: 10px;
    right: 10px;
    background-color: #fefcbf;
    border: 1px solid #fbd38d;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }
  </style>
  