upload k rolay se pehle everything in working order// Utility Functions
working with uploads and all

////////////////////////////////////////PHP CODE///////////////////////////////////////



<?php
header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Upload failed",
    "file_urls" => []
];

error_log(print_r($_FILES, true)); // Log $_FILES to debug

if (!isset($_FILES['files']) || empty($_FILES['files']['name'][0])) {
    $response["message"] = "No files received.";
    echo json_encode($response);
    exit;
}

// Directory for uploads
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

foreach ($_FILES['files']['name'] as $key => $fileName) {
    $fileTmpPath = $_FILES['files']['tmp_name'][$key];

    if (move_uploaded_file($fileTmpPath, $uploadDir . $fileName)) {
        $response["file_urls"][] = "uploads/" . $fileName;
        $response["success"] = true;
        $response["message"] = "File uploaded successfully.";
    } else {
        $response["message"] = "Failed to move file: $fileName";
    }
}

echo json_encode($response);
exit;
?>
///////////////////////////////////////////////PHP CODE END////////////////////////////////////



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
    logError(error, context) {
        // More detailed error logging
        console.error({
            timestamp: new Date().toISOString(),
            context: context,
            errorMessage: error.message,
            errorStack: error.stack,
            additionalInfo: error.additionalInfo || {}
        });
    },

    handleError(error, operation, additionalContext = {}) {
        this.logError(error, {
            operation,
            ...additionalContext
        });

        // More specific user feedback
        UIFeedback.showError(`Operation ${operation} failed: ${error.message}`);
    }
};

// UI Feedback Handler
// UI Feedback Handler
const UIFeedback = {
    showToast(message, type = 'info') {
        // Create a more sophisticated toast notification
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;

        document.body.appendChild(toast);

        // Force a small delay to trigger animation
        setTimeout(() => {
            toast.classList.add("show");
        }, 10);

        // Automatically hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.add("hide");


        // Automatically remove after 3 seconds
        setTimeout(() => {
                document.body.removeChild(toast);
            }, 300); // Match the CSS transition duration
        }, 5000);
    },

    showError(message) {
        this.showToast(message, 'error');
    },

    showSuccess(message) {
        this.showToast(message, 'success');
    }
};

// File Handler
class FileHandler {
    constructor(state) {
        // Configuration
        this.state = state;
        this.uploadQueue = [];
        this.maxConcurrentUploads = 3;
        this.uploadTimeout = 60000; // 1-minute timeout per upload

        // Comprehensive file type validation
        this.allowedTypes = new Set([
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/x-zip-compressed', // ✅ ZIP files
            'application/gzip',
            'application/x-7zip-compressed'
        ]);

        // Memoize DOM elements to reduce repeated queries
        this.elements = {
            sendButton: null,
            uploadProgress: null,
            fileNameDisplay: null,
            fileInput: null
        };
    }

    // Cached DOM element retrieval with lazy loading
    getCachedElement(selector, key) {
        if (!this.elements[key]) {
            this.elements[key] = document.querySelector(selector);
        }
        return this.elements[key];
    }

    // Comprehensive file validation with detailed checks
    validateFile(file) {
        const validationChecks = [
            {
                test: () => file && file instanceof File,
                error: 'Invalid file object'
            },
            {
                test: () => file.size > 0,
                error: `Empty file: ${file.name}`
            },
            {
                test: () => file.size <= this.state.MAX_FILE_SIZE,
                error: `File exceeds maximum size (500MB)`
            },
            {
                test: () => this.allowedTypes.has(file.type),
                error: `Unsupported file type: ${file.type} for file ${file.name}`
            }
        ];

        const failedCheck = validationChecks.find(check => !check.test());
        if (failedCheck) {
            throw new Error(failedCheck.error);
        }

        return true;
    }

