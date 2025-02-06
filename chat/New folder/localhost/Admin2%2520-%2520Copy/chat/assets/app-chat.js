
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

// Utility class for managing upload states
// Update the UploadState class
class UploadState {
    constructor() {
        this.status = new Map();
        this.progress = new Map();
        this.errors = new Map();
    }

    updateStatus(fileId, status) {
        console.log(`Updating status for ${fileId} to ${status}`);
        this.status.set(fileId, status);
    }

    updateProgress(fileId, progress) {
        this.progress.set(fileId, progress);
    }

    setError(fileId, error) {
        this.errors.set(fileId, error);
    }

    clearFile(fileId) {
        this.status.delete(fileId);
        this.progress.delete(fileId);
        this.errors.delete(fileId);
    }

    getStatus(fileId) {
        const status = this.status.get(fileId);
        console.log(`Getting status for ${fileId}: ${status}`);
        return status;
    }
}

// Queue manager for handling upload priorities and concurrency
class UploadQueue {
    constructor(maxConcurrent = 3) {
        this.queue = [];
        this.active = new Set();
        this.completed = new Set();
        this.maxConcurrent = maxConcurrent;
        this.abortController = new AbortController();
    }

    add(file) {
        const fileId = crypto.randomUUID();
        this.queue.push({ file, id: fileId });
        return fileId;
    }

    remove(fileId) {
        this.queue = this.queue.filter(item => item.id !== fileId);
        this.active.delete(fileId);
        this.completed.delete(fileId);
    }

    canProcess() {
        return this.active.size < this.maxConcurrent;
    }

    getNext() {
        if (!this.canProcess() || this.queue.length === 0) return null;
        const next = this.queue.shift();
        this.active.add(next.id);
        return next;
    }

    complete(fileId) {
        this.active.delete(fileId);
        this.completed.add(fileId);
    }

    abort() {
        this.abortController.abort();
        this.abortController = new AbortController();
    }

    clear() {
        this.queue = [];
        this.active.clear();
        this.completed.clear();
        this.abort();
    }
}








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







// Main FileHandler class with improved implementation
class FileHandler {
    constructor(state) {
        // Configuration
        this.state = state;
        this.uploadState = new UploadState();
        this.uploadQueue = new UploadQueue(3);
        this.ui = new FileUploadUI(this);
        this.domCache = new WeakMap();
        this.cleanupHandlers = new Set();
        this.uploadedFiles = [];
        this.pendingUploads = new Set();

         // Add new properties for temporary files
        this.tempUploadedFiles = new Map(); // Store temp file info: original name -> temp name
        this.UPLOAD_API = '/Admin2 - Copy/chat/uploadFile.php';
        this.DELETE_API = '/Admin2 - Copy/chat/deleteTemp.php';


        // Initialize cleanup array
        this.cleanup = [];

        // Constants
        this.UPLOAD_TIMEOUT = 60000;
        this.MAX_RETRIES = 3;
        this.RETRY_DELAY = 1000;
        this.MAX_FILE_SIZE = 500 * 1024 * 1024; // 500MB

        // Allowed file types with descriptions
        this.allowedTypes = new Map([
            ['image/jpeg', 'JPEG images'],
            ['image/png', 'PNG images'],
            ['image/gif', 'GIF images'],
            ['application/pdf', 'PDF documents'],
            ['application/msword', 'Word documents'],
            ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Word documents'],
            ['application/x-zip-compressed', 'ZIP archives'],
            ['application/gzip', 'GZIP archives'],
            ['application\/x-rar-compressed', 'ZIP archives'],
            ['application\/x-rar', 'ZIP archives'],
            ['application/x-7zip-compressed', '7-Zip archives']
        ]);

        // Initialize handlers
       // this.initializeEventListeners();
        this.setupCleanup();
    }

     registerEventListener(element, eventType, handler) {
        if (!element) return;

        element.addEventListener(eventType, handler);
        this.cleanupHandlers.add(() => {
            element.removeEventListener(eventType, handler);
        });
    }

    /* Initialize event listeners with proper cleanup
    initializeEventListeners() {
        const fileInput = this.getCachedElement('#fileInput');
        if (fileInput) {
            const handler = this.handleMultipleFileUpload.bind(this);
            fileInput.addEventListener('change', handler);
            this.cleanup.push(() => fileInput.removeEventListener('change', handler));
        }
    } */

    // Setup cleanup handlers
    setupCleanup() {
        this.cleanup = [];
        window.addEventListener('unload', () => this.dispose());
    }

