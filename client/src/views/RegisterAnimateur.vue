<template>
    <div>
      <Navigation />
      <div id="register-animateur" class="register-animateur-container">
        <div class="block_top">
          <h1>Scroll down to answer the form questions</h1>
        </div>
        <div class="cards">
          <ul class="nav">
            <li><a href="#card1"><div class="circle active 1">1</div></a></li>
            <li><a href="#card2"><div class="circle 2">2</div></a></li>
            <li><a href="#card3"><div class="circle 3">3</div></a></li>
            <li><a href="#card4"><div class="circle 4">4</div></a></li>
            <li><a href="#card5"><div class="circle 5">5</div></a></li>
            <li><a href="#card6"><div class="circle 6">6</div></a></li>
            <li><a href="#card7"><div class="circle 7">7</div></a></li>
            <li><a href="#card8"><div class="circle 8">8</div></a></li>
          </ul>
          <div v-for="(question, index) in questions" :key="index" :class="['custom-card', `card${index + 1}`]" :id="`card${index + 1}`">
            <h1 class="subtitle">{{ question.title }}</h1>
            <p class="description">{{ question.description }}</p>
            <input
              v-if="question.type === 'text'"
              v-model="formData[question.field]"
              :placeholder="question.placeholder"
              class="input-field"
              type="text"
            />
            <input
              v-if="question.type === 'date'"
              v-model="formData[question.field]"
              class="input-field"
              type="date"
            />
          </div>
          <div class="custom-card card9" id="card9">
            <h1 class="subtitle">It's done! Welcome to Genius Lab</h1>
            <button @click="submitForm" class="submit-button">Submit</button>
          </div>
        </div>
        <div class="next_block"><h1>scroll up ;)</h1></div>
      </div>
    </div>
  </template>
  
  <script>
  import Navigation from '@/components/navigation.vue';
  import gsap from 'gsap';
  import ScrollTrigger from 'gsap/ScrollTrigger';
  import ScrollToPlugin from 'gsap/ScrollToPlugin';
  import axios from 'axios';
  
  gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
  
  export default {
    components: {
      Navigation
    },
    data() {
      return {
        formData: {
          title: '',
          country: '',
          city: '',
          postal: '',
          address: '',
          province: '',
          photo: '',
          telephone: '',
          date_naissance: '',
        },
        questions: [
          { title: 'Quel est votre titre professionnel ?', description: 'Un titre clair et précis nous aide à comprendre immédiatement votre spécialité.', field: 'title', type: 'text', placeholder: 'Titre professionnel' },
          { title: 'Quel est votre pays ?', description: 'Indiquez le pays où vous résidez actuellement.', field: 'country', type: 'text', placeholder: 'Pays' },
          { title: 'Quelle est votre ville ?', description: 'Indiquez la ville où vous résidez actuellement.', field: 'city', type: 'text', placeholder: 'Ville' },
          { title: 'Quel est votre code postal ?', description: 'Indiquez le code postal de votre région.', field: 'postal', type: 'text', placeholder: 'Code postal' },
          { title: 'Quelle est votre adresse complète ?', description: 'Indiquez votre adresse complète.', field: 'address', type: 'text', placeholder: 'Adresse complète' },
          { title: 'Quelle est votre province ?', description: 'Indiquez votre province.', field: 'province', type: 'text', placeholder: 'Province' },
          { title: 'Téléchargez votre photo.', description: 'Facultatif : Une photo permet de mettre un visage sur votre nom.', field: 'photo', type: 'text', placeholder: 'URL de la photo' },
          { title: 'Quel est votre numéro de téléphone ?', description: 'Indiquez votre numéro de téléphone.', field: 'telephone', type: 'text', placeholder: 'Numéro de téléphone' },
          { title: 'Quelle est votre date de naissance ?', description: 'Indiquez votre date de naissance.', field: 'date_naissance', type: 'date' },
        ],
      };
    },
    methods: {
      submitForm() {
        const token = this.$store.state.token;
        axios.post('http://127.0.0.1:8000/api/animateurs', this.formData, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        })
        .then(response => {
          console.log('Animateur registered successfully:', response.data);
          this.$router.push('/dashboard/animateur');
        })
        .catch(error => {
          console.error('Error registering animateur:', error.response.data);
          // Handle error, such as displaying an error message to the user
        });
      }
    },
    mounted() {
      let tl = gsap.timeline({
        scrollTrigger: {
          trigger: ".cards",
          pin: true,
          pinSpacing: true,
          start: "top top", // when the top of the trigger hits the top of the viewport
          end: "+=2000", // end after scrolling 2000px beyond the start
          scrub: 1, // smooth scrubbing, takes 1 second to "catch up" to the scrollbar
        }
      });
      
      this.questions.forEach((question, index) => {
        let nextIndex = index + 1;
        tl.addLabel(`card${nextIndex}`);
        
        if (index === 0) {
          tl.to(`.card${nextIndex}`, { yPercent: 0, opacity: 1 });
        } else {
          tl.from(`.card${nextIndex}`, { yPercent: 75, opacity: 0 });
          tl.addLabel(`card${nextIndex}`);
          tl.add(() => setActiveNav(tl.scrollTrigger.direction > 0 ? nextIndex : index), "-=0.15");
          tl.to(`.card${index}`, { scale: 0.95, yPercent: -0.5, opacity: 0.7 }, "-=0.3");
          tl.to(`.card${nextIndex}`, { yPercent: 0, opacity: 1 });
        }
      });
  
      // Add the last card for submit button
      let lastIndex = this.questions.length + 1;
      tl.from(`.card${lastIndex}`, { yPercent: 75, opacity: 0 });
      tl.addLabel(`card${lastIndex}`);
      tl.add(() => setActiveNav(tl.scrollTrigger.direction > 0 ? lastIndex : this.questions.length), "-=0.15");
      tl.to(`.card${this.questions.length}`, { scale: 0.95, yPercent: -0.5, opacity: 0.7 }, "-=0.3");
      tl.to(`.card${lastIndex}`, { yPercent: 0, opacity: 1 });
  
      gsap.utils.toArray(".nav a").forEach((a, i) => {
        a.addEventListener("click", e => {
          e.preventDefault();
          let pad = i === 0 ? 0 : tl.scrollTrigger.direction > 0 ? 2 : -2;
          gsap.to(window, {scrollTo: labelToScroll(tl, `card${i + 1}`) + pad});
        });
      });
      
      function labelToScroll(timeline, label) {
        let st = timeline.scrollTrigger,
            progress = timeline.labels[label] / timeline.duration();
        return st.start + (st.end - st.start) * progress;
      }
      
      let circles = gsap.utils.toArray(".nav .circle");
      
      function setActiveNav(index) {
        circles.forEach((circle, i) => circle.classList[i === index ? "add" : "remove"]("active"));
      }
    }
  };
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
  
  body {
    background: #FFEFD5; /* Soft orange background */
  }
  
  .block_top {
    background: #ff8c00; /* Dark orange */
    height: 80vh;
    margin-top: 20px; 
    margin-bottom: 40px;
    margin-left: 10px;
    margin-right: 10px;
    color: #FFFFFF; /* White text */
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
    font-weight: 700;
    font-size: 5rem;
    font-family: 'Montserrat', sans-serif;
    text-align: center;
    padding: 0 20px;
  }
  
  .next_block {
    background: #f8f7f6; /* Dark orange */
    height: 100vh;
    color: #FFFFFF; /* White text */
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
  }
  
  .cards {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
  }
  
  .custom-card {
    position: absolute;
    width: calc(100% - 40px);
    top: 0;
    height: calc(100vh - 40px);
    margin: 20px;
    background-color: #FF8C00; /* Dark orange */
    color: #FFFFFF; /* White text */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.2);
    text-align: center;
  }
  
  .subtitle {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 20px;
    font-family: 'Montserrat', sans-serif;
  }
  
  .description {
    font-size: 2rem;
    color: #FFFFFF; /* White text */
    margin-bottom: 20px;
    font-family: 'Montserrat', sans-serif;
  }
  
  .input-field {
    width: 80%;
    padding: 15px;
    border: 2px solid #ced4da;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 1.5rem;
  }
  
  .submit-button {
    background-color: #FF8C00; /* Transparent background */
    color: white;
    border: 2px solid #FFFFFF; /* White border */
    padding: 15px 30px;
    cursor: pointer;
    border-radius: 30px;
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
    transition: background-color 0.3s;
    margin-top: 20px;
  }
  
  .submit-button:hover {
    background-color: #FFFFFF; /* White background on hover */
    color: #FF8C00; /* Dark orange text on hover */
  }
  
  .nav {
    display: block;
    position: absolute;
    left: 30px;
    top: 45%;
    z-index: 10;
  }
  
  .nav li {
    padding: 2px;
  }
  
  .nav li a {
    text-decoration: none;
  }
  
  .nav .circle {
    border: 1px solid #FFFFFF; /* White border */
    color: #FFFFFF; /* White text */
    width: 25px;
    height: 25px;
    text-align: center;
    border-radius: 25px;
    transition: 0.4s ease;
  }
  
  .nav .active {
    background: #FFFFFF; /* White background */
    color: #FF8C00; /* Dark orange text */
  }
  </style>
  #FF8C00