$(document).ready(function () {
  const chatInput = $(".chat-input textarea");
  const sendChatBtn = $(".chat-input span");
  const chatbox = $(".chatbox");
  const chatbotToggler = $(".chatbot-toggler");
  const chatbotCloseBtn = $(".close-btn");

  let userMessage;
  const inputInitHeight = chatInput.prop("scrollHeight");

  const createChatLi = (message, className) => {
    const chatLi = $("<li>").addClass("chat", className);

    if (className === "outgoing") {
      chatLi.addClass("right");
    }

    let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
    chatLi.html(chatContent);
    chatLi.find("p").text(message);
    return chatLi;
  }

  const generateResponse = async (incomingChatLi) => {
    const API_URL = "http://localhost:5000/api/chatbot";
    const messageElement = incomingChatLi.find("p");
    const chatInputValue = chatInput.val(); // Assuming chatInput is defined elsewhere

    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        body: JSON.stringify({ message: chatInputValue }),
        headers: { 'Content-Type': 'application/json' },
      });

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      const data = await response.json();
      console.log(data);
      messageElement.text(data);
    } catch (error) {
      console.error('There has been a problem with your fetch operation:', error);
    }
  };

  const handleChat = () => {
    userMessage = chatInput.val().trim();
    if (!userMessage) return;
    chatInput.css("height", `${inputInitHeight}px`);

    chatbox.append(createChatLi(userMessage, "outgoing"));
    chatbox.scrollTop(chatbox.prop("scrollHeight"));

    setTimeout(() => {
      const incomingChatli = createChatLi(".....", "incoming")
      chatbox.append(incomingChatli);
      chatbox.scrollTop(chatbox.prop("scrollHeight"));
      generateResponse(incomingChatli);
      chatInput.val("");
    }, 600);
  }

  chatInput.on("input", function () {
    chatInput.css("height", `${inputInitHeight}px`);
    chatInput.css("height", `${this.scrollHeight}px`);
  });

  chatInput.on("keydown", function (e) {
    if (e.key === "Enter" && !e.shiftKey && $(window).width() > 800) {
      e.preventDefault();
      handleChat();
    }
  });

  sendChatBtn.on("click", handleChat);
  chatbotCloseBtn.on("click", function () {
    $("body").removeClass("show-chatbot");
  });
  chatbotToggler.on("click", function () {
    $("body").toggleClass("show-chatbot");
  });
});

