<template>
    <div>
      <div class="cards">
        <ul class="nav">
          <li><a href="#card1"><div class="circle active 1 ">1</div></a></li>
          <li><a href="#card2"><div class="circle 2">2</div></a></li>
          <li><a href="#card3"><div class="circle 3">3</div></a></li>
          <li><a href="#card4"><div class="circle 4">4</div></a></li>
          <li><a href="#card5"><div class="circle 5">5</div></a></li>
        </ul>
        <div v-for="(content, index) in contents" :key="index" :class="['custom-card', `card${index + 1}`]" :id="`card${index + 1}`">
          <h1 class="subtitle">{{ content.title }}</h1>
          <p class="description">{{ content.description }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import gsap from 'gsap';
  import ScrollTrigger from 'gsap/ScrollTrigger';
  import ScrollToPlugin from 'gsap/ScrollToPlugin';
  
  gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
  
  export default {
    data() {
      return {
        contents: [
          { title: 'Bienvenue sur notre site!', description: 'Nous avons des méthodes de sécurisation très avancées pour l\'inscription.' },
          { title: 'Inscription sécurisée', description: 'Choisissez si vous êtes un animateur ou un parent.' },
          { title: 'Découverte des ateliers', description: 'Pour les parents, découvrez les ateliers et offres actuels.' },
          { title: 'Inscription aux ateliers', description: 'Inscrivez vos enfants aux ateliers.' },
          { title: 'Accès pour les animateurs', description: 'Les animateurs peuvent s\'inscrire aux meilleurs ateliers selon leurs disponibilités.' },
        ],
      };
    },
    mounted() {
      let tl = gsap.timeline({
        scrollTrigger: {
          trigger: ".cards",
          pin: true,
          pinSpacing: true,
          start: "top top",
          end: "+=2000",
          scrub: 1,
        }
      });
  
      this.contents.forEach((content, index) => {
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
  
      let lastIndex = this.contents.length + 1;
      tl.from(`.card${lastIndex}`, { yPercent: 75, opacity: 0 });
      tl.addLabel(`card${lastIndex}`);
      tl.add(() => setActiveNav(tl.scrollTrigger.direction > 0 ? lastIndex : this.contents.length), "-=0.15");
      tl.to(`.card${this.contents.length}`, { scale: 0.95, yPercent: -0.5, opacity: 0.7 }, "-=0.3");
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
  .scrolling-cards-container {
    background: transparent;
    border: 2px dotted black;
    padding: 20px;
    border-radius: 10px;
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
    background-color: rgb(236, 230, 230);
    color: #000;
    border: 2px dotted black;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.2);
    text-align: center;
  }
  
  .subtitle {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
  }
  
  .description {
    font-size: 1.5rem;
    margin-bottom: 20px;
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
    border: 1px solid rgba(0, 0, 0, 0);
    color: rgba(0, 0, 0, 0);
    width: 25px;
    height: 25px;
    text-align: center;
    border-radius: 25px;
    transition: 0.4s ease;
  }
  
  .nav .active {
    background: rgba(0, 0, 0, 0);
    color: rgba(255, 255, 255, 0);
  }
  </style>
  