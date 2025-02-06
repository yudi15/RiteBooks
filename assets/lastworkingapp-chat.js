// State Management
class ChatState {
  constructor() {
        // Access the global variables defined in your HTML
        try {
            this.currentUserId = window.currentUserId;
            this.projectId = window.projectId;
            this.receiverId = window.receiverId;
            this.senderType = window.senderType;
        } catch (error) {
            console.error('Error accessing chat variables:', error);
        }

        this.uploadedFiles = new Set();
        this.messageQueue = [];
        this.isFileUploaded = false;
        this.MAX_FILE_SIZE = 500 * 1024 * 1024; // 500 MB
    }

    validateState() {
        // Check if all required variables are defined and have valid values
        if (!this.currentUserId || !this.receiverId) {
            console.warn('Missing required chat parameters:', {
                currentUserId: this.currentUserId,
                receiverId: this.receiverId,
                projectId: this.projectId,
                senderType: this.senderType
            });
            return false;
        }
        return true;
    }
}

// Error Handler
const ErrorHandler = {
    RETRY_ATTEMPTS: 3,
    RETRY_DELAY: 1000,

    async handleError(error, operation, context) {
        console.error(`${operation} failed:`, error);

        if (this.shouldRetry(error)) {
            return this.retryOperation(operation, context);
        }

        this.showUserFriendlyError(error);
    },

    shouldRetry(error) {
        return error.status === 503 || error.status === 429;
    },

    showUserFriendlyError(error) {
        const message = this.getErrorMessage(error);
        UIFeedback.showError(message);
    },

    getErrorMessage(error) {
        const messages = {
            413: "File is too large",
            415: "File type not supported",
            429: "Too many requests, please try again later",
            default: "An error occurred. Please try again."
        };
        return messages[error.status] || messages.default;
    }
};

// UI Feedback Handler
const UIFeedback = {
    showLoading(element) {
        element.classList.add('loading');
        element.disabled = true;
    },

    hideLoading(element) {
        element.classList.remove('loading');
        element.disabled = false;
    },

    showSuccess(message) {
        alert("Cha gata");
        alert(message); // Replace with better UI feedback
    },

    showError(message) {
        alert(message); // Replace with better UI feedback
    },

    updateProgress(progress) {
        const progressBar = document.getElementById('progressBar');
        if (progressBar) {
            progressBar.style.width = `${progress}%`;
            progressBar.textContent = `${progress}%`;
        }
    }
};

// File Handler
class FileHandler {
    constructor(state) {
        this.state = state;
        this.uploadQueue = [];
        this.allowedTypes = new Set(['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
    }

    validateFile(file) {
        if (file.size > this.state.MAX_FILE_SIZE) {
            throw new Error(`File too large (max 500MB): ${file.name}`);
        }
        if (!this.allowedTypes.has(file.type)) {
            throw new Error(`File type not allowed: ${file.type}`);
        }
        return true;
    }

     async uploadFiles(files) {
        try {
            if (!files || files.length === 0) {
                throw new Error('No files selected');
            }

            const validFiles = Array.from(files).filter(file => {
                try {
                    return this.validateFile(file);
                } catch (error) {
                    UIFeedback.showError(error.message);
                    return false;
                }
            });

            if (validFiles.length === 0) {
                throw new Error('No valid files to upload');
            }

            for (const file of validFiles) {
                await this.uploadSingleFile(file);
            }

            this.state.isFileUploaded = true;
            return true;
        } catch (error) {
            ErrorHandler.handleError(error, 'File upload');
            return false;
        }
    }

    uploadSingleFile(file) {
        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('files[]', file); // Changed from 'file' to 'files[]'

            const xhr = new XMLHttpRequest();

            xhr.upload.addEventListener('progress', (event) => {
                if (event.lengthComputable) {
                    const progress = Math.round((event.loaded / event.total) * 100);
                    UIFeedback.updateProgress(progress);
                }
            });

            xhr.onload = () => {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            resolve(response);
                        } else {
                            reject(new Error(response.message || 'Upload failed'));
                        }
                    } catch (error) {
                        reject(new Error('Invalid server response'));
                    }
                } else {
                    reject(new Error(`Upload failed: ${xhr.statusText}`));
                }
            };

            xhr.onerror = () => reject(new Error('Network error during upload'));
            xhr.open('POST', '/Admin2 - Copy/chat/uploadFile.php', true);
            xhr.send(formData);
        });
    }
}

// Message Handler
class MessageHandler {
    constructor(state,chatHistoryHandler) {
        this.state = state;
        this.chatWindow = document.querySelector('.chat-history-body');
        this.messageQueue = [];
        this.BATCH_SIZE = 10;
        this.BATCH_TIMEOUT = 1000;
        this.batchTimeout = null;
    }

    async sendMessage(messageText, files) {
        if (!messageText && (!files || files.length === 0)) {
            UIFeedback.showError("Please type a message or select a file.");
            return false;
        }

        if (files && files.length > 0 && !this.state.isFileUploaded) {
            UIFeedback.showError("Please wait for file upload to complete.");
            return false;
        }

        const formData = this.createMessageFormData(messageText, files);

        try {
            const response = await fetch('/Admin2 - Copy/chat/sendMessage.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                this.handleMessageSuccess();
                this.scrollToBottom();
                return true;
            } else {
                throw new Error(data.message || 'Failed to send message');
            }
        } catch (error) {
            ErrorHandler.handleError(error, 'Message send');
            return false;
        }
    }

    scrollToBottom() {
        if (this.chatWindow) {
            this.chatWindow.scrollTop = this.chatWindow.scrollHeight;
                    alert("Going Down");
        }
    }

