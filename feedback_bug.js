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


// Initialize Firebase
const app = initializeApp(firebaseConfig);

const db = getFirestore(app);

// Function to generate a feedback card
async function generateFeedbackCard(data) {
    let cardHtml = `
        <div class="flex border rounded-lg shadow-md p-4 mt-4 bg-blue-400">
    `;

    if (data.imageData) {
        let imageUrl = 'Resources/noImage.png'; // Default placeholder image URL

        try {
            const blob = await fetch(data.imageData).then((response) => response.blob());
            imageUrl = URL.createObjectURL(blob);
        } catch (error) {
            console.error('Error decoding image data:', error);
        }

        cardHtml += `
            <div class="w-1/4">
                <img src="${imageUrl}" alt="Feedback Image" class="w-32 h-auto object-cover">
            </div>
        `;
    } else {
        // Use placeholder image when no imageData is available
        cardHtml += `
            <div class="w-1/4">
                <img src="Resources/noImage.png" alt="Placeholder Image" class="w-32 h-auto object-cover">
            </div>
        `;
    }

    cardHtml += `
            <div class="flex-1 ml-4">
                <p class="text-gray-600"> ${data.description}</p>
            </div>
        </div>
    `;

    return cardHtml;
}

// Function to fetch and display feedback cards
async function displayFeedbackCards() {
    console.log("Fetching feedback...");
    try {
        const querySnapshot = await getDocs(collection(db, "feedback_bug")); // Specify the collection name
        const feedbackContainer = document.getElementById("feedbackContainer");
        console.log("Number of feedback documents:", querySnapshot.size);
        
        for (const doc of querySnapshot.docs) {
            const feedbackData = doc.data();
            const feedbackCard = await generateFeedbackCard(feedbackData);
            feedbackContainer.innerHTML += feedbackCard;
        }
        console.log("Finished displaying feedback.");
    } catch (error) {
        console.log("Error fetching feedback:", error);
    }
}

// Call the function to display feedback cards
console.log("Initializing...");
displayFeedbackCards();

