document.addEventListener("DOMContentLoaded", () => {
    const chatWindow = document.getElementById('chatWindow');
    const fileList = document.getElementById('files');
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const fileInput = document.getElementById('fileUpload');
	const sendButton = document.getElementById('sendButton'); // Replace with your button's ID


    // Scrolls chat window to the bottom
    const scrollToBottom = () => {
        chatWindow.scrollTop = chatWindow.scrollHeight;
    };
	
    // Highlight a specific message when clicked
    const scrollToMessage = (messageId) => {
                const messageElement = document.getElementById(`message-${messageId}`);
        if (messageElement) {
            messageElement.scrollIntoView({ behavior: "smooth", block: "center" });
            messageElement.classList.add("highlight");
            setTimeout(() => messageElement.classList.remove("highlight"), 2000);
        } else {
            console.error(`Message with ID ${messageId} not found.`);
        }
    };
	
		   // Event listener for file list items
      if (fileList) {
        fileList.addEventListener("click", (event) => {
            const target = event.target.closest(".list-group-item");
            if (!target) return; // Ensure a valid file item was clicked
            const messageId = target.getAttribute("data-message-id");

            if (messageId) {
                console.log(`Scrolling to message with ID: ${messageId}`); // Debug log
                scrollToMessage(messageId);
            } else {
                console.error("Message ID not found for the clicked file.");
            }
        });
    }
    

// Load chat history for a given user
const loadChatHistory = (receiverId) => {
    fetch(`/Admin2/chat/getChatHistory.php?user_id=${receiverId}`)
        .then(response => response.json())
        .then(data => {
            if (data.history) {
                chatWindow.innerHTML = ""; // Clear the chat window
                data.history.forEach(message => {
                    const messageElement = document.createElement("div");
                    messageElement.id = `message-${message.id}`;
                    messageElement.classList.add("message");
                    messageElement.classList.add(message.sender_name === "Admin" || message.sender_name === "You" ? "admin-message" : "user-message");
                    messageElement.innerHTML = `
                        <strong>${message.sender_name}:</strong>
                        <span>${message.message}</span>
                        ${message.document_path ? `<a href="${message.document_path}" target="_blank">Download File</a>` : ""}
                        <small class="timestamp">${message.timestamp}</small>
                    `;
                    chatWindow.appendChild(messageElement);
                });
                scrollToBottom(); // Auto-scroll to the latest message

            }
        })
        .catch(error => console.error("Error loading chat history:", error));
};


    // Send a message to the chat
    const sendMessage = () => {
		        event.preventDefault();

        const messageText = messageInput.value.trim();
        const formData = new FormData();

        if (!messageText && !fileInput.files.length) {
            alert("Please type a message or select a file.");
            return;
        }
		formData.append('sender_id', currentUserId);
        formData.append('message', messageText);
        formData.append('file', fileInput.files[0] || "");
        formData.append('receiver_id', receiverId); // Set dynamically in context
        formData.append('project_id', projectId); // Set dynamically in context
        formData.append('sender_type', senderType);

        fetch('/Admin2/chat/sendMessage.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadChatHistory(receiverId); // Reload chat history
                    messageInput.value = ''; // Clear input
                    fileInput.value = ''; // Clear file input
                } else {
                    alert(data.message || "Failed to send message.");
                }
            })
            .catch(error => console.error("Error sending message:", error));
    };


    // Fetch users with unread messages periodically
    const fetchUnreadMessages = () => {
        fetch('/Admin2/chat/fetchUsersWithUnread.php')
            .then(response => response.json())
            .then(users => {
                users.forEach(user => {
                    const userElement = document.querySelector(`.user-item[data-user-id="${user.id}"]`);
                    if (userElement) {
                        const unreadBadge = userElement.querySelector('.badge');
                        if (user.unread_count > 0) {
                            if (!unreadBadge) {
                                const badge = document.createElement('span');
                                badge.classList.add('badge', 'badge-danger');
                                badge.textContent = user.unread_count;
                                userElement.appendChild(badge);
                            } else {
                                unreadBadge.textContent = user.unread_count;
                            }
                        } else if (unreadBadge) {
                            unreadBadge.remove();
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching unread messages:", error));
    };
	
	sendButton.addEventListener("click", sendMessage);
    setInterval(() => loadChatHistory(receiverId), 4000); // Poll for new messages
    setInterval(fetchUnreadMessages, 5000); // Check for unread messages periodically
});
