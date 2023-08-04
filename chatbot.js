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

async function handleUserInput() {
    var chatBoxBody = document.querySelector(".chat-box-body");
    var userInputElement = document.getElementById("userInput");
    var userInput = userInputElement.value.trim();
    var cleanedUserInput = userInput.toLowerCase().replace(/[^\w\s]/g, "");

    var sendHTML = `
      <div class="chat-box-body-send">
        <p>${userInput}</p>
      </div>
    `;

    var responseHTML = "";

    try {
        const response = await fetch(`ChatbotApi.php?userInput=${encodeURIComponent(cleanedUserInput)}`);
        const data = await response.json();

        if (data && data.response) {
            responseHTML = createResponse(data.response);
        } else {
            responseHTML = createResponse("I'm sorry, I don't understand. Can you please clarify?");
        }
    } catch (error) {
        console.error("Error fetching data from the server:", error);
        responseHTML = createResponse("Oops! Something went wrong. Please try again later.");
    }

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