    // Advanced upload method with concurrency and robust error handling
    async uploadFiles(files) {
        // Convert to array, remove duplicates
        const uniqueFiles = [...new Set(Array.from(files))];

        // Comprehensive validation
        const validFiles = uniqueFiles.filter(file => {
            try {
                return this.validateFile(file);
            } catch (error) {
                this.showErrorNotification(error.message);
                return false;
            }
        });

        if (validFiles.length === 0) {
            //this.showErrorNotification('No valid files to upload');
            return false;
        }

        this.prepareUploadUI(validFiles);

        try {
            await this.uploadWithConcurrencyControl(validFiles);
            this.finalizeUpload();
            return true;
        } catch (error) {
            this.handleUploadError(error);
            return false;
        }
    }

    // Advanced concurrent upload with timeout and retry
    async uploadWithConcurrencyControl(files) {
        const uploadBatches = this.createUploadBatches(files);

        for (const batch of uploadBatches) {
            await Promise.all(batch.map(file => this.uploadWithRetry(file)));
        }
    }

    // Batch upload management
    createUploadBatches(files) {
        const batches = [];
        for (let i = 0; i < files.length; i += this.maxConcurrentUploads) {
            batches.push(files.slice(i, i + this.maxConcurrentUploads));
        }
        return batches;
    }

    // Upload with retry mechanism
    async uploadWithRetry(file, maxRetries = 3) {
        for (let attempt = 1; attempt <= maxRetries; attempt++) {
            try {
                return await this.uploadFileWithTimeout(file);
            } catch (error) {
                if (attempt === maxRetries) {
                    throw error;
                }
                console.warn(`Upload retry ${attempt} for ${file.name}`);
                await new Promise(resolve => setTimeout(resolve, 1000 * attempt));
            }
        }
    }

