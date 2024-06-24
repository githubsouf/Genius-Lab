<template>
  <div class="container">
    <div class="b-shape"></div>
    <div class="l-shape upper">
      <h1>
        Contact Us <a class="underline decoration-sky-500">+212650069930</a> Now
      </h1>
    </div>
    <div class="r-shape bg-orange-50"></div>
    <button class="other jump-on-hover">
      <img src="./icons/item/Pose 05.png" class="arrow-icon" />
    </button>
    <div class="l-shape lower">
      <img src="./icons/7.png" class="planet" />
      <div class="text-container">
        <h1>Explore the Future with Us</h1>
        <p>Join our innovative workshops and stay ahead with the latest trends and skills.</p>
      </div>
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
.container {
  display: grid;
  grid-template-columns: 700px 200px;
  grid-template-rows: 150px 300px;
  width: 800px;
  height: 800px;
  background: transparent;
  position: relative;
  margin: 0 auto; /* Center the container horizontally */
}

.b-shape {
  background-color: #1f2937;
  border-radius: 30px;
  grid-column: 1 / 3;
  grid-row: 1 / 2;
  margin-top: 60px;
  margin-right: 20px;
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
  grid-column: 1 / 1;
  grid-row: 1 / 2;
  color: white;
  font-family: sans-serif;
  font-size: 36px; /* Increased font size */
  text-align: center;
  padding: 10px;
}

.l-shape.lower {
  background-color: #1f2937;
  border-radius: 0 30px 30px 30px;
  grid-column: 1 / 3;
  grid-row: 2 / 2;
  color: white;
  text-align: center;
  font-family: serif;
  padding: 20px;
  position: relative;
  font-size: 24px; /* Increased font size */
}

.r-shape {
  border-radius: 30px;
  grid-column: 2 / 2;
  grid-row: 1 / 2;
}

.other {
  background-color: #d1d5db;
  border-radius: 30%;
  position: absolute;
  right: -90px;
  width: 170px;
  height: 140px;
}

.jump-on-hover {
  transition: transform 0.3s ease;
}

.jump-on-hover:hover {
  transform: translate(2px, -5px);
}

.arrow-icon {
  width: 100%;
  height: 100%;
}

.text-container {
  z-index: 1;
  padding: 20px;
  font-size: 20px; /* Increased font size */
}

.planet {
  width: 200px;
  position: absolute;
  top: 10px;
  right: 10px;
  z-index: -1;
}

@media screen and (max-width: 768px) {
  .container {
    transform: scale(0.5); /* Scale down for smaller screens */
    transform-origin: top left;
  }

  .other {
    width: 100px;
    height: 100px;
    padding: 20px;
  }

  .arrow-icon {
    width: 100%;
    height: 100%;
  }

  .text-container {
    font-size: 16px; /* Adjusted font size for smaller screens */
  }
}
</style>