    // Dispose and cleanup resources
    dispose() {
        // Execute all cleanup handlers
        for (const cleanup of this.cleanupHandlers) {
            cleanup();
        }

        // Clear maps and sets
        this.domCache = new WeakMap();
        this.cleanupHandlers.clear();
        this.uploadedFiles = [];
        this.pendingUploads.clear();

        // Abort any ongoing uploads
        this.uploadQueue?.abort();

        // Clear upload state
        this.uploadState = null;
        this.uploadQueue = null;
    }

    // Safe DOM element caching with WeakMap
    getCachedElement(selector) {
        if (!this.domCache.has(selector)) {
            const element = document.querySelector(selector);
            if (element) {
                this.domCache.set(selector, element);
            }
        }
        return this.domCache.get(selector);
    }

    // Improved file validation with content checking
    async validateFile(file) {
        // Basic validation checks
        const validationChecks = [
            {
                test: () => file && file instanceof File,
                error: 'Invalid file object'
            },
            {
                test: () => file.size > 0,
                error: `Empty file: ${this.sanitizeFileName(file.name)}`
            },
            {
                test: () => file.size <= this.MAX_FILE_SIZE,
                error: `File exceeds maximum size (500MB)`
            },
            {
                test: () => this.allowedTypes.has(file.type),
                error: `Unsupported file type: ${file.type}`
            }
        ];

        // Run validation checks
        for (const check of validationChecks) {
            if (!check.test()) {
                throw new Error(check.error);
            }
        }

        // Additional content validation
        try {
            await this.validateFileContent(file);
        } catch (error) {
            throw new Error(`Content validation failed: ${error.message}`);
        }

        return true;
    }

