import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-app.js';
import { getFirestore, doc, collection, setDoc, addDoc } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-firestore.js';

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


document.getElementById('feedback_form').addEventListener('submit', handleFormSubmit);

async function handleFormSubmit(event) {
  event.preventDefault();

  const type = document.querySelector('#feedback_type').value;
  const desc = document.getElementById('description').value;

  const fileInput = document.getElementById('dropzone-file');
  const file = fileInput.files[0];

  if (file && file.type.startsWith('image/')) {
    try {
      const imageData = await readFileAsDataURL(file);
      const bitmap = await createImageBitmap(file);
      // Use the 'bitmap' and 'imageData' as needed in your code
      // For example, you can store the 'imageData' in Firestore along with the feedback data

      switch (type) {
        case 'BUG':
          try {
            const docRef = await addDoc(collection(db, 'feedback_bug'), {
              description: desc,
              imageData: imageData,
            });
            console.log('Document written with ID:', docRef.id);
          } catch (error) {
            console.error('Error adding document:', error);
          }
          break;

        case 'FEEDBACK':
          try {
            const docRef = await addDoc(collection(db, 'feedback_feedback'), {
              description: desc,
              imageData: imageData,
            });
            console.log('Document written with ID:', docRef.id);
          } catch (error) {
            console.error('Error adding document:', error);
          }
          break;

        case 'OTHERS':
          try {
            const docRef = await addDoc(collection(db, 'feedback_others'), {
              description: desc,
              imageData: imageData,
            });
            console.log('Document written with ID:', docRef.id);
          } catch (error) {
            console.error('Error adding document:', error);
          }
          break;

        default:
          console.log('Invalid feedback type');
          break;
      }
    } catch (error) {
      console.error('Error converting image to Bitmap:', error);
    }
  } else {
    console.log('Invalid image file');
  }
}

function readFileAsDataURL(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onloadend = () => resolve(reader.result);
    reader.onerror = reject;
    reader.readAsDataURL(file);
  });
}


