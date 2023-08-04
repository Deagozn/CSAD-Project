$('.chat-button').on('click' , function(){
  $('.chat-button').css({"display": "none"});
  
  $('.chat-box').css({"visibility": "visible"});
});

$('.chat-box .chat-box-header p').on('click' , function(){
  $('.chat-button').css({"display": "block"});
  $('.chat-box').css({"visibility": "hidden"});
});

$(".modal-close-button").on("click" , function(){
  $(".modal").toggleClass("show-modal");
});

document.getElementById("sendButton").addEventListener("click", handleUserInput);

// Add event listener to the input field to handle pressing "Enter" key
document.getElementById("userInput").addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
    handleUserInput();
  }
});

function handleUserInput() {
    var chatBoxBody = document.querySelector(".chat-box-body");
    var userInputElement = document.getElementById("userInput");
    var userInput = userInputElement.value.trim().toLowerCase();
    userInput = userInput.replace(/[^\w\s]/g, "");
    
    var sendHTML = "";
    var responseHTML = "";
    
    switch (userInput) {
    case "what is your name":
      responseHTML = createResponse("My name is Kiasu Librarian.");
      break;
    case "what do you do":
      responseHTML = createResponse("I can answer your questions about the website.");
      break;
    case "how can i use the website":
      responseHTML = createResponse("You can use the website to find libraries around you, book seats, check seat availability and much more.");
      break;
    case "how do i book a seat":
      responseHTML = createResponse("You can book a seat by clicking bookings, and selecting new booking. You then can select your which library to book for, when, and which seat you want. You also have the option to reserve a book together with your seat.");
      break;
    default:
      responseHTML = createResponse("I'm sorry, I don't understand. Can you please clarify?");
  }
    
    sendHTML = createSender(userInput);
    chatBoxBody.innerHTML += sendHTML;
    
    chatBoxBody.innerHTML += responseHTML;
    
    chatBoxBody.scrollTop = chatBoxBody.scrollHeight;
    
    userInputElement.value = "";
    
}

function createSender(sendText) {
    return `
    <div class="chat-box-body-send">
      <p>${sendText}</p>
    </div>
  `;
}

function createResponse(responseText) {
  return `
    <div class="chat-box-body-receive">
      <p>${responseText}</p>
    </div>
  `;
}