    // Content validation implementation
    async validateFileContent(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();

            reader.onload = () => {
                // Check for file signature/magic numbers
                const arr = new Uint8Array(reader.result).subarray(0, 4);
                const header = Array.from(arr).map(b => b.toString(16)).join('');

                // Implement file signature checks
                const signatures = {
                    '89504e47': 'image/png',
                    'ffd8ffe0': 'image/jpeg',
                    '25504446': 'application/pdf'
                };

                if (signatures[header] && signatures[header] !== file.type) {
                    reject(new Error('File content does not match extension'));
                }

                resolve(true);
            };

            reader.onerror = () => reject(new Error('Failed to read file content'));
            reader.readAsArrayBuffer(file.slice(0, 4));
        });
    }

    // Sanitize file names for display
    sanitizeFileName(fileName) {
            return DOMPurify.sanitize(fileName.replace(/[^a-zA-Z0-9._-]/g, ''));
}

     // Handle multiple file upload with improved error handling
    async handleMultipleFileUpload(event) {
        const files = Array.from(event.target.files);
        const validFiles = [];

        // Reset state for new upload
        this.uploadedFiles = [];
        this.state.isFileUploaded = false;

        for (const file of files) {
            try {
                await this.validateFile(file);
                validFiles.push(file);
                this.uploadedFiles.push(file);
            } catch (error) {
                this.handleUploadError(error, file);
            }
        }

         if (validFiles.length === 0) return [];

         else if (validFiles.length > 0) {
            if (this.ui) {
                this.ui.updateMultipleFileDisplay(this.uploadedFiles);
            }
            const results = await this.processFiles(validFiles);

            // Check if all files uploaded successfully
            const allSuccessful = results.every(result => result.status === 'completed');
            this.state.isFileUploaded = allSuccessful;

            return validFiles;
        }

        return [];
    }

    // Process files with queue management
    async processFiles(files) {
        const uploadResults = [];
        const fileIds = files.map(file => this.uploadQueue.add(file));

        try {
            const results = await this.startUploadProcess();
            uploadResults.push(...results);
        } catch (error) {
            this.handleUploadError(error);
        }

        return uploadResults;
    }

    // Start upload process with concurrency control
    async startUploadProcess() {
        const uploadPromises = [];

        while (this.uploadQueue.canProcess()) {
            const next = this.uploadQueue.getNext();
            if (!next) break;

            const promise = this.uploadWithRetry(next.file)
                .then(result => {
                    this.uploadQueue.complete(next.id);
                    return {
                        fileId: next.id,
                        status: 'completed',
                        file: next.file
                    };
                })
                .catch(error => {
                    this.handleUploadError(error, next.file);
                    this.uploadQueue.remove(next.id);
                    return {
                        fileId: next.id,
                        status: 'failed',
                        error: error,
                        file: next.file
                    };
                });

            uploadPromises.push(promise);
        }

        return Promise.all(uploadPromises);
    }

    // Improved retry mechanism with exponential backoff
    async uploadWithRetry(file, attempt = 1) {
        if (this.isFileUploading(file.name)) return;
        //this.uploadState.updateStatus(file.name, 'uploading');
        try {
            return await this.uploadFileWithTimeout(file);
        } catch (error) {
            if (attempt >= this.MAX_RETRIES) throw error;

            await new Promise(resolve =>
                setTimeout(resolve, this.RETRY_DELAY * Math.pow(2, attempt - 1))
            );

            return this.uploadWithRetry(file, attempt + 1);
        }
    }

    // Upload file with timeout and abort handling
    // Modified upload method with proper temporary file storage
    uploadFileWithTimeout(file) {
        if (this.isFileUploading(file.name)) {
            console.log(`File ${file.name} is already uploading`);
            return Promise.resolve({ status: 'completed', file });
        }

        this.uploadState.updateStatus(file.name, 'uploading');
        this.uploadState.updateProgress(file.name, 0);

        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('files[]', file);

            const xhr = new XMLHttpRequest();
            const abortController = new AbortController();

            const timeoutId = setTimeout(() => {
                abortController.abort();
                this.uploadState.updateStatus(file.name, 'failed');
                reject(new Error(`Upload timeout for ${this.sanitizeFileName(file.name)}`));
            }, this.UPLOAD_TIMEOUT);

            xhr.upload.addEventListener('progress', event => {
                if (event.lengthComputable) {
                    const progress = Math.round((event.loaded / event.total) * 100);
                    this.uploadState.updateProgress(file.name, progress);
                    if (this.ui) {
                        this.ui.updateProgress(progress, file.name);
                    }
                }
            });

            xhr.onload = () => {
                clearTimeout(timeoutId);
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        console.log('Upload response:', response); // Debug log

                        if (response.success && response.files && response.files.length > 0) {
                            // Store temporary file information
                            response.files.forEach(fileInfo => {
                                console.log('Storing temp file info:', fileInfo); // Debug log
                                this.tempUploadedFiles.set(fileInfo.original_name, fileInfo.stored_name);
                            });

                            console.log('Current tempUploadedFiles:',
                                Array.from(this.tempUploadedFiles.entries())); // Debug log

                            this.uploadState.updateStatus(file.name, 'completed');
                            this.uploadState.updateProgress(file.name, 100);
                            if (this.ui) {
                                this.ui.updateProgress(100, file.name);
                            }
                            resolve({ status: 'completed', file, response });
                        } else {
                            throw new Error(response.message || 'Upload failed');
                        }
                    } catch (error) {
                        console.error('Error processing upload response:', error);
                        this.uploadState.updateStatus(file.name, 'failed');
                        reject(error);
                    }
                } else {
                    this.uploadState.updateStatus(file.name, 'failed');
                    reject(new Error(`Upload failed: ${xhr.statusText}`));
                }
            };

            xhr.onerror = () => {
                clearTimeout(timeoutId);
                this.uploadState.updateStatus(file.name, 'failed');
                reject(new Error('Network error during upload'));
            };

            xhr.open('POST', this.UPLOAD_API, true);
            xhr.send(formData);

            abortController.signal.addEventListener('abort', () => {
                xhr.abort();
                clearTimeout(timeoutId);
                this.uploadState.updateStatus(file.name, 'failed');
            });
        });
    }

    // Update UI with debounced progress
    updateUploadProgress = debounce((progress, fileName) => {
    this.ui.updateProgress(progress, fileName);
}, 100);


 // New method to delete temporary file
    async deleteTempFile(fileName) {
        const tempFileName = this.tempUploadedFiles.get(fileName);
        if (!tempFileName) {
            console.error('No temporary file found for:', fileName);
            return;
        }

        try {
            const response = await fetch(this.DELETE_API, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    temp_file: tempFileName
                })
            });

            const data = await response.json();
            if (data.success) {
                this.tempUploadedFiles.delete(fileName);
                this.removeFile(fileName);
            } else {
                throw new Error(data.message || 'Failed to delete temporary file');
            }
        } catch (error) {
            console.error('Error deleting temporary file:', error);
            throw error;
        }
    }



