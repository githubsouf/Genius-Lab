<template>
  <div class="container">
    <div class="b-shape bg-gray-800"></div>
    <div class="l-shape upper bg-gray-800">
      <p class="text-orange-50" >   Hola ! </p>
      <aside></aside>
    </div>
    <div class="r-shape bg-orange-50"></div>
    <div class="l-shape lower bg-gray-800 text-center font-serif align-middle">
      <img class="icon_astro px-10 relative -ml-14" src="./icons/young-artist-woman-holding-art-supplies-red-wall-removebg-preview.png" alt="">
      <h1 class="mt-9" style="font-size: 30px"></h1>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    buttonText: {
      type: String,
      default: "Default Button Text",
    },
    lowerText: {
      type: String,
      default: "Default Lower Text",
    },
  },
};
</script>

<style scoped>
aside {
  background: repeating-linear-gradient(
    35deg,
    hsl(343 100% 50%) 0px 2px,
    hsl(23 100% 50%) 0px 4px
  );
  mix-blend-mode: multiply;
  animation: none 40000ms infinite linear;
}
@keyframes move {
  100% {
    transform: translate(41px, 0px);
  }
}
p {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 5vmin;
  font-weight: 800;
}
.container {
  display: grid;
  grid-template-columns: 150px 150px;
  grid-template-rows: 100px 150px;
  width: 300px;
  height: 300px;
  background: transparent;
  position: relative;
}


.b-shape {
  background-color: #1f2937;
  border-radius: 30px;
  grid-column: 1 / 3;
  grid-row: 1 / 2;
  margin-top: 60px;
}

.l-shape {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid rgba(0, 0, 0, 0);
}

.l-shape.upper {
  background-color: #1f2937;
  border-radius: 30px 30px 0 0;
  grid-column: 2 / 2;
  grid-row: 1 / 2;
}

.l-shape.lower {
  background-color: #1f2937;
  border-radius: 30px 0px 30px 30px;
  grid-column: 1 / 3;
  grid-row: 2 / 2;
  color: white;
  text-align: center;
  font-family: serif;
}

.r-shape {
  border-radius: 30px 30px 30px 0;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}





.icon_astro {
  margin-top: -155px; /* Exceed the size from the top by a negative margin */
}

h1 {
  font-size: 20px;
  margin: 0;
}
</style>
