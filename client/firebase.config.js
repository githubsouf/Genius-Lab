// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyB7wfuYhpDylSvKclCBYEc3bBHvefKzovc",
  authDomain: "genuis-lab.firebaseapp.com",
  projectId: "genuis-lab",
  storageBucket: "genuis-lab.appspot.com",
  messagingSenderId: "364197355479",
  appId: "1:364197355479:web:9669d01c71ef61b2bb7592",
  measurementId: "G-8MZLZ4LEES"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);