// Add this method to FileHandler
    async removeFile(fileName) {
        try {
            // Delete the temporary file from server first
            await this.deleteTempFile(fileName);

            this.pendingUploads.delete(fileName);
            this.uploadedFiles = this.uploadedFiles.filter(file =>
                this.sanitizeFileName(file.name) !== fileName
            );

            this.uploadState.clearFile(fileName);

            const hasRemainingUploads = this.pendingUploads.size > 0;
            this.state.isFileUploaded = !hasRemainingUploads;

            if (this.ui) {
                this.ui.removeFileUIElements(fileName);
            }

            if (this.uploadedFiles.length === 0) {
                this.resetState();
            }

            this.logState();
        } catch (error) {
            console.error('Error removing file:', error);
            UIFeedback.showError(`Failed to remove file: ${error.message}`);
        }
    }


    resetState() {
        this.state.isFileUploaded = true; // Changed from false to true when no files are present
        if (this.ui) {
            this.ui.resetUIState();
        }

        const sendButton = document.querySelector('.btn-send-message');
        if (sendButton) {
            sendButton.disabled = false;
        }
    }


    // Clean up the UI and reset state
    finalizeUpload() {
        const elements = {
            sendButton: this.getCachedElement('.btn-send-message'),
            fileInput: this.getCachedElement('#fileInput'),
            fileNameDisplay: this.getCachedElement('#fileNameDisplay'),
            uploadProgress: this.getCachedElement('#uploadProgress')
        };

        if (elements.sendButton) elements.sendButton.disabled = false;
        if (elements.fileInput) elements.fileInput.value = '';
        if (elements.fileNameDisplay) {
            elements.fileNameDisplay.value = '';
            elements.fileNameDisplay.style.display = 'none';
        }
        if (elements.uploadProgress) {
            elements.uploadProgress.style.display = 'none';
            elements.uploadProgress.style.width = '0%';
        }

        this.state.isFileUploaded = true;
        this.uploadQueue.clear();
    }

    // Handle upload errors with improved logging
    handleUploadError(error, file = null) {
        const errorContext = {
            fileName: file ? this.sanitizeFileName(file.name) : null,
            timestamp: new Date().toISOString(),
            errorType: error.name,
            errorMessage: error.message
        };

        console.error('Upload error:', errorContext);
        ErrorHandler.handleError(error, 'File Upload', errorContext);

        if (file) {
            this.uploadState.setError(file.name, error);
            if (confirm(`File ${file.name} upload failed. Retry?`)) {
            this.uploadWithRetry(file);
        }
            //this.removeFile(file.name);
        }

        UIFeedback.showError(error.message);
    }

    isFileUploading(fileName) {
        return this.uploadState.getStatus(fileName) === 'uploading';
    }

    /* Get currently selected files
    getSelectedFiles() {
        console.log("Inside GET function, files: ", this.uploadedFiles);
        return this.uploadedFiles;

    } */

    // Modified method to get temporary file information

    /*2nd
    getSelectedFiles() {
        return this.uploadedFiles.map(file => ({
            originalName: file.name,
            tempName: this.tempUploadedFiles.get(file.name)
        }));
    } */

    getSelectedFiles() {
        console.log('Getting selected files...'); // Debug log
        console.log('Uploaded files:', this.uploadedFiles); // Debug log
        console.log('Temp files map:', Array.from(this.tempUploadedFiles.entries())); // Debug log

        const filesInfo = this.uploadedFiles.map(file => {
            const storedName = this.tempUploadedFiles.get(file.name);
            console.log(`File ${file.name} -> stored name: ${storedName}`); // Debug log

            return {
                originalName: file.name,
                storedName: storedName
            };
        }).filter(info => info.storedName); // Only include files that have stored names

        console.log('Returning files info:', filesInfo); // Debug log
        return filesInfo;
    }

     // Add debug method
    logState() {
        console.log('Current FileHandler State:', {
            uploadedFiles: this.uploadedFiles,
            isFileUploaded: this.state.isFileUploaded,
            uploadStates: Array.from(this.uploadState.status.entries()),
            queueState: {
                active: Array.from(this.uploadQueue.active),
                completed: Array.from(this.uploadQueue.completed),
                queueLength: this.uploadQueue.queue.length
            }
        });
    }
}











     //USER INTERFACE GOES IN THIS CLASS
class FileUploadUI {
    constructor(fileHandler) {
        this.fileHandler = fileHandler;
        this.domCache = new Map();
        this.setupEventListeners();
    }

    // Cache DOM elements for better performance
    getCachedElement(selector) {
        if (!this.domCache.has(selector)) {
            const element = document.querySelector(selector);
            if (element) {
                this.domCache.set(selector, element);
            }
        }
        return this.domCache.get(selector);
    }

    setupEventListeners() {
        const removeButtons = document.querySelectorAll('.remove-file-btn');
        removeButtons.forEach(button => this.setupRemoveButton(button));
    }

    setupRemoveButton(button) {
        const newButton = button.cloneNode(true);
        button.parentNode.replaceChild(newButton, button);

        newButton.addEventListener('click', (e) => {
            try {
                e.stopPropagation();
                e.preventDefault();

                const fileName = newButton.getAttribute('data-filename');
                if (!fileName) {
                    throw new Error('File name not found in button attributes');
                }

                // Now this will properly call FileHandler's removeFile method
                this.fileHandler.removeFile(fileName);
            } catch (error) {
                this.handleError(error);
            }
        });
    }

