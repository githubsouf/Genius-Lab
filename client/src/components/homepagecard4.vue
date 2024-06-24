<template>
  <div class="container">
    <div class="b-shape"></div>
    <div class="l-shape upper">
      <box-icon name='basketball' animation='spin' color="white" class="align-left icon"></box-icon>
      <box-icon name='math' animation='tada' color="white" class="icon"></box-icon>
      <button class="other bg-transparent jump-on-hover">
        <img src="./icons/bomb.png" alt="">
      </button>
    </div>
    <div class="r-shape bg-orange-50"></div>
    <div class="l-shape lower">
      <p class="text-orange-50">Learn, Play, Grow, and Thrive!</p>
    </div>
  </div>
</template>

<script>
import 'boxicons';
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
p {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem; /* Fixed size for all devices */
  font-weight: 800;
}

.icon {
  width: 4rem; /* Fixed size for all devices */
  height: 4rem; /* Fixed size for all devices */
}

.container {
  display: grid;
  grid-template-columns: 205px 95px;
  grid-template-rows: 95px 155px;
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
}

.l-shape.lower {
  background-color: #1f2937;
  border-radius: 0 30px 30px 30px;
  grid-column: 1 / 3;
  grid-row: 2 / 2;
  color: white;
  text-align: center;
}

.r-shape {
  border-radius: 30px;
  grid-column: 2 / 2;
  grid-row: 1 / 2;
}

.other {
  padding: 100px; /* Increase padding for length */
  position: absolute;
  right: -120px;
  left: 100px;
}

.jump-on-hover {
  transition: transform 0.3s ease;
}

.jump-on-hover:hover {
  transform: translate(2px, -5px);
}
</style>
