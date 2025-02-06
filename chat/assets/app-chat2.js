//PART 2 of app-chat.js

// Utility Functions
const debounce = (func, wait) => {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

// State Management
class ChatState {
    constructor() {
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
        this.lastReadMessageId = null;
        this.highlightedMessageId = null;
        this.lastFileUpdate = Date.now();
        this.isScrolling = false;
    }

    validateState() {
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
            formData.append('files[]', file);

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

// File List Handler
class FileListHandler {
    constructor(state) {
        this.state = state;
        this.fileList = document.getElementById('files');
        this.lastUpdate = 0;
        this.UPDATE_INTERVAL = 10000;
        this.highlightTimeout = null;
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        if (this.fileList) {
            this.fileList.addEventListener('click', (event) => {
                const fileItem = event.target.closest('.chat-contact-list-item');
                if (!fileItem) return;

                const messageId = fileItem.getAttribute('data-message-id');
                if (messageId) {
                    this.scrollToMessage(messageId);
                }
            });
        }
    }

    scrollToMessage(messageId) {
        const messageElement = document.getElementById(`message-${messageId}`);
        if (!messageElement) {
            console.error(`Message with ID ${messageId} not found.`);
            return;
        }

        this.clearHighlight();
        messageElement.scrollIntoView({ behavior: "smooth", block: "center" });
        messageElement.classList.add("highlight");

        this.highlightTimeout = setTimeout(() => {
            this.clearHighlight();
        }, 2000);
    }

    clearHighlight() {
        if (this.highlightTimeout) {
            clearTimeout(this.highlightTimeout);
        }
        const highlighted = document.querySelector('.highlight');
        if (highlighted) {
            highlighted.classList.remove('highlight');
        }
    }

    async updateFilesList() {
        try {
            const response = await fetch(`/Admin2 - Copy/chat/getUploadedFiles.php?project_id=${this.state.projectId}`);
            const data = await response.json();

            if (!data.files || !this.fileList) return;

            const fileListHTML = `
                <li class="chat-contact-list-item-title mt-0">
                    <h5 class="text-primary mb-0">FILES</h5>
                </li>
                ${data.files.map(file => this.createFileItemHTML(file)).join('')}
            `;

            if (this.fileList.innerHTML !== fileListHTML) {
                this.fileList.innerHTML = fileListHTML;
            }

            this.lastUpdate = Date.now();
        } catch (error) {
            console.error("Error fetching uploaded files:", error);
        }
    }

    createFileItemHTML(file) {
        return `
            <li class="chat-contact-list-item mb-1" data-message-id="${file.message_id}">
                <a class="d-flex align-items-center">
                    <div class="chat-contact-info flex-grow-1 ms-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="chat-contact-name text-truncate m-0 fw-normal">
                                ${this.sanitizeHTML(file.document_name)}
                            </h6>
                        </div>
                        <small class="chat-contact-status text-truncate">
                            Uploaded by: ${this.sanitizeHTML(file.uploaded_by || 'Unknown')}
                        </small>
                        <small class="chat-contact-status text-truncate">
                            at ${this.formatDate(file.created_at)}
                        </small>
                    </div>
                </a>
            </li>
        `;
    }

    sanitizeHTML(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    formatDate(dateStr) {
        if (!dateStr) return 'Unknown';
        const date = new Date(dateStr);
        return date.toLocaleString('en-US', {
            month: 'short',
            day: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });
    }

    startPolling() {
        this.updateFilesList();
        let pollInterval = this.UPDATE_INTERVAL;
        const maxInterval = 30000;

        const poll = async () => {
            try {
                await this.updateFilesList();
                pollInterval = this.UPDATE_INTERVAL;
            } catch (error) {
                console.error('Polling error:', error);
                pollInterval = Math.min(pollInterval * 1.5, maxInterval);
            } finally {
                setTimeout(poll, pollInterval);
            }
        };

        setTimeout(poll, pollInterval);
    }
}

// Message Handler
class MessageHandler {
    constructor(state, chatHistoryHandler) {
        this.state = state;
        this.chatHistoryHandler = chatHistoryHandler;
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
        const uploadProgress = document.getElementById('uploadProgress');

        document.dispatchEvent(new CustomEvent('messageSuccess'));

        messageInput.value = "";
        fileInput.value = "";
        fileNameDisplay.value = "";
        fileNameDisplay.style.display = 'none';
        uploadProgress.style.display = 'none';
        this.state.isFileUploaded = false;
    }
}

// Chat History Handler
class ChatHistoryHandler {
    constructor(state) {
        this.state = state;
        this.messageElements = new Set();
        this.MAX_MESSAGES = 1000;
        this.scrollHandler = debounce(this.handleScroll.bind(this), 200);
        this.lastReadMessageId = null;
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

    async markMessagesAsRead(messageIds) {
        try {
            const response = await fetch('/Admin2 - Copy/chat/markMessagesAsRead.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    message_ids: messageIds,
                    user_id: this.state.currentUserId
                })
            });

            const data = await response.json();
            if (data.success) {
                this.lastReadMessageId = Math.max(...messageIds);
            }
        } catch (error) {
            ErrorHandler.handleError(error, 'Mark messages as read');
        }
    }

    handleScroll() {
        const unreadMessages = this.getVisibleUnreadMessages();
        if (unreadMessages.length > 0) {
            this.markMessagesAsRead(unreadMessages);
        }
    }

    getVisibleUnreadMessages() {
        const chatWindow = document.querySelector('.chat-history-body');
        if (!chatWindow) return [];

        const visibleMessages = [];
        const messageElements = chatWindow.querySelectorAll('.chat-message');

        messageElements.forEach(element => {
            const messageId = parseInt(element.id.replace('message-', ''));
            const rect = element.getBoundingClientRect();
            const isVisible = rect.top >= 0 &&
                            rect.bottom <= window.innerHeight &&
                            rect.height > 0;

            if (isVisible && messageId > (this.lastReadMessageId || 0)) {
                visibleMessages.push(messageId);
            }
        });

        return visibleMessages;
    }

    renderChatHistory(messages) {
        const chatContainer = document.querySelector('.chat-history-body');
        if (!chatContainer) return;

        // Clear existing messages if needed
        if (this.messageElements.size > this.MAX_MESSAGES) {
            this.pruneOldMessages();
        }

        const fragment = document.createDocumentFragment();
        messages.forEach(message => {
            const messageElement = this.createMessageElement(message);
            if (messageElement) {
                fragment.appendChild(messageElement);
                this.messageElements.add(messageElement);
            }
        });

        chatContainer.appendChild(fragment);
        this.scrollToLatestMessage();
    }

    createMessageElement(message) {
        const isCurrentUser = message.sender_id === this.state.currentUserId;
        const messageDiv = document.createElement('div');
        messageDiv.id = `message-${message.id}`;
        messageDiv.className = `chat-message ${isCurrentUser ? 'chat-message-right' : 'chat-message-left'}`;

        const messageContent = `
            <div class="d-flex overflow-hidden">
                <div class="chat-message-wrapper flex-grow-1">
                    <div class="chat-message-text">
                        <p>${this.sanitizeAndFormatMessage(message.content)}</p>
                        ${this.renderAttachments(message.attachments)}
                    </div>
                    <div class="text-muted mt-1">
                        <small>${this.formatTimestamp(message.created_at)}</small>
                        ${message.read_at ? '<span class="read-indicator">✓✓</span>' : ''}
                    </div>
                </div>
            </div>
        `;

        messageDiv.innerHTML = messageContent;
        return messageDiv;
    }

    sanitizeAndFormatMessage(content) {
        const div = document.createElement('div');
        div.textContent = content;
        return div.innerHTML.replace(/\n/g, '<br>');
    }

    renderAttachments(attachments) {
        if (!attachments || attachments.length === 0) return '';

        return attachments.map(attachment => `
            <div class="chat-attachment">
                <a href="${this.sanitizeURL(attachment.url)}"
                   target="_blank"
                   class="chat-attachment-link"
                   download="${this.sanitizeAndFormatMessage(attachment.name)}">
                    <i class="fas fa-paperclip"></i> ${this.sanitizeAndFormatMessage(attachment.name)}
                </a>
            </div>
        `).join('');
    }

    sanitizeURL(url) {
        try {
            const sanitizedUrl = new URL(url);
            return sanitizedUrl.href;
        } catch (e) {
            console.error('Invalid URL:', url);
            return '#';
        }
    }

    formatTimestamp(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const yesterday = new Date(now);
        yesterday.setDate(yesterday.getDate() - 1);

        if (date.toDateString() === now.toDateString()) {
            return date.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        } else if (date.toDateString() === yesterday.toDateString()) {
            return 'Yesterday ' + date.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        } else {
            return date.toLocaleString('en-US', {
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }
    }

    pruneOldMessages() {
        const messages = Array.from(this.messageElements);
        const messagesToRemove = messages.slice(0, messages.length - this.MAX_MESSAGES);

        messagesToRemove.forEach(element => {
            element.remove();
            this.messageElements.delete(element);
        });
    }

    scrollToLatestMessage() {
        const chatWindow = document.querySelector('.chat-history-body');
        if (!chatWindow || this.state.isScrolling) return;

        const shouldAutoScroll = chatWindow.scrollHeight - chatWindow.scrollTop
                               <= chatWindow.clientHeight + 100;

        if (shouldAutoScroll) {
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    }
}

// Main Chat Application
class ChatApplication {
    constructor() {
        this.state = new ChatState();
        this.chatHistoryHandler = new ChatHistoryHandler(this.state);
        this.messageHandler = new MessageHandler(this.state, this.chatHistoryHandler);
        this.fileHandler = new FileHandler(this.state);
        this.fileListHandler = new FileListHandler(this.state);

        this.initialize();
    }

    initialize() {
        if (!this.state.validateState()) {
            console.error('Chat initialization failed: Invalid state');
            return;
        }

        this.setupEventListeners();
        this.initializeChat();
    }

    setupEventListeners() {
        const messageForm = document.getElementById('messageForm');
        const fileInput = document.getElementById('fileInput');
        const chatHistoryBody = document.querySelector('.chat-history-body');

        if (messageForm) {
            messageForm.addEventListener('submit', this.handleMessageSubmit.bind(this));
        }

        if (fileInput) {
            fileInput.addEventListener('change', this.handleFileSelect.bind(this));
        }

        if (chatHistoryBody) {
            chatHistoryBody.addEventListener('scroll', () => {
                this.state.isScrolling = true;
                this.chatHistoryHandler.scrollHandler();
                clearTimeout(this.scrollTimeout);
                this.scrollTimeout = setTimeout(() => {
                    this.state.isScrolling = false;
                }, 150);
            });
        }

        // Handle real-time updates
        this.setupRealtimeUpdates();
    }

    async handleMessageSubmit(event) {
        event.preventDefault();
        const messageInput = document.querySelector('.message-input');
        const fileInput = document.getElementById('fileInput');

        if (!messageInput) return;

        const messageText = messageInput.value.trim();
        const files = fileInput.files;

        if (await this.messageHandler.sendMessage(messageText, files)) {
            this.fileListHandler.updateFilesList();
        }
    }

    async handleFileSelect(event) {
        const files = event.target.files;
        if (files.length > 0) {
            await this.fileHandler.uploadFiles(files);
            this.fileListHandler.updateFilesList();
        }
    }

    setupRealtimeUpdates() {
        // Poll for new messages
        setInterval(() => {
            if (!this.state.isScrolling) {
                this.chatHistoryHandler.loadChatHistory();
            }
        }, 5000);

        // Poll for file updates
        this.fileListHandler.startPolling();
    }

    async initializeChat() {
        await this.chatHistoryHandler.loadChatHistory();
        this.fileListHandler.updateFilesList();
    }
}

// Initialize the chat application
document.addEventListener('DOMContentLoaded', () => {
    const chatApp = new ChatApplication();
});