    updateMultipleFileDisplay(files) {
        try {
            const fileNameDisplay = this.getCachedElement('#fileNameDisplay');
            const multipleFileProgress = this.getCachedElement('#multipleFileProgress');

            if (!fileNameDisplay || !multipleFileProgress) {
                throw new Error('Required UI elements not found');
            }

            // Clear existing content
            fileNameDisplay.innerHTML = '';
            multipleFileProgress.innerHTML = '';

            // Create and append new elements
            files.forEach(file => {
                const nameElement = this.createFileNameElement(file);
                const progressElement = this.createProgressElement(file);

                fileNameDisplay.appendChild(nameElement);
                fileNameDisplay.style.display='block';
                multipleFileProgress.appendChild(progressElement);
            });

            // Update UI state
            this.updateUIState(files);

        } catch (error) {
            this.handleError(error);
        }
    }

    createFileNameElement(file) {
        const div = document.createElement('div');
        div.className = 'file-item d-flex justify-content-between align-items-center mb-2';

        const sanitizedName = this.fileHandler.sanitizeFileName(file.name);
        div.dataset.filename = sanitizedName;

        const removeButton = document.createElement('button');
        removeButton.className = 'btn btn-sm btn-outline-danger remove-file-btn';
        removeButton.dataset.filename = sanitizedName;
        removeButton.innerHTML = '<i class="ri-close-line"></i>';

        // Add click event listener directly to the button
        removeButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.fileHandler.removeFile(sanitizedName);
        });

        div.innerHTML = `<span class="text-truncate">${sanitizedName}</span>`;
        div.appendChild(removeButton);

        return div;
    }

    createProgressElement(file) {
        const div = document.createElement('div');
        div.className = 'progress mt-1';

        const sanitizedName = this.fileHandler.sanitizeFileName(file.name);
        div.dataset.filename = sanitizedName;

        div.innerHTML = `
            <div class="progress-bar progress-bar-striped progress-bar-animated"
                 role="progressbar"
                 style="width: 0%;"
                 data-filename="${sanitizedName}">
                ${sanitizedName}
            </div>
        `;

        return div;
    }


    updateProgress(progress, fileName) {
        const sanitizedFileName = this.fileHandler.sanitizeFileName(fileName);
        const progressBar = document.querySelector(
            `.progress-bar[data-filename="${sanitizedFileName}"]`
        );

        if (progressBar) {
            progressBar.style.width = `${progress}%`;
            progressBar.setAttribute('aria-valuenow', progress);
            progressBar.textContent = `${sanitizedFileName}: ${progress}%`;

            // When progress is complete
            if (progress === 100) {
                progressBar.classList.remove('progress-bar-animated');
                this.checkAllUploadsComplete();
            }
        }
    }

    updateUIState(files) {
        const sendButton = this.getCachedElement('.btn-send-message');
        const extendUploadWindow = this.getCachedElement('#extendUploadWindow');

        if (sendButton) {
            // Only disable the send button if there are files that are still uploading
            const hasUploadingFiles = Array.from(this.fileHandler.uploadState.status.entries())
                .some(([_, status]) => status === 'uploading');
            sendButton.disabled = hasUploadingFiles;
        }

        if (extendUploadWindow) {
            extendUploadWindow.style.overflow = files.length > 0 ? 'visible' : 'hidden';
        }
    }

    checkAllUploadsComplete() {
        const allComplete = Array.from(this.fileHandler.uploadState.status.entries())
            .every(([_, status]) => status === 'completed');

        const hasAnyFiles = this.fileHandler.uploadedFiles.length > 0;
        const hasUploadingFiles = Array.from(this.fileHandler.uploadState.status.entries())
            .some(([_, status]) => status === 'uploading');

        const sendButton = this.getCachedElement('.btn-send-message');
        if (sendButton) {
            // Only disable the button if files are still uploading
            sendButton.disabled = hasUploadingFiles;
        }

        if (allComplete && hasAnyFiles) {
            UIFeedback.showSuccess("All files uploaded successfully!");
        }
    }

    resetUIState() {
        const elements = {
            sendButton: this.getCachedElement('.btn-send-message', 'sendButton'),
            multipleFileDisplay: this.getCachedElement('#fileNameDisplay', 'fileNameDisplay'),
            multipleFileProgress: this.getCachedElement('#multipleFileProgress', 'multipleFileProgress')
        };

        if (elements.sendButton) {
            elements.sendButton.disabled = false;
        }

        if (elements.multipleFileDisplay) {
            elements.multipleFileDisplay.innerHTML = '';
        }

        if (elements.multipleFileProgress) {
            elements.multipleFileProgress.innerHTML = '';
        }
    }


    // Remove file with improved cleanup
    removeFile(fileName) {
        try {
            console.log(`Removing file: ${fileName}`);

            // Find and abort any ongoing upload
            const fileToRemove = this.uploadedFiles.find(file =>
                this.sanitizeFileName(file.name) === fileName
            );

            if (fileToRemove?.xhr) {
                fileToRemove.xhr.abort();
                console.log(`Aborted upload for ${fileName}`);
            }

            // Remove from tracked files
            this.uploadedFiles = this.uploadedFiles.filter(file =>
                this.sanitizeFileName(file.name) !== fileName
            );

            // Update UI elements
            this.removeFileUIElements(fileName);

            // Cleanup state
            this.cleanupFileState(fileName);

            console.log('Remaining files:', this.uploadedFiles);

        } catch (error) {
            this.handleUIError(error);
        }
    }

    removeFileUIElements(fileName) {
        const sanitizedFileName = this.fileHandler.sanitizeFileName(fileName);

        // Remove file name element
        const fileNameElement = document.querySelector(
            `.file-item[data-filename="${sanitizedFileName}"]`
        );
        if (fileNameElement) {
            fileNameElement.remove();
        }

        // Remove progress bar
        const progressElement = document.querySelector(
            `.progress[data-filename="${sanitizedFileName}"]`
        );
        if (progressElement) {
            progressElement.remove();
        }

        // Check if there are any remaining files
        const remainingFiles = this.fileHandler.uploadedFiles;

        // Update UI state based on remaining files
        this.updateUIState(remainingFiles);

        // Enable send button if there are no uploading files
        const hasUploadingFiles = Array.from(this.fileHandler.uploadState.status.entries())
            .some(([_, status]) => status === 'uploading');

        const sendButton = this.getCachedElement('.btn-send-message');
        if (sendButton) {
            sendButton.disabled = hasUploadingFiles;
        }
    }






    handleError(error) {
        console.error('UI Error:', error);
        ErrorHandler.handleError(error, 'UI Operation');
        UIFeedback.showError(`UI Error: ${error.message}`);
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

        // Create a container for all attachments
        return `
            <div class="chat-attachments mt-2">
                ${attachments.map(attachment => this.renderSingleAttachment(attachment)).join('')}
            </div>
        `;
    }

    renderSingleAttachment(attachment) {
    // Get file extension
    const fileExt = attachment.name.split('.').pop().toLowerCase();

    // Define icon based on file type
    const icon = this.getFileIcon(fileExt);

    // Get formatted URLs (as an array)
    const formattedUrls = this.formatUploadedFileUrls(attachment.url);

    //console.log("Formatted URLs: ", formattedUrls);

    // Generate multiple links for each file URL
    const linksHtml = formattedUrls.map(url => {
        // Extract the filename from the URL
        const fileName = url.substring(url.lastIndexOf('/') + 1);

        return `
            <div class="chat-attachment-item d-flex align-items-center mb-1">
                <i class="${icon} me-2"></i>
                <a href="${url}"
                   class="attachment-link text-truncate"
                   target="_blank"
                   title="${this.sanitizeMessage(fileName)}">
                    ${this.sanitizeMessage(fileName)}
                </a>
                <small class="text-muted ms-2">${this.formatFileSize(attachment.size)}</small>
            </div>
        `;
    }).join(''); // Join all links into a single HTML string

    return linksHtml;
}



    formatUploadedFileUrls(urlString) {
    if (!urlString) return [];

    // Base URL for uploaded files
    const baseUrl = "http://localhost/Admin2%20-%20Copy/chat/";

    // Split URLs on commas and ensure they are properly formatted
    return urlString.split(',').map(url =>
        url.startsWith("http") ? url.trim() : `${baseUrl}${url.trim()}`
    );
}


    getFileIcon(fileExt) {
        const iconMap = {
            // Images
            'jpg': 'ri-image-line',
            'jpeg': 'ri-image-line',
            'png': 'ri-image-line',
            'gif': 'ri-image-line',
            // Documents
            'pdf': 'ri-file-pdf-line',
            'doc': 'ri-file-word-line',
            'docx': 'ri-file-word-line',
            // Archives
            'zip': 'ri-file-zip-line',
            'rar': 'ri-file-zip-line',
            '7z': 'ri-file-zip-line',
            // Default
            'default': 'ri-file-line'
        };

        return iconMap[fileExt] || iconMap['default'];
    }

    formatFileSize(bytes) {
        if (!bytes) return '';

        const sizes = ['B', 'KB', 'MB', 'GB'];
        let i = 0;
        let size = bytes;

        while (size >= 1024 && i < sizes.length - 1) {
            size /= 1024;
            i++;
        }

        return `${Math.round(size * 100) / 100} ${sizes[i]}`;
    }


    sanitizeMessage(message) {
        return DOMPurify.sanitize(message);
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



// Message Handler
class MessageHandler {
     constructor(dependencies) {

// Destructure dependencies
        const { state, fileHandler } = dependencies;

        // Validate required dependencies
        if (!state || !fileHandler) {
            throw new Error('MessageHandler: Missing required dependencies');
        }

        this.state = state;
        this.fileHandler = fileHandler;  // Store the fileHandler reference
        //this.chatHistoryHandler = chatHistoryHandler;
        this.chatWindow = document.querySelector('.chat-history-body');
        this.messageQueue = [];
        this.BATCH_SIZE = 10;
        this.BATCH_TIMEOUT = 1000;
        this.scrollHandler = debounce(this.handleScroll.bind(this), 200);


        console.log('MessageHandler initialized with dependencies');

    }


    async sendMessage(messageText, files) {
    if (this.messageQueue.length > 0) {
        console.warn("Previous message still processing. Please wait.");
        return;
    }

    this.messageQueue.push({ messageText, files });

    while (this.messageQueue.length > 0) {
        const { messageText, files } = this.messageQueue.shift();
        const success = await this._sendMessageInternal(messageText, files);

        if (!success) return false; // If message sending fails, return false
    }

    return true;
}





     async _sendMessageInternal(messageText, files) {

     if (!this.fileHandler) {
            console.error('FileHandler not properly initialized');
            UIFeedback.showError("System error: File handling not available");
            return false;
        }
        console.log('Sending message with state:', {
            messageText,
            files,
            isFileUploaded: this.state.isFileUploaded
        });

        if (!messageText && (!files || files.length === 0)) {
            UIFeedback.showError("Please type a message or select a file.");
            return false;
        }

        if (files && files.length > 0) {
            // Check if files are properly uploaded
            const tempFilesInfo = this.fileHandler.getSelectedFiles();
            console.log('Temp files before sending:', tempFilesInfo);

            if (!tempFilesInfo || tempFilesInfo.length === 0) {
                console.log('No temporary files found for uploaded files');
                UIFeedback.showError("File upload incomplete or failed. Please try again.");
                return false;
            }
        }


        const formData = this.createMessageFormData(messageText, files);

        try {
            const response = await fetch('/Admin2 - Copy/chat/sendMessage.php', {
                method: 'POST',
                headers: { 'X-CSRF-Token': window.csrfToken },  // Send CSRF token
                body: formData
            });

            const data = await response.json();

            console.log('Send message response:', data); // Debug log

            if (data.success) {
                this.handleMessageSuccess();
                return true;
            } else {
                throw new Error(data.message || 'Failed to send message');
            }
        } catch (error) {
            console.error('Error sending message:', error);
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
                     sender_id: senderId      // Use sender_id instead of user_id  user_id: this.state.currentUserId
                })
            });


           if (!response.ok) {
            throw new Error(`Server responded with ${response.status}`);
        }



            const data = await response.json();
            if (data.success) {
                this.state.lastReadMessageId = Math.max(this.state.lastReadMessageId, ...projectId);
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
        formData.append('csrf_token', window.csrfToken);  // Include CSRF Token

    // Add temporary file information if files are present
        if (files && files.length > 0) {
            // Get the file information directly from FileHandler
            const tempFilesInfo = this.fileHandler.getSelectedFiles();

            console.log('Files to be sent:', files); // Debug log
            console.log('Temp files info:', tempFilesInfo); // Debug log

            if (tempFilesInfo && tempFilesInfo.length > 0) {
                formData.append('temp_files', JSON.stringify(tempFilesInfo));
            }
        }

        // Log the complete form data for debugging
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }



        return formData;
    }

    handleMessageSuccess() {
        const messageInput = document.querySelector('.message-input');
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const uploadProgress = document.getElementById(`multipleFileProgress`);
        const extendUploadWindow = document.getElementById('extendUploadWindow');

        // Reset form elements
        if (messageInput) messageInput.value = "";
        if (fileInput) fileInput.value = "";
        if (fileNameDisplay) {
            fileNameDisplay.value = "";
            fileNameDisplay.style.display = 'none';
        }
        if (uploadProgress) uploadProgress.innerHTML = '';
        if (extendUploadWindow) extendUploadWindow.style.overflow = 'hidden';

        // Reset file handler state
        if (this.fileHandler) {
            this.fileHandler.uploadedFiles = [];
            this.fileHandler.resetState();
        }
        alert("clearing12222 ");

        this.state.isFileUploaded = false;
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
        this.pollingTimeout = null;
        this.isPolling = false;
    }

    startPolling() {
        this.isPolling = true;
        const poll = async () => {
            if (!this.isPolling || this.isUpdating) return;
            this.isUpdating = true;

            try {
                await this.updateCallback();
                this.currentInterval = this.baseInterval;
                this.errorCount = 0;
            } catch (error) {
                this.handlePollingError(error);
            } finally {
                this.isUpdating = false;
                if (this.isPolling) {
                    this.pollingTimeout = setTimeout(poll, this.currentInterval);
                }
            }
        };

        poll();
    }

    stopPolling() {
        this.isPolling = false;
        if (this.pollingTimeout) {
            clearTimeout(this.pollingTimeout);
            this.pollingTimeout = null;
        }
    }

    dispose() {
        this.stopPolling();
        this.updateCallback = null;
    }
}

