<template>
  <div class="container">
    <div class="b-shape bg-neutral-200"></div>
    <div class="l-shape upper bg-neutral-200"><img src="@/assets/Design sans titre (5).svg" alt="SVG Image" class="ml-10 mt-5" /></div>
    <div class="r-shape bg-orange-50"></div>
    <button class="other bg-neutral-200 align-middle p-2 rounded-full jump-on-hover">
      <img src="./icons/noun-arrow-4110991 (1).svg" alt="Arrow Image" class="arrow-icon" />
    </button>
    <div class="l-shape lower bg-neutral-200 text-center items-center font-serif align-middle">
      <h1 class="mt-9" style="font-size: 30px">
        Student learning <br />
        stays <a class="underline decoration-pink-500">on track</a> to meet<br />
        target
      </h1>
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
  grid-template-columns: 200px 120px;
  grid-template-rows: 115px 200px;
  width: 300px;
  height: 300px;
  background: transparent;
  position: relative;
}

.b-shape {
  border-radius: 30px;
  grid-column: 1 / 3;
  grid-row: 1 / 2;
  margin-top: 40px;
}

.l-shape {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid rgba(0, 0, 0, 0);
}

.l-shape.upper {
  border-radius: 30px 30px 0 0;
  grid-column: 1 / 1;
  grid-row: 1 / 2;
}

.l-shape.lower {
  border-radius: 0 30px 30px 30px;
  grid-column: 1 / 3;
  grid-row: 2 / 2;
  color: black;
  text-align: center;
  font-family: serif;
}

.r-shape {
  border-radius: 30px;
  grid-column: 2 / 2;
  grid-row: 1 / 2;
}

.other {
  grid-column: 2 / 2;
  grid-row: 1 / 2;
  border-radius: 50%;
  margin: 10px;
}

.arrow-icon {
  width: 70px;
  height: 70px;
}

.jump-on-hover {
  transition: transform 0.3s ease;
}

.jump-on-hover:hover {
  transform: translate(5px, -5px);
}

h1 {
  font-size: 20px;
  margin: 0;
}
</style>
