// Image upload handler
class ImageHandler {
    constructor(options = {}) {
        this.selectedFiles = new DataTransfer();
        this.previewContainer = options.previewContainer || '#imagePreview';
        this.inputElement = options.inputElement || '#images';
        this.maxSize = options.maxSize || 2 * 1024 * 1024; // 2MB default
        this.validTypes = options.validTypes || ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        this.initialize();
    }

    initialize() {
        $(this.inputElement).on('change', (e) => this.handleFileSelect(e));
        $('#clearImages').on('click', () => this.clearImages());
    }

    handleFileSelect(event) {
        const files = event.target.files;
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            if (!this.validateFile(file)) {
                event.target.value = '';
                return;
            }
        }
        
        // Add new files to selectedFiles
        for (let i = 0; i < files.length; i++) {
            this.selectedFiles.items.add(files[i]);
        }
        
        // Update input files
        event.target.files = this.selectedFiles.files;
        
        // Show preview
        this.updatePreview();
    }

    validateFile(file) {
        if (!this.validTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: `File ${file.name} không đúng định dạng. Vui lòng chọn file JPEG, PNG, JPG hoặc GIF.`
            });
            return false;
        }

        if (file.size > this.maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: `File ${file.name} vượt quá kích thước cho phép (${this.maxSize / (1024 * 1024)}MB).`
            });
            return false;
        }

        return true;
    }

    updatePreview() {
        const preview = $(this.previewContainer);
        preview.empty();

        for (let i = 0; i < this.selectedFiles.files.length; i++) {
            const file = this.selectedFiles.files[i];
            const reader = new FileReader();
            
            reader.onload = (e) => {
                preview.append(`
                    <div class="image-container position-relative" data-index="${i}">
                        <img src="${e.target.result}" class="img-thumbnail rounded shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;" onclick="imageHandler.removeImage(${i})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `);
            }
            reader.readAsDataURL(file);
        }
    }

    removeImage(index) {
        const dt = new DataTransfer();
        const files = this.selectedFiles.files;
        
        for (let i = 0; i < files.length; i++) {
            if (i !== index) {
                dt.items.add(files[i]);
            }
        }
        
        this.selectedFiles = dt;
        $(this.inputElement)[0].files = dt.files;
        this.updatePreview();
    }

    clearImages() {
        this.selectedFiles = new DataTransfer();
        $(this.inputElement)[0].files = this.selectedFiles.files;
        $(this.previewContainer).empty();
    }
}

// Initialize form validation
function initializeFormValidation() {
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
} 