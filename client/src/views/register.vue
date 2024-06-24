<template>
  <navigation/>
  <div id="app">
    <div class="signup-container bg-orange-50">
      <!-- Registration Card -->
      <div v-show="showRegister" :class="['signup-card', 'flip-card']" data-aos="flip-right">
        <h2 class="welcome-back">Create an Account!</h2>
        <p class="sign-in-text">Please enter your details to Sign up</p>
        <form @submit.prevent="registerUser">
          <div class="name-fields">
            <div class="name-field">
              <label for="name" class="input-label">First Name</label>
              <input type="text" id="name" v-model="name" placeholder="First Name" class="input-field" required />
            </div>
            <div class="name-field">
              <label for="prenom" class="input-label">Last Name</label>
              <input type="text" id="prenom" v-model="prenom" placeholder="Last Name" class="input-field" required />
            </div>
          </div>

          <label for="email" class="input-label">Email</label>
          <input type="email" id="email" v-model="email" placeholder="Enter your Email" class="input-field" required />

          <div class="password-fields">
            <div class="password-field">
              <label for="password" class="input-label">Password</label>
              <input type="password" id="password" v-model="password" placeholder="Enter your Password" class="input-field" required />
            </div>
            <div class="password-field">
              <label for="repeat-password" class="input-label">Repeat Password</label>
              <input type="password" id="repeat-password" v-model="repeatPassword" placeholder="Repeat your Password" class="input-field" required />
            </div>
          </div>

          <div class="checkbox-container">
            <label class="checkbox-label">
              <input type="checkbox" v-model="termsAccepted" required>
              I accept the <a href="https://g-lab-term-and-conditions.tiiny.site" target="_blank">terms and conditions</a> <span class="question-mark">?</span>
            </label>
          </div>

          <button type="submit" class="signup-button">Create Account</button>
        </form>
        <p class="login-text">I have an account? <a href="#" @click="toggleForms">Login</a></p>
      </div>

      <!-- Login Card -->
      <div v-show="!showRegister" :class="['signup-card', 'flip-card']" data-aos="flip-left" >
        <h2 class="welcome-back">Login to Your Account!</h2>
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

        <p class="login-text">Don't have an account? <a href="#" @click="toggleForms">Sign Up</a></p>
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
  <foooter/>
</template>

<script>
import navigation from '@/components/navigation.vue';
import axios from 'axios';
import AOS from 'aos';
import 'aos/dist/aos.css';
import foooter from '@/components/foooter.vue';
import Navigation from '@/components/navigation.vue';

export default {
  components: { foooter, Navigation },
  data() {
    return {
      showRegister: true,
      name: '',
      prenom: '',
      email: '',
      password: '',
      repeatPassword: '',
      termsAccepted: false,
      rememberMe: false,
      showNotification: false,
      notificationTitle: '',
      notificationMessage: ''
    };
  },
  methods: {
    toggleForms() {
      this.showRegister = !this.showRegister;
    },
    registerUser() {
      if (this.password !== this.repeatPassword) {
        this.showNotificationMessage('Error', 'Passwords do not match!');
        return;
      }

      axios.post('http://127.0.0.1:8000/api/users', {
        name: this.name,
        prenom: this.prenom,
        email: this.email,
        password: this.password
      })
      .then(response => {
        this.showNotificationMessage('Registration Successful', 'Please check your email for verification.');
        this.verifyEmail(response.data.id);
      })
      .catch(error => {
        this.showNotificationMessage('Registration Error', error.response.data.message || 'An error occurred.');
        console.error('Error registering user:', error.response.data);
      });
    },
    verifyEmail(id) {
      axios.get(`http://127.0.0.1:8000/api/verify-email/${id}`)
        .then(response => {
          console.log('Email verified successfully:', response.data);
          
        })
        .catch(error => {
          this.showNotificationMessage('Email Verification Error', error.response.data.message || 'An error occurred.');
          console.error('Error verifying email:', error.response.data);
        });
    },
    async loginUser() {
      try {
        const response = await this.$store.dispatch('loginUser', { email: this.email, password: this.password });
        this.showNotificationMessage('Login Successful', 'Welcome back!');
        const userType = this.$store.getters.userType;
        if (userType === 'parent') {
          this.$router.push('/dashboard/parent');
        } else if (userType === 'animateur') {
          this.$router.push('/dashboard/animateur');
        } else {
          this.$router.push('/register-type');
        }
      } catch (error) {
        this.showNotificationMessage('Login Error', error.message || 'An error occurred.');
        console.error('Login error:', error);
      }
    },
    socialLogin(provider) {
      window.location.href = `http://localhost:8000/api/login/${provider}`;
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

.name-fields,
.password-fields {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.name-field,
.password-field {
  flex: 1;
  margin-right: 8px;
}

.name-field:last-child,
.password-field:last-child {
  margin-right: 0;
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