    createMessageFormData(messageText, files) {
        const formData = new FormData();
        formData.append('sender_id', this.state.currentUserId);
        formData.append('message', messageText);
        formData.append('receiver_id', this.state.receiverId);
        formData.append('project_id', this.state.projectId);
        formData.append('sender_type', this.state.senderType);

        if (files) {
            Array.from(files).forEach(file => {
                formData.append("files[]", file);
            });
        }

        return formData;
    }

    handleMessageSuccess() {
        const messageInput = document.querySelector('.message-input');
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileNameDisplay');



        document.dispatchEvent(new CustomEvent('messageSuccess'));


        messageInput.value = "";
        fileInput.value = "";
        fileNameDisplay.value = "";
        fileNameDisplay.style.display = 'none';
        uploadProgress.style.display = 'none';
        this.state.isFileUploaded = false;
        //this.scrollToBottom();

    }

}





// Chat History Handler
class ChatHistoryHandler {
    constructor(state) {
        this.state = state;
        this.messageElements = new Set();
        this.MAX_MESSAGES = 1000; //Setting the max viewable messages in the window
    }

    async loadChatHistory() {
        try {
            const response = await fetch(`/Admin2 - Copy/chat/getChatHistory.php?user_id=${this.state.receiverId}`);
            const data = await response.json();

            if (data.history) {
                this.renderChatHistory(data.history);
            }
        } catch (error) {
            ErrorHandler.handleError(error, 'Load chat history');
        }
    }

    renderChatHistory(messages) {
        const chatHistoryList = document.querySelector(".chat-history");
        if (!chatHistoryList) return;

        chatHistoryList.innerHTML = "";

        messages.forEach(message => {
            const messageElement = this.createMessageElement(message);
            chatHistoryList.appendChild(messageElement);
            this.messageElements.add(messageElement);
        });

        this.cleanup();
    }

    createMessageElement(message) {
        const element = document.createElement("li");
        element.id = `message-${message.id}`;
        element.classList.add("chat-message");

        if (message.sender_type !== "user") {
            element.classList.add("chat-message-right");
        }

        element.innerHTML = `
            <div class="d-flex overflow-hidden">
                <div class="chat-message-wrapper flex-grow-1">
                    <div class="chat-message-text">
                        <p class="mb-0">${this.sanitizeMessage(message.message)}</p>
                        ${message.document_path ?
                            `<a href="${this.createSecureDownloadLink(message.document_path)}"
                                target="_blank" class="download-link">Download File</a>`
                            : ""}
                    </div>
                    <div class="text-muted mt-1">
                        <small>${message.timestamp}</small>
                    </div>
                </div>
            </div>
        `;

        return element;
    }

    sanitizeMessage(message) {
        return DOMPurify.sanitize(message);
    }

    createSecureDownloadLink(path) {
        return `/download?file=${encodeURIComponent(path)}&token=${this.generateDownloadToken()}`;
    }

    generateDownloadToken() {
        // Implement secure token generation
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }

    cleanup() {
        if (this.messageElements.size > this.MAX_MESSAGES) {
            const elementsToRemove = [...this.messageElements]
                .slice(0, this.messageElements.size - this.MAX_MESSAGES);

            elementsToRemove.forEach(element => {
                element.remove();
                this.messageElements.delete(element);
            });
        }
    }
}


// Main Chat Application
document.addEventListener("DOMContentLoaded", () => {

    const state = new ChatState();

     if (!state.validateState()) {
        console.error('Invalid state: Missing required parameters');
        return;
    }

    const fileHandler = new FileHandler(state);
    const chatHistoryHandler = new ChatHistoryHandler(state);
    const messageHandler = new MessageHandler(state,chatHistoryHandler);





    // Initialize UI elements
    const chatWindow = document.querySelector('.chat-history-body');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('files');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const uploadProgress = document.getElementById('uploadProgress');
    const messageInput = document.querySelector('.message-input');
    const sendButton = document.querySelector('.btn-primary');
    const uploadButton = document.getElementById('uploadButton');

    // Event Handlers
    uploadButton?.addEventListener('click', () => fileInput?.click());

    fileInput?.addEventListener('change', async () => {
        const uploadProgress = document.getElementById('uploadProgress');
    if (uploadProgress) {
        uploadProgress.style.display = 'block';
        const progressBar = document.getElementById('progressBar');
        if (progressBar) {
            progressBar.style.width = '0%';
            progressBar.textContent = '0%';
        }
    }
        const success = await fileHandler.uploadFiles(fileInput.files);
        if (success) {
            fileNameDisplay.textContent = `📂 Selected Files: ${Array.from(fileInput.files).map(f => f.name).join(', ')}`;
            fileNameDisplay.style.display = 'block';
        }
    });

    const messageForm = document.querySelector('.form-send-message');
    messageForm?.addEventListener('submit', async (event) => {
        event.preventDefault();
        UIFeedback.showLoading(sendButton);
        await messageHandler.sendMessage(messageInput.value.trim(), fileInput.files);
        UIFeedback.hideLoading(sendButton);
    });

    // Add event listener: for loading chat history as soon as the message is sent
document.addEventListener('messageSuccess', () => {
    console.log("MNud");
    chatHistoryHandler.loadChatHistory();
});

    // Initial load
    setInterval(() => {
            chatHistoryHandler.loadChatHistory();
        }, 5000);

    // Setup WebSocket connection
    const ws = new WebSocket(`ws://${window.location.host}/Admin2 - Copy/chat/chat-server.php`);

    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);
        chatHistoryHandler.loadChatHistory();
    };

    ws.onclose = () => {
        // Fallback to polling if WebSocket fails
        setInterval(() => {
            chatHistoryHandler.loadChatHistory();
        }, 7000);
    };
});