// Main Chat Application
class ChatApplication {
    constructor() {
        // Initialize state first
        this.state = new ChatState();

        this.cleanupHandlers = new Set();

        // Initialize all handlers with proper dependencies
        this.initializeHandlers();

        // Initialize the application
        this.initialize();
    }


    registerCleanup(handler) {
        this.cleanupHandlers.add(handler);
    }

    initializeHandlers() {
        // Create handlers in the correct order with proper dependencies
        try {
            // 1. Create file handling system first
            this.fileHandler = new FileHandler(this.state);

            // 2. Create UI components that depend on file handler
            this.fileUploadUI = new FileUploadUI(this.fileHandler);

            // 3. Create other handlers with necessary dependencies
            this.fileListHandler = new FileListHandler(this.state);
            this.chatHistoryHandler = new ChatHistoryHandler(this.state);

            // 4. Create message handler with file handler dependency
            this.messageHandler = new MessageHandler({
                state: this.state,
                fileHandler: this.fileHandler
            });

            console.log('Handlers initialized successfully');
        } catch (error) {
            console.error('Error initializing handlers:', error);
            ErrorHandler.handleError(error, 'Handler initialization');
        }
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
        const messageForm = document.querySelector('.form-send-message');
        const fileInput = document.getElementById('fileInput');
        const chatHistoryBody = document.querySelector('.chat-history-body');

        if (messageForm) {
            messageForm.addEventListener('submit', this.handleMessageSubmit.bind(this));
        }

       if (fileInput) {
            // Single point for file input handling
            fileInput.addEventListener('change', async (event) => {
                event.preventDefault();
                await this.fileHandler.handleMultipleFileUpload(event);
            });
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

        if (!messageInput) return;

        const messageText = messageInput.value.trim();
        const files = this.fileHandler.getSelectedFiles();

        if (await this.messageHandler.sendMessage(messageText, files)) {
            this.fileHandler.uploadQueue.clear();
            this.fileUploadUI.resetUIState();
            this.chatHistoryHandler.loadChatHistory();
            this.fileListHandler.updateFilesList();
            messageInput.value = '';

            setTimeout(() => {
                this.messageHandler.scrollToBottom();
            }, 500);
        }
    }

    async handleFileSelect(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            try {
                // Process files through FileHandler
                const validFiles = await this.fileHandler.handleMultipleFileUpload(event);

                // Update file list if files were successfully processed
                if (validFiles && validFiles.length > 0) {
                    this.fileListHandler.updateFilesList();
                }

                // Enable/disable send button based on file status
                const sendButton = document.querySelector('.btn-send-message');
                if (sendButton) {
                    sendButton.disabled = !this.fileHandler.uploadQueue.completed.size;
                }
            } catch (error) {
                console.error('Error handling file selection:', error);
                UIFeedback.showError('Failed to process selected files');
            }
        }
    }

