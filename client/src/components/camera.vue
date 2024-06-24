<template>
    <div>
      <video id="vid" width="500" height="400" autoplay playsinline muted></video>
      <br />
      <button @click="openWebcam">Open Webcam</button>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      openWebcam() {
        let video = document.getElementById("vid");
        
  
        // Check if getUserMedia is supported
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
          navigator.mediaDevices
            .getUserMedia({ video: true, audio: true })
            .then((stream) => {
              video.srcObject = stream;
              video.onloadedmetadata = () => {
                video.play();
              };
            })
            .catch((error) => {
              console.error("Error accessing webcam:", error);
              alert("Failed to access webcam!");
            });
        } else {
          console.error("getUserMedia not supported.");
          alert("Webcam access not supported in this browser.");
        }
      },
    },
  };
  </script>
  
  <style scoped>
    div {
      width: 500px;
      height: 400px;
      border: 2px solid black;
      position: relative;
    }
  
    video {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  
    button {
      margin-top: 10px;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
      font-size: 16px;
      border-radius: 5px;
    }
  
    button:hover {
      background-color: #7800f0;
    }
  </style>
  