class FileHandler {
    constructor(state) {
        console.log('FileHandler initialized');
        this.state = state;
        this.uploadQueue = [];
        this.allowedTypes = new Set([
            'image/jpeg',
            'image/png',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/zip', // ✅ ZIP files
            'application/x-7z-compressed'
        ]);
    }

    validateFile(file) {
        console.log('Validating file:', file);

        if (!file) {
            console.error('No file provided');
            throw new Error('No file selected');
        }

        if (file.size > this.state.MAX_FILE_SIZE) {
            console.error(`File too large: ${file.name}, size: ${file.size}`);
            throw new Error(`File too large (max 500MB): ${file.name}`);
        }

        console.log('File type:', file.type);
        if (!this.allowedTypes.has(file.type)) {
            console.error(`Unsupported file type: ${file.type}`);
            throw new Error(`File type not allowed: ${file.type}`);
        }

        console.log('File validation passed');
        return true;
    }

    async uploadFiles(files) {
        console.log('Upload files method called', files);

        // Ensure files is an array
        files = Array.from(files);

        console.log('Converted files:', files);

        if (!files || files.length === 0) {
            console.error('No files selected');
            this.showError('No files selected');
            return false;
        }

        // Validate and filter files
        const validFiles = files.filter(file => {
            try {
                return this.validateFile(file);
            } catch (error) {
                console.error('File validation error:', error);
                this.showError(error.message);
                return false;
            }
        });

        console.log('Valid files:', validFiles);

        if (validFiles.length === 0) {
            console.error('No valid files to upload');
            this.showError('No valid files to upload');
            return false;
        }

        // Show file names
        this.updateFileNameDisplay(validFiles.map(f => f.name));

        // Show upload progress
        this.showUploadProgress();

        try {
            for (const file of validFiles) {
                await this.uploadSingleFile(file);
            }

            this.state.isFileUploaded = true;
            return true;
        } catch (error) {
            console.error('Upload error:', error);
            this.showError(error.message);
            return false;
        }
    }

    updateFileNameDisplay(fileNames) {
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        console.log('Updating file name display:', fileNames);

        if (fileNameDisplay) {
            fileNameDisplay.textContent = `Selected Files: ${fileNames.join(', ')}`;
            fileNameDisplay.style.display = 'block';
        } else {
            console.error('File name display element not found');
        }
    }

    showUploadProgress() {
        const uploadProgress = document.getElementById('uploadProgress');
        console.log('Showing upload progress');

        if (uploadProgress) {
            uploadProgress.style.display = 'block';
            uploadProgress.style.width = '0%';
        } else {
            console.error('Upload progress element not found');
        }
    }

    uploadSingleFile(file) {
        return new Promise((resolve, reject) => {
            console.log('Uploading single file:', file.name);

            const formData = new FormData();
            formData.append('files[]', file);

            const xhr = new XMLHttpRequest();
            xhr.upload.addEventListener('progress', (event) => {
                if (event.lengthComputable) {
                    const progress = Math.round((event.loaded / event.total) * 100);
                    console.log(`Upload progress for ${file.name}: ${progress}%`);
                    this.updateUploadProgress(progress);
                }
            });

            xhr.onload = () => {
                console.log('XHR onload', xhr.status);
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        console.log('Upload response:', response);

                        if (response.success) {
                            resolve(response);
                        } else {
                            reject(new Error(response.message || 'Upload failed'));
                        }
                    } catch (error) {
                        console.error('Response parsing error:', error);
                        reject(new Error('Invalid server response'));
                    }
                } else {
                    reject(new Error(`Upload failed: ${xhr.statusText}`));
                }
            };

            xhr.onerror = (error) => {
                console.error('XHR error:', error);
                reject(new Error('Network error during upload'));
            };

            xhr.open('POST', '/Admin2 - Copy/chat/uploadFile.php', true);
            xhr.send(formData);
        });
    }

    updateUploadProgress(progress) {
        const uploadProgress = document.getElementById('uploadProgress');
        console.log('Updating upload progress:', progress);

        if (uploadProgress) {
            uploadProgress.style.width = `${progress}%`;
            uploadProgress.textContent = `${progress}%`;
        } else {
            console.error('Upload progress element not found');
        }
    }

    showError(message) {
        console.error('FileHandler Error:', message);
        // Implement your error display mechanism
        alert(message); // Temporary error display
    }
}