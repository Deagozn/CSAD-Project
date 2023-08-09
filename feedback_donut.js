import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-app.js';
import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-firestore.js';

const firebaseConfig = {
    apiKey: "AIzaSyA5vf23nXwW2pAZCxvz4WS9xQnGfw6m_5U",
    authDomain: "kiasu-library.firebaseapp.com",
    projectId: "kiasu-library",
    storageBucket: "kiasu-library.appspot.com",
    messagingSenderId: "705816096294",
    appId: "1:705816096294:web:7d9c3c61ef9d254fed40e7",
    measurementId: "G-VSS8SG1LQ9"
};

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

const collectionRef_bug = collection(db, "feedback_bug");
const collectionRef_fb = collection(db, "feedback_feedback");
const collectionRef_others = collection(db, "feedback_others");

// Fetch data from multiple collections
Promise.all([
    getDocs(collectionRef_bug),
    getDocs(collectionRef_fb),
    getDocs(collectionRef_others)
])
.then(([querySnapshot_bug, querySnapshot_fb, querySnapshot_others]) => {
    const count_bug = querySnapshot_bug.size;
    const count_fb = querySnapshot_fb.size;
    const count_others = querySnapshot_others.size;

    // ApexCharts options and config
    const getChartOptions = () => {
        return {
            series: [count_bug, count_fb, count_others],
            colors: ["#0047AB", "#0096FF", "#000080"],
            chart: {
              height: 320,
              width: "100%",
              type: "donut",
            },
            stroke: {
              colors: ["transparent"],
              lineCap: "",
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: true,
                    name: {
                      show: true,
                      fontFamily: "Inter, sans-serif",
                      offsetY: 20,
                    },
                    total: {
                      showAlways: true,
                      show: true,
                      label: "Total Feedback",
                      fontFamily: "Inter, sans-serif",
                      formatter: function (w) {
                        const sum = w.globals.seriesTotals.reduce((a, b) => {
                          return a + b
                        }, 0)
                        return `${sum}`
                      },
                    },
                    value: {
                      show: true,
                      fontFamily: "Inter, sans-serif",
                      offsetY: -20,
                      formatter: function (value) {
                        return value 
                      },
                    },
                  },
                  size: "70%",
                },
              },
            },
            grid: {
              padding: {
                top: -2,
              },
            },
            labels: ["Bugs", "Feedback", "Others"],
            dataLabels: {
              enabled: false,
            },
            legend: {
              position: "bottom",
              fontFamily: "Inter, sans-serif",
            },
            yaxis: {
              labels: {
                formatter: function (value) {
                  return value 
                },
              },
            },
            xaxis: {
              labels: {
                formatter: function (value) {
                  return value 
                },
              },
              axisTicks: {
                show: false,
              },
              axisBorder: {
                show: false,
              },
            },
        }
    }

    // Create the chart instance
    const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());

    // Render the chart
    chart.render();
})
.catch((error) => {
    console.error("Error getting collection documents:", error);
});

