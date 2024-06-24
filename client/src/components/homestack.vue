<template>
  <div class="grid-container">
    <div
      class="grid-item bg-transparent hover:rotate-45"
      style="grid-column: 5; grid-row: 1"
    >
      <img src="./icons/7.png" alt="Icon" />
    </div>
    <div
      class="grid-item larger bg-neutral-200"
      data-aos="fade-up-right"
      data-aos-duration="1500"
      style="grid-column: 1 / span 2; grid-row: 1"
    ></div>
    <div
      class="grid-item larger bg-neutral-200"
      data-aos="fade-up-left"
      data-aos-duration="1500"
      style="grid-column: 1 / span 2; grid-row: 3"
    ></div>
    <div
      class="grid-item bg-neutral-200"
      data-aos="fade-up-right"
      data-aos-duration="1500"
      style="grid-column: 3 / span 3; grid-row: 3"
    ></div>

    <button
      class="grid-item bg-gray-800 text-orange-50 font-serif button-hover"
      style="grid-column: 3; grid-row: 1"
      data-aos="fade-down-left" data-aos-duration="1500"
    >
      <h1 class="" style="font-size: 30px">
        <span
          class="underline decoration-sky-500"
          style="font-size: 40px; font-weight: bold"
          >+500</span
        >
        <br />
        Parents per <br />
        month
      </h1>
    </button>
    <div
      class="grid-item bg-neutral-200"
      data-aos="zoom-in-down"
      data-aos-duration="1500"
      style="grid-column: 1 / span 3; grid-row: 2"
    >
      <img src="./icons/02.png" class="object-fit-cover" alt="03" />
    </div>
    <button
      class="grid-item bg-gray-800 text-orange-50 font-serif button-hover"
      data-aos="fade-down-left"
      data-aos-duration="1500"
      style="grid-column: 4; grid-row: 2"
    >
      <h1 class="" style="font-size: 30px">
        <span
          class="underline decoration-sky-500"
          style="font-size: 40px; font-weight: bold"
          >1K</span
        >
        <br />
        Highly trained animators
      </h1>
    </button>
  </div>
</template>

<style scoped>
.grid-container {
  display: grid;
  grid-template-columns: repeat(5, 1fr); /* Equal width columns */
  grid-template-rows: repeat(4, 200px); /* Equal height rows */
  gap: 15px; /* Increase gap for better spacing */
  width: calc(100% - 20px); /* Account for the margin */
  max-width: 1200px; /* Maximum width for large screens */
  min-width: 600px; /* Minimum width for smaller screens */
  margin: 0 auto; /* Center the container */
}

.grid-item {
  border-radius: 30px; /* Adjust border radius for rounded corners */
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 36px; /* Increase font size for bigger text */
  transition: transform 0.3s ease; /* Transition for hover effect */
}

.button-hover:hover {
  transform: translateY(-10px); /* Hover animation */
}

.larger {
  font-size: 48px; /* Larger font size for larger items */
}

.low {
  font-size: 24px; /* Smaller font size for low item */
}

.object-fit-cover {
  object-fit: cover; /* Make image cover its container */
}

@media (max-width: 1200px) {
  .grid-container {
    width: 100%; /* Adjust to full width on smaller screens */
  }

  .grid-item {
    font-size: 28px; /* Adjust font size for smaller screens */
  }

  .larger {
    font-size: 36px; /* Adjust font size for larger items on smaller screens */
  }

  .low {
    font-size: 20px; /* Adjust font size for low items on smaller screens */
  }
}

@media (max-width: 768px) {
  .grid-container {
    grid-template-columns: repeat(2, 1fr); /* Two columns on smaller screens */
    grid-template-rows: repeat(4, 150px); /* Adjust row height */
  }

  .grid-item {
    font-size: 20px; /* Adjust font size for smaller screens */
  }

  .larger {
    font-size: 28px; /* Adjust font size for larger items on smaller screens */
  }

  .low {
    font-size: 16px; /* Adjust font size for low items on smaller screens */
  }
}
</style>
