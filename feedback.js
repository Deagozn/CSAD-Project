import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-app.js';
import { getFirestore, doc, collection, setDoc } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-firestore.js';

const firebaseConfig = {
    apiKey: "AIzaSyA5vf23nXwW2pAZCxvz4WS9xQnGfw6m_5U",
    authDomain: "kiasu-library.firebaseapp.com",
    projectId: "kiasu-library",
    storageBucket: "kiasu-library.appspot.com",
    messagingSenderId: "705816096294",
    appId: "1:705816096294:web:7d9c3c61ef9d254fed40e7",
    measurementId: "G-VSS8SG1LQ9"
};

initializeApp(firebaseConfig);

const firestore = getFirestore();

const testdoc = doc(firestore, 'test/testing');
function writetest(){
    const docData = {
        description: 'test2',
        test: 'testing 2',
    };
    setDoc(testdoc, docData);
}

writetest();