    // Timeout-enabled file upload
    uploadFileWithTimeout(file) {
        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('files[]', file);

            const xhr = new XMLHttpRequest();
            const timeoutId = setTimeout(() => {
                xhr.abort();
                reject(new Error(`Upload timeout for ${file.name}`));
            }, this.uploadTimeout);

            xhr.upload.addEventListener('progress', (event) => {
                if (event.lengthComputable) {
                    const progress = Math.round((event.loaded / event.total) * 100);
                    this.updateUploadProgress(progress, file.name);
                }
            });

            xhr.onload = () => {
                clearTimeout(timeoutId);
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        response.success ? resolve(response) : reject(new Error(response.message));
                    } catch {
                        reject(new Error('Invalid server response'));
                    }
                } else {
                    reject(new Error(`Upload failed: ${xhr.statusText}`));
                }
            };

            xhr.onerror = () => {
                clearTimeout(timeoutId);
                reject(new Error('Network error during upload'));
            };

            xhr.open('POST', '/Admin2 - Copy/chat/uploadFile.php', true);
            xhr.send(formData);
        });
    }

    // UI Preparation Methods
    prepareUploadUI(files) {
        const fileNames = files.map(file => file.name);

        this.showUploadProgress();
        this.updateFileNameDisplay(fileNames);
    }

    updateFileNameDisplay(fileNames) {
        const fileNameDisplay = this.getCachedElement('#fileNameDisplay', 'fileNameDisplay');
        if (fileNameDisplay) {
            fileNameDisplay.textContent = `Selected Files: ${fileNames.join(', ')}`;
            fileNameDisplay.style.display = 'block';
        }
    }

    showUploadProgress() {
        const sendButton = this.getCachedElement('.btn-send-message', 'sendButton');
        const extendUploadWindow = this.getCachedElement('#extendUploadWindow', 'extendUploadWindow');
        const uploadProgress = this.getCachedElement('#uploadProgress', 'uploadProgress');

        if (sendButton) sendButton.disabled = true;

        if (extendUploadWindow) {
            extendUploadWindow.style.overflow = 'visible';
        }
        if (uploadProgress) {
            uploadProgress.style.display = 'block';
            uploadProgress.style.width = '0%';
        }
    }

    updateUploadProgress(progress, fileName) {
        const uploadProgress = this.getCachedElement('#uploadProgress', 'uploadProgress');
        const fileNameDisplay = this.getCachedElement('#fileNameDisplay', 'fileNameDisplay');

        if (uploadProgress) {
            uploadProgress.style.width = `${progress}%`;
            uploadProgress.textContent = `Uploading ${progress}%`;        //could use this as well        uploadProgress.textContent = `Uploading ${fileName}: ${progress}%`;
        }

        if (fileNameDisplay) {
            fileNameDisplay.value = `Uploading ${fileName}: ${progress}%`;
        }

        if (progress === 100) {
            UIFeedback.showSuccess("File uploaded successfully!");
            this.finalizeUpload();
        }
    }

    finalizeUpload() {
        const sendButton = this.getCachedElement('.btn-send-message', 'sendButton');
        const uploadProgress = this.getCachedElement('#uploadProgress', 'uploadProgress');
        const fileNameDisplay = this.getCachedElement('#fileNameDisplay', 'fileNameDisplay');
        const fileInput = this.getCachedElement('#fileInput', 'fileInput');

        if (sendButton) sendButton.disabled = false;
       /* if (uploadProgress) {
            uploadProgress.style.display = 'none';
            uploadProgress.style.width = '0%';
        }
        if (fileNameDisplay) {
            fileNameDisplay.textContent = '';
            fileNameDisplay.style.display = 'none';
        }
        if (fileInput) fileInput.value = ''; */

        this.state.isFileUploaded = true;
    }

    // Error Handling
    showErrorNotification(message) {
        console.error('FileHandler Error:', message);
        fileNameDisplay.value = "";
        fileNameDisplay.style.display = 'none';
        UIFeedback.showError(message);
    }

    handleUploadError(error) {
        this.finalizeUpload();
        ErrorHandler.handleError(error, 'File Upload');
        this.showErrorNotification(error.message);
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
        return new Date(dateStr).toLocaleString('en-US', {
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
    constructor(state) {
        this.state = state;
        //this.chatHistoryHandler = chatHistoryHandler;
        this.chatWindow = document.querySelector('.chat-history-body');
        this.messageQueue = [];
        this.BATCH_SIZE = 10;
        this.BATCH_TIMEOUT = 1000;
        this.scrollHandler = debounce(this.handleScroll.bind(this), 200);
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
                //this.scrollToBottom();  //check scrolllings
                return true;
            } else {
                throw new Error(data.message || 'Failed to send message');
            }
        } catch (error) {
            ErrorHandler.handleError(error, 'Message send');
            return false;
        }
    }

    handleScroll() {
        const unreadMessages = this.getVisibleUnreadMessages();
        if (unreadMessages.length > 0) {
            this.markMessagesAsRead(projectId,currentUserId);
        }
    }

    getVisibleUnreadMessages() {
        if (!this.chatWindow) return [];

        const visibleMessages = [];
        const messageElements = this.chatWindow.querySelectorAll('.chat-message');

        messageElements.forEach(element => {
            const messageId = parseInt(element.id.replace('message-', ''));
            const rect = element.getBoundingClientRect();
            const isVisible = rect.top >= 0 && rect.bottom <= window.innerHeight;

            if (isVisible && messageId > (this.state.lastReadMessageId || 0)) {
                visibleMessages.push(messageId);
            }
        });

        return visibleMessages;
    }

    async markMessagesAsRead(projectId, senderId) {
           if (!projectId || !senderId) {
        console.error("Invalid parameters for marking messages as read."+ projectId + "      dhhasdhahd       "+ this.state.currentUserId);
        return;
    }
        try {
            const response = await fetch('/Admin2 - Copy/chat/markMessagesAsRead.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                     project_id: projectId,  // Use project_id instead of message_ids
                     sender_id: this.state.currentUserId     // Use sender_id instead of user_id  user_id: this.state.currentUserId
                })
            });


           if (!response.ok) {
            throw new Error(`Server responded with ${response.status}`);
        }



            const data = await response.json();
            if (data.success) {
                this.state.lastReadMessageId = Math.max(...projectId);
            } else {
            console.warn("Failed to mark messages as read:", data.message || "Unknown error");
        }

        } catch (error) {
            ErrorHandler.handleError(error, 'Mark messages as read');
        }
    }

    scrollToBottom() {
        if (this.chatWindow) {
            UIFeedback.showSuccess("Scrolling Down");
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
        const extendUploadWindow = document.getElementById('extendUploadWindow');


        messageInput.value = "";
        fileInput.value = "";
        fileNameDisplay.value = "";
        fileNameDisplay.style.display = 'none';
        uploadProgress.style.display = 'none';
        extendUploadWindow.style.overflow = 'hidden';
        this.state.isFileUploaded = false;

        //console.log("Dispatching messageSuccess event...");


        //document.dispatchEvent(new CustomEvent('messageSuccess'));
    }
}

