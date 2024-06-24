<template>
    <div class = "page-container content-center">
    <div class="container" :class="{ active: isActive === 'sign-up' }">
      <div class="form-container sign-up" v-show="isActive === 'sign-up'">
        <div v-show="form === 'default'" class="options">
          <form @submit.prevent="handleChooseProfil" class="profile-form">
            <h1 class="title">Join as a parent or an animator</h1>
            <div class="profile-options">
              <label class="profile-option" id="parent">
                <input
                  type="radio"
                  name="profileType"
                  class="d-none"
                  id="parent"
                  checked
                />
                <div class="profile-card">
                  <div class="content_head">I'm a parent</div>
                  <div class="content_sub">Select this if you are a parent</div>
                </div>
              </label>
              <label class="profile-option" id="animator">
                <input
                  type="radio"
                  name="profileType"
                  class="d-none"
                  id="animator"
                />
                <div class="profile-card">
                  <div class="content_head">I'm an animator</div>
                  <div class="content_sub">
                    Select this if you are an animator
                  </div>
                </div>
              </label>
            </div>
            <button
              type="submit"
              class="btn-submit"
              id="submitchoice"
              @click="handleChooseProfil"
            >
              Create Account
            </button>
          </form>
        </div>
        <div class="form-container sign-up" v-show="form === 'p-form'">
          <form @submit.prevent="handleSubmit">
            <h1>Create Account</h1>
            <Field
              name="firstName"
              v-model="firstName"
              type="text"
              placeholder="First Name"
              rules="required"
            />
            <ErrorMessage name="firstName" class="error-message" />
            <Field
              name="lastName"
              v-model="lastName"
              type="text"
              placeholder="Last Name"
              rules="required"
            />
            <ErrorMessage name="lastName" class="error-message" />
            <Field
              name="email"
              v-model="email"
              type="email"
              placeholder="Email"
              rules="required|email"
            />
            <ErrorMessage name="email" class="error-message" />
            <Field
              name="password"
              v-model="password"
              type="password"
              placeholder="Password"
              rules="required|min:8"
            />
            <ErrorMessage name="password" class="error-message" />
            <div class="checkbox-container">
              <label class="checkbox-label" id="check1">
                <input type="checkbox" name="checkbox-name" value="option1" />
                <span class="checkbox-checkmark"></span>
                Send me emails with tips on how to find talent that fits my needs.
              </label>
  
              <label class="checkbox-label" id="check2">
                <input type="checkbox" name="checkbox-name" value="option2" />
                <span class="checkbox-checkmark"></span>
                Yes, I understand and agree to the Upwork Terms of Service,
                including the User Agreement and Privacy Policy.
              </label>
            </div>
            <button type="submit" @click="handleSignUp">Submit</button>
          </form>
        </div>
      </div>
      <div class="form-container sign-in" v-show="isActive === 'sign-in'">
        <form @submit.prevent="handleSignIn">
          <h1>Sign In</h1>
          
          <Field
            name="email"
            v-model="email"
            type="email"
            placeholder="Email"
            rules="required|email"
          />
          <ErrorMessage name="email" class="error-message" />
          <Field
            name="password"
            v-model="password"
            type="password"
            placeholder="Password"
            rules="required|min:8"
          />
          <ErrorMessage name="password" class="error-message" />
          <a href="#" @click="handleForgotPassword">Forget Your Password?</a>
          
          <button type="submit" id="submit-SignIn">Sign In</button>
        </form>
       
      </div>
  
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left" @click="showSignInForm">
            <h1>Hello, Friend!</h1>
            <p>Choose Your Profil</p>
            <button>Sign In</button>
          </div>
          <div class="toggle-panel toggle-right" @click="showSignUpForm">
            <h1>Welcome Back!</h1>
            <p>Enter your personal details to use all site features</p>
            <button id="submit-Signup">Sign Up</button>
            
            
          </div>
        </div>
      </div>
     
    </div>
    <!-- <camera/> -->
  </div>
    
  </template>
  
  <script>
  import { defineComponent, ref } from "vue";
  import { useRouter } from "vue-router";
  import { useForm, useField, ErrorMessage, Field } from "vee-validate";
  import * as yup from "yup";
  import camera from "@/components/camera.vue"; // Added a comma after ErrorMessage
  
  
  export default defineComponent({
    components: {
    Field,
    ErrorMessage, // Added a comma after ErrorMessage
    camera,
  },
    setup() {
      const router = useRouter();
      const isActive = ref("sign-in"); // Contrôle l'affichage des formulaires
      const form = ref("default"); // Contrôle l'affichage des formulaires
      const selectedProfile = ref(null);
      const openmodal =ref(false);
  
      function createAccount(accountDetails) {
        // Simuler un délai réseau
        return new Promise((resolve, reject) => {
          setTimeout(() => {
            // Simuler une réponse
            if (accountDetails.email !== "existing@example.com") {
              resolve({ isSuccess: true, data: { id: 123, ...accountDetails } });
            } else {
              reject({ isSuccess: false, message: "Email already exists." });
            }
          }, 1000);
        });
      }
  
      const handleForgotPassword = () => {
        console.log("Redirection to: /password-reset");
        router.push("/password-reset");
      };
      const openn = () =>  {
        openmodal.value = true;
      };
  
      const handleChooseProfil = () => {
        const parentElement = document.getElementById("parent");
        const animatorElement = document.getElementById("animator");
        if (parentElement.checked) {
          selectedProfile.value = "parent";
        } else if (animatorElement.checked) {
          selectedProfile.value = "animator";
        }
        form.value = "p-form";
      };
  
      // Configuration des validations pour les deux formulaires
      const { handleSubmit, errors } = useForm({
        validationSchema: yup.object({
          firstName: yup.string().required("First name is required"),
          lastName: yup.string().required("Last name is required"),
          email: yup
            .string()
            .required("Email is required")
            .email("Email must be a valid email address"),
          password: yup
            .string()
            .required("Password is required")
            .min(8, "Password must be at least 8 characters long")
            .matches(
              /[a-z]/,
              "Password must contain at least one lowercase letter"
            )
            .matches(
              /[A-Z]/,
              "Password must contain at least one uppercase letter"
            )
            .matches(/[0-9]/, "Password must contain at least one number")
            .matches(
              /[@$!%*#?&]/,
              "Password must contain at least one special character @$!%*#?&"
            ),
        }),
      });
  
      // Configuration des champs pour la réactivité avec VeeValidate
      const { value: firstName } = useField("firstName");
      const { value: lastName } = useField("lastName");
      const { value: email } = useField("email");
      const { value: password } = useField("password");
  
      // Mock authentication function
      async function authenticateUser(email, password) {
        // Simulate a network delay
        await new Promise((resolve) => setTimeout(resolve, 1000));
  
        // Mock condition to simulate authentication
        if (email === "test@example.com" && password === "password123") {
          return { isValidUser: true }; // Simulate successful login
        } else {
          return { isValidUser: false }; // Simulate failed login
        }
      }
  
      // Gestion du formulaire de connexion
      const handleSignIn = async () => {
        console.log("Attempting to sign in");
        try {
          // Example: Placeholder for your authentication logic
          const user = await authenticateUser(email.value, password.value);
          if (user.isValidUser) {
            console.log("Login successful, navigating to dashboard");
            router.push("/dashboard").catch((err) => {
              console.error("Router push failed due to: ", err);
            });
          } else {
            console.log("Login failed: Invalid credentials");
            alert("Invalid credentials!");
          }
        } catch (error) {
          console.error("Login error:", error);
          alert("Login failed!");
        }
      };
  
      const handleSignUp = async () => {
        event.preventDefault(); // Prevent the default form submission
        console.log("Form submitted");
        try {
          const accountDetails = {
            firstName: firstName.value,
            lastName: lastName.value,
            email: email.value,
            password: password.value,
          };
  
          // Afficher les détails du compte dans la console pour vérification.
          console.log("Account Details:", accountDetails);
  
          // Stocker les détails dans localStorage pour simulation.
          localStorage.setItem("accountDetails", JSON.stringify(accountDetails));
  
          // Simuler un succès de création de compte.
          console.log(
            "Account successfully created, navigating to confirmation page"
          );
          router.push("/confirmation"); // Assurez-vous que cette route est correctement définie dans vos paramètres de routeur.
        } catch (error) {
          console.error("Error during sign up:", error);
          alert("Failed to create account due to an error.");
        }
      };
  
      // Fonctions pour basculer entre les formulaires
      const showSignInForm = () => {
        console.log("Affichage du formulaire de connexion");
        isActive.value = "sign-in";
      };
  
      const showSignUpForm = () => {
        console.log("Affichage du formulaire d'inscription");
        isActive.value = "sign-up";
      };
  
      return {
        firstName,
        lastName,
        email,
        password,
        isActive,
        form,
        showSignInForm,
        showSignUpForm,
        handleSignUp,
        handleSignIn,
        handleSubmit,
        handleForgotPassword,
        handleChooseProfil,
        errors,
      };
    },
  });
  </script>
  
  <style scoped>
  @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap");
  
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Montserrat", sans-serif;
  }
  
  
  .page-container {
    background-image: url('../components/icons/09n.png');
    background-size: cover; /* Ensure the background image covers the entire container */
    background-position: center; /* Center the background image */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; 
    width: 100vw; 
    overflow: hidden; 
  }
  
  .container {
    background-image: url('../components/icons/09n.png'); /* Background image */
    background-size: cover;
    background-position: center;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    width: 768px;
    max-width: 100%;
    min-height: 480px;
    display: flex;
    flex-direction: center;
    align-items: center;
    justify-content: center;
    position: relative;
    opacity: 80%;
  }
  
  
  .profile-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 60%;
    text-align: center;
  }
  
  
  .options {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    text-align: center;
  }
  
  .profile-options {
    display: flex;
    width: 100%;
    margin-top: 20px;
  }
  
  .profile-option {
    flex: 1;
    padding: 10px;
    margin: 0 20px;
    cursor: pointer;
  }
  
  
  
  .profile-option input[type="radio"]:checked + .profile-card {
    background-color: #b41ed59b; /* Couleur de fond quand l'option est sélectionnée */
    border-color: #000000;
  }
  
  .profile-card {
    border: 2px solid #252525bd;
    padding: 20px;
    border-radius: 8px;
    display: inline-flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 120px; /* Adjust the width to create a gap between the cards */
    transition: background-color 0.3s, border-color 0.3s;
  }
  
  .profile-card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
  }
  
  
  .btn-submit:hover {
    background-color: #3a1d6e;
  }
  
  
  
  .content_head {
    font-weight: bold;
    font-size: 1.2rem;
  }
  
  .content_sub {
    font-size: 1rem;
    color: #666;
    margin-top: 10px;
  }
  
  .container p {
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
  }
  
  .container span {
    font-size: 12px;
  }
  
  .container a {
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
  }
  
  .container.active .toggle {
    transform: translateX(50%);
  }
  
  .container.active .toggle-container {
    transform: translateX(-100%);
  }
  
  .container button {
    background-color: #494949;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
  }
  
  .container button.hidden {
    background-color: transparent;
    border-color: #fff;
  }
  
  .container form {
    background-color: #ffffff51;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 px;
    height: 100%;
  }
  
  .container input {
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
  }
  
  form {
    width: 90%; /* Réduit la largeur pour un meilleur contrôle */
    margin: initial; /* Centre le formulaire dans son conteneur */
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%; /* Utilise toute la largeur disponible */
    padding: 10px;
    margin: 8px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  
  .error-message {
    color: red;
    font-size: 6em;
    margin-top: 5px;
  }
  
  .form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
  }
  
  .form-container.sign-up,
  .form-container.sign-in {
    opacity: 1; /* Make visible as required */
    z-index: 2;
  }
  
  .sign-in {
    left: 0;
    width: 50%;
    z-index: 2;
  }
  
  .container.active .sign-in {
    transform: translateX(100%);
  }
  
  .sign-up {
    right: 70%;
    width: 80%;
    opacity: 0;
    z-index: 1;
  }
  
  .container.active .sign-up {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
  }
  
  @keyframes move {
    0%,
    49.99% {
      opacity: 0;
      z-index: 1;
    }
    50%,
    100% {
      opacity: 1;
      z-index: 5;
    }
  }
  
  
  
  .toggle-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: transform 0.6s ease-in-out;
    z-index: 1000;
  }
  
  .container.active .toggle-container {
    transform: translateX(-100%);
  }
  
  .toggle {
    background-color: #ff05052b;
    
    background: linear-gradient(to right, #000000, #000000);
    color: #ffffffe9;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: transform 0.9s ease-in-out;
  }
  
  .container.active .toggle {
    transform: translateX(50%);
  }
  
  .toggle-panel {
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
  }
  
  .toggle-left {
    transform: translateX(-100%);
  }
  
  .container.active .toggle-left {
    transform: translateX(0);
  }
  
  .toggle-right {
    right: 0;
    transform: translateX(0);
  }
  
  .container.active .toggle-right {
    transform: translateX(100%);
  }
  
  </style>
  