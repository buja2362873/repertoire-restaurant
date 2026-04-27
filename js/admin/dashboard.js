/**
 * Admin Dashboard JavaScript
 * Handles modal interactions and CRUD operations
 */

class AdminDashboard {
    constructor() {
        this.modal = document.getElementById('adminModal');
        this.form = document.getElementById('adminForm');
        this.formFields = document.getElementById('formFields');
        this.modalTitle = document.getElementById('modalTitle');
        this.submitBtn = document.getElementById('submitBtn');
        
        this.currentMode = 'add'; // 'add' or 'edit'
        this.currentRow = null;
        this.currentId = null;
        
        this.init();
    }

    init() {
        // Button listeners
        const addBtns = document.querySelectorAll('#addNewBtn, #addNewBtnEmpty');
        addBtns.forEach(btn => btn.addEventListener('click', () => this.openAddModal()));

        const editBtns = document.querySelectorAll('.admin-btn-edit');
        editBtns.forEach(btn => btn.addEventListener('click', (e) => this.openEditModal(e)));

        const deleteBtns = document.querySelectorAll('.admin-btn-delete');
        deleteBtns.forEach(btn => btn.addEventListener('click', (e) => this.deleteRecord(e)));

        // Modal controls
        document.getElementById('closeModal').addEventListener('click', () => this.closeModal());
        document.getElementById('cancelBtn').addEventListener('click', () => this.closeModal());
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) this.closeModal();
        });

        // Form submission
        this.form.addEventListener('submit', (e) => this.handleFormSubmit(e));
    }

    generateFormFields() {
        this.formFields.innerHTML = '';

        // System fields that should never be editable
        const systemFields = ['id', 'created_at', 'updated_at', 'created_At', 'updated_At'];
        
        // Keywords that indicate an image field
        const imageKeywords = ['image', 'photo', 'picture', 'img', 'visual', 'illustration'];

        tableColumns.forEach(column => {
            // Skip system fields
            if (systemFields.includes(column.name)) {
                return;
            }

            const group = document.createElement('div');
            group.className = 'admin-form-group';

            const label = document.createElement('label');
            label.className = 'admin-label';
            label.htmlFor = column.name;
            label.textContent = this.formatColumnName(column.name);

            let input;
            
            // Check if this is an image field
            const isImageField = imageKeywords.some(keyword => 
                column.name.toLowerCase().includes(keyword)
            );

            if (isImageField) {
                // Create file input for image fields
                input = document.createElement('input');
                input.type = 'file';
                input.className = 'admin-file-input';
                input.accept = 'image/*';
                input.id = column.name;
                input.name = column.name;
                
                // Add preview container
                const previewContainer = document.createElement('div');
                previewContainer.className = 'admin-image-preview-container';
                previewContainer.id = `preview_${column.name}`;
                
                // Add change listener for preview
                input.addEventListener('change', (e) => this.handleImagePreview(e, column.name));
                
                // If editing and there's an existing image value
                if (this.currentMode === 'edit' && this.currentRow[column.name]) {
                    const existingImage = this.currentRow[column.name];
                    // Try to display existing image
                    if (existingImage.startsWith('data:') || existingImage.startsWith('http')) {
                        const preview = document.createElement('img');
                        preview.src = existingImage;
                        preview.className = 'admin-preview-image';
                        previewContainer.appendChild(preview);
                        
                        // Add a hidden input to store the existing value if no new file is selected
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = `${column.name}_existing`;
                        hiddenInput.value = existingImage;
                        group.appendChild(hiddenInput);
                    }
                }
                
                group.appendChild(label);
                group.appendChild(input);
                group.appendChild(previewContainer);
                this.formFields.appendChild(group);
                return;
            }

            // Determine input type based on column type for non-image fields
            if (column.type.toLowerCase().includes('text')) {
                input = document.createElement('textarea');
                input.className = 'admin-textarea';
            } else if (column.type.toLowerCase().includes('int')) {
                input = document.createElement('input');
                input.type = 'number';
                input.className = 'admin-input';
            } else if (column.type.toLowerCase().includes('date')) {
                input = document.createElement('input');
                input.type = 'date';
                input.className = 'admin-input';
            } else {
                input = document.createElement('input');
                input.type = 'text';
                input.className = 'admin-input';
            }

            input.id = column.name;
            input.name = column.name;
            input.required = !column.notnull ? false : true;

            // Set value if editing
            if (this.currentMode === 'edit' && this.currentRow[column.name]) {
                input.value = this.currentRow[column.name];
            }

            group.appendChild(label);
            group.appendChild(input);
            this.formFields.appendChild(group);
        });
    }
    
    handleImagePreview(e, columnName) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById(`preview_${columnName}`);
        
        // Clear previous previews
        previewContainer.innerHTML = '';
        
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'admin-preview-image';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }

    formatColumnName(name) {
        return name
            .replace(/_/g, ' ')
            .split(' ')
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join(' ');
    }

    openAddModal() {
        this.currentMode = 'add';
        this.currentRow = {};
        this.modalTitle.textContent = 'Add New Record';
        this.submitBtn.textContent = 'Add';
        this.generateFormFields();
        this.modal.classList.add('active');
    }

    openEditModal(e) {
        this.currentMode = 'edit';
        const rowData = e.currentTarget.getAttribute('data-row');
        this.currentRow = JSON.parse(rowData);
        this.currentId = this.currentRow[tableColumns[0].name];
        
        this.modalTitle.textContent = 'Edit Record';
        this.submitBtn.textContent = 'Update';
        this.generateFormFields();
        this.modal.classList.add('active');
    }

    closeModal() {
        this.modal.classList.remove('active');
        this.form.reset();
    }

    async handleFormSubmit(e) {
        e.preventDefault();

        const formData = new FormData(this.form);
        formData.append('table', selectedTable);
        
        // Use 'update' for edit mode, 'add' for add mode
        const action = this.currentMode === 'edit' ? 'update' : this.currentMode;
        formData.append('action', action);

        if (this.currentMode === 'edit') {
            formData.append('id', this.currentId);
            formData.append('idColumn', tableColumns[0].name);
        }

        try {
            const response = await fetch('api.php?action=' + action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                this.showSuccess(result.message);
                this.closeModal();
                setTimeout(() => location.reload(), 1000);
            } else {
                const errorMsg = result.error || 'An error occurred';
                this.showError(errorMsg);
            }
        } catch (error) {
            this.showError('Error: ' + error.message);
        }
    }

    async deleteRecord(e) {
        const id = e.currentTarget.getAttribute('data-id');
        
        if (!confirm('Are you sure you want to delete this record?')) {
            return;
        }

        const formData = new FormData();
        formData.append('table', selectedTable);
        formData.append('action', 'delete');
        formData.append('id', id);
        formData.append('idColumn', tableColumns[0].name);

        try {
            const response = await fetch('api.php?action=delete', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                this.showSuccess(result.message);
                setTimeout(() => location.reload(), 1000);
            } else {
                this.showError(result.error || 'An error occurred');
            }
        } catch (error) {
            this.showError('Error: ' + error.message);
        }
    }

    showSuccess(message) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 15px 20px;
            border-radius: 4px;
            z-index: 2000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        `;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => notification.remove(), 3000);
    }

    showError(message) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 15px 20px;
            border-radius: 4px;
            z-index: 2000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        `;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => notification.remove(), 3000);
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    if (selectedTable) {
        new AdminDashboard();
    }
});