    setupRealtimeUpdates() {
        // Chat history updates
        const chatUpdateManager = new RealtimeUpdateManager(
            () => this.chatHistoryHandler.loadChatHistory(),
            { baseInterval: 5000, maxInterval: 30000 }
        );
        chatUpdateManager.startPolling();

        // We've removed the file list polling as per your comment
    }

    async initializeChat() {
        await this.chatHistoryHandler.loadChatHistory();
        this.fileListHandler.updateFilesList();
    }
            //////
    // Add cleanup method for proper resource management
    dispose() {
        // Execute all cleanup handlers
        for (const handler of this.cleanupHandlers) {
            try {
                handler();
            } catch (error) {
                console.error('Cleanup handler failed:', error);
            }
        }

        // Clear cleanup handlers
        this.cleanupHandlers.clear();

        // Dispose all major components
        this.fileHandler?.dispose();
        this.messageHandler?.dispose();
        this.chatHistoryHandler?.dispose();
        this.fileListHandler?.dispose();
        this.fileUploadUI?.dispose();

        // Clear state
        this.state = null;

        // Remove global reference
        if (window.chatApp === this) {
            delete window.chatApp;
        }
    }
}
                                 /////////////////
// Initialize the chat application
// Initialize the chat application when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    try {
        window.chatApp = new ChatApplication();

        // Add window unload handler for cleanup
        window.addEventListener('unload', () => {
            if (window.chatApp) {
                window.chatApp.dispose();
            }
        });
    } catch (error) {
        console.error('Failed to initialize chat application:', error);
        ErrorHandler.handleError(error, 'Chat application initialization');
    }
});