// Chat History Handler
class ChatHistoryHandler {
    constructor(state) {
        this.state = state;
        this.messageElements = new Set();
        this.MAX_MESSAGES = 1000;
    }

    async loadChatHistory() {
        try {
            //const response = await fetch(`/Admin2 - Copy/chat/getChatHistory.php?user_id=${this.state.receiverId}`);
              const response = await fetch(`/Admin2 - Copy/chat/getChatHistory.php?project_id=${this.state.projectId}`);


            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            //console.log('Received data:', data); // Debugging log

                // More robust error checking
   if (data.history && data.history.length > 0) {
            this.renderChatHistory(data.history);
        } else {
            console.warn("No messages in chat history");
        }
    } catch (error) {
        console.error('Chat history load error:', error);
        ErrorHandler.handleError(error, 'Load chat history');
    }
}

    renderChatHistory(messages) {
        const chatHistoryList = document.querySelector(".chat-history");
        if (!chatHistoryList) {
            console.error('Chat history container not found');
            return;
        }
        //console.log('Received messages:', messages); // Debug log
        // Use document fragment for better performance
        const fragment = document.createDocumentFragment();

        messages.forEach(message => {
            const messageElement = this.createMessageElement(message);
            fragment.appendChild(messageElement);
            this.messageElements.add(messageElement);
        });

        chatHistoryList.innerHTML = "";
        chatHistoryList.appendChild(fragment);
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
                        <p class="mb-0">${this.sanitizeMessage(message.content)}</p>
                    ${this.renderAttachments(message.attachments)}
                </div>
                <div class="text-muted mt-1">
                    <small>${this.formatTimestamp(message.created_at || message.timestamp)}</small>
                </div>
            </div>
        </div>
    `;

    return element;
    }

    renderAttachments(attachments) {
    if (!attachments || attachments.length === 0) return '';

    return attachments.map(attachment => `
        <div class="chat-attachments">
            <a href="${attachment.url}" target="_blank">
                ${attachment.name}
            </a>
        </div>
    `).join('');
}


    sanitizeMessage(message) {
        return DOMPurify.sanitize(message);
    }

    createSecureDownloadLink(path) {
        return `/download?file=${encodeURIComponent(path)}&token=${this.generateDownloadToken()}`;
    }

    generateDownloadToken() {
        return crypto.randomUUID(); // More cryptographically secure
    }

    formatTimestamp(timestamp) {
    // Handle various potential timestamp formats
    if (!timestamp) return 'Unknown';

    try {
        // Try parsing with multiple fallback strategies
        const date = new Date(timestamp);

        // Check if date is valid
        if (isNaN(date.getTime())) {
            console.warn(`Invalid timestamp: ${timestamp}`);
            return 'Invalid Date';
        }

        return date.toLocaleString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        });
    } catch (error) {
        console.error('Timestamp parsing error:', error);
        return 'Invalid Date';
    }
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


//Real Time UpdateManager
class RealtimeUpdateManager {
    constructor(updateCallback, options = {}) {
        this.updateCallback = updateCallback;
        this.baseInterval = options.baseInterval || 5000;
        this.maxInterval = options.maxInterval || 30000;
        this.backoffFactor = options.backoffFactor || 1.5;
        this.currentInterval = this.baseInterval;
        this.errorCount = 0;
        this.maxErrorCount = 3;
    }

    startPolling() {
        const poll = async () => {
            try {
                await this.updateCallback();

                // Reset interval on successful update
                this.currentInterval = this.baseInterval;
                this.errorCount = 0;
            } catch (error) {
                this.errorCount++;

                // Exponential backoff with error count
                this.currentInterval = Math.min(
                    this.currentInterval * this.backoffFactor,
                    this.maxInterval
                );

                // Stop polling after max error count
                if (this.errorCount >= this.maxErrorCount) {
                    console.error('Polling stopped due to repeated failures');
                    return;
                }
            } finally {
                // Schedule next poll
                setTimeout(poll, this.currentInterval);
            }
        };

        // Initial poll
        poll();
    }
}

// Main Chat Application
class ChatApplication {
    constructor() {
        this.state = new ChatState();

        this.fileHandler = new FileHandler(this.state);
        this.fileListHandler = new FileListHandler(this.state);
        this.chatHistoryHandler = new ChatHistoryHandler(this.state);
        this.messageHandler = new MessageHandler(this.state);


        this.initialize();
    }

    initialize() {
        if (!this.state.validateState()) {
            console.error('Chat initialization failed: Invalid state');
            return;
        }

        this.setupEventListeners();
        this.initializeChat();

        /* ✅ ADD THIS HERE: Listen for the messageSuccess event
        document.addEventListener('messageSuccess', () => {
            console.log("messageSuccess event triggered. Reloading chat history...");

            if (this.chatHistoryHandler) {
                this.chatHistoryHandler.loadChatHistory();
            } else {
                console.error("chatHistoryHandler is undefined.");
            }
        }); */
    }

    setupEventListeners() {
        const messageForm = document.querySelector('.form-send-message');
        const fileInput = document.getElementById('fileInput');
        const chatHistoryBody = document.querySelector('.chat-history-body');

        if (messageForm) {
            messageForm.addEventListener('submit', this.handleMessageSubmit.bind(this));
        }

        if (fileInput) {
            console.log('File input changed');
            fileInput.addEventListener('change', this.handleFileSelect.bind(this));
        }

        if (chatHistoryBody) {
            chatHistoryBody.addEventListener('scroll', this.messageHandler.scrollHandler);
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
            this.chatHistoryHandler.loadChatHistory();
            this.fileListHandler.updateFilesList();
            // Ensure the UI updates before scrolling
         setTimeout(() => {
                this.messageHandler.scrollToBottom();
         }, 100); // Small delay (100ms) to allow DOM updates
    }
}

    async handleFileSelect(event) {
        const files = event.target.files;
        if (files.length > 0) {

        // Display the first file name
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        if (fileNameDisplay) {
            fileNameDisplay.value = files[0].name;
            fileNameDisplay.style.display = 'block';
        }

            await this.fileHandler.uploadFiles(files);
            this.fileListHandler.updateFilesList();
        }
    }

  setupRealtimeUpdates() {
    // More intelligent polling
    const chatUpdateManager = new RealtimeUpdateManager(
        () => this.chatHistoryHandler.loadChatHistory(),
        { baseInterval: 5000, maxInterval: 30000 }
    );
    chatUpdateManager.startPolling();

   /* this keeps running to update the filist on the left side of the chat window which is not really needed
   const fileUpdateManager = new RealtimeUpdateManager(
        () => this.fileListHandler.updateFilesList(),
        { baseInterval: 10000, maxInterval: 30000 }
    );
    fileUpdateManager.startPolling();
    */
}

    async initializeChat() {
        await this.chatHistoryHandler.loadChatHistory();
        this.fileListHandler.updateFilesList();
    }
}

// Initialize the chat application
document.addEventListener('DOMContentLoaded', () => {
    window.chatApp = new ChatApplication();
});