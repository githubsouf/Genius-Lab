<template>
  <div class="card">
    <div class="flex">
      <img :src="props.movie.thumbnail" alt="">
      <h5 class="card-text">{{  props.movie.title  }}</h5>
      <div class="genre card-text">{{  props.movie.genres.toString().replaceAll(',', ', ')  }}</div>
    </div>
    <div class="year card-text">{{  props.movie.year  }}</div>
  </div>
</template>

<script setup>
const props = defineProps({
  movie: Object
})
</script>

<style scoped>
.card {
  padding: 0.7rem;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background: #fff;
  border: 1px solid rgba(2, 28, 62, .03);
  box-shadow: 3px 2px 25px rgba(2, 129, 255, .03);
  gap: 1rem;
  cursor: pointer;
  text-align: left;
}

.card-text {
  padding: 0 0.5rem;
}

img {
  width: 100%;
  border-radius: 6px;
  object-fit: cover;
  transition: 0.3s;
  height: 350px;
}

h5.card-text {
  font-size: 1.2rem;
  font-weight: 600;
  padding-top: 1rem;
  padding-bottom: 0.2rem;
}

.genre {
  font-size: 0.9rem;
}

.year {
  color: #ffab2d;
  padding-bottom: 0.5rem;
}

.flex {
  display: flex;
  flex-direction: column;
}

.card:hover img {
  transform: scale(1.15) translateY(-30px);
  box-shadow: 3px 2px 25px rgba(2, 129, 255, .03);
}
</style>