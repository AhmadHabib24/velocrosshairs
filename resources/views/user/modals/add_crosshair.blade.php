<!-- User Add CrossChair Modal -->
<div class="modal" id="userAddCrosshairModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-plus-circle"></i>
                Submit Your Crosshair
            </h3>
            <button class="modal-close" onclick="closeUserAddModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="submission-notice">
                <i class="fas fa-info-circle"></i>
                <p>Your crosshair will be reviewed by our team before being published.</p>
            </div>

            <form action="{{ route('user.crosshair.store') }}" method="POST" enctype="multipart/form-data" id="userCrosshairForm">
                @csrf
                
                <!-- Category Selection -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-folder"></i>
                        Category *
                    </label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text">Choose the category that best fits your crosshair</small>
                </div>
                
                <!-- Crosshair Name -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>
                        Crosshair Name *
                    </label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g., TenZ Pro Crosshair">
                    <small class="form-text">Give your crosshair a descriptive name</small>
                </div>
                
                <!-- Crosshair Code -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-code"></i>
                        Crosshair Code *
                    </label>
                    <textarea name="crosshair_code" class="form-control" rows="3" required placeholder="0;P;c;1;h;0;f;0;0l;5;0o;0;0a;1;0f;0;1b;0"></textarea>
                    <small class="form-text">
                        <i class="fas fa-question-circle"></i>
                        Paste your complete Valorant crosshair code here
                    </small>
                </div>
                
                <!-- Description -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-align-left"></i>
                        Description (Optional)
                    </label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Tell us about your crosshair, who uses it, or why it's effective..."></textarea>
                    <small class="form-text">Share details about this crosshair setup</small>
                </div>
                
                <!-- Image Upload -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image"></i>
                        Crosshair Screenshot (Optional)
                    </label>
                    <div class="image-upload-wrapper">
                        <input type="file" name="image" class="form-control" accept="image/*" id="crosshairImageInput">
                        <div class="image-preview" id="imagePreview" style="display: none;">
                            <img src="" alt="Preview" id="previewImage">
                            <button type="button" class="remove-image" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <small class="form-text">
                        <i class="fas fa-camera"></i>
                        Upload a screenshot of your crosshair (PNG, JPG, WEBP)
                    </small>
                </div>

                <!-- Hidden Fields (Auto-generated) -->
                <input type="hidden" name="status" value="pending">
                
                <!-- Terms Checkbox -->
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="terms_accepted" class="form-check-input" id="termsCheck" required>
                        <label for="termsCheck" class="form-label" style="margin-bottom: 0; font-size: 0.85rem;">
                            I confirm this crosshair is accurate and follows community guidelines
                        </label>
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="modal-footer-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeUserAddModal()">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Submit for Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    
    .modal.active {
        display: flex;
    }
    
    .modal-content {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 16px;
        max-width: 600px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    }
    
    .modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        background: var(--dark-card);
        z-index: 10;
    }
    
    .modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .modal-title i {
        color: var(--primary-pink);
    }
    
    .modal-close {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        border: 1px solid var(--dark-border);
        background: var(--dark-bg);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .modal-close:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
        transform: rotate(90deg);
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    /* Submission Notice */
    .submission-notice {
        background: rgba(52, 152, 219, 0.1);
        border: 1px solid rgba(52, 152, 219, 0.3);
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: start;
        gap: 0.75rem;
    }
    
    .submission-notice i {
        color: var(--info);
        font-size: 1.2rem;
        margin-top: 0.1rem;
    }
    
    .submission-notice p {
        margin: 0;
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.5;
    }
    
    /* Form Groups */
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    
    .form-label i {
        color: var(--primary-pink);
        font-size: 0.9rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 3px rgba(255, 45, 95, 0.1);
    }
    
    .form-control::placeholder {
        color: var(--text-muted);
    }
    
    select.form-control {
        cursor: pointer;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }
    
    .form-text {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 0.4rem;
    }
    
    .form-text i {
        font-size: 0.7rem;
    }
    
    /* Image Upload */
    .image-upload-wrapper {
        position: relative;
    }
    
    .image-preview {
        margin-top: 1rem;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--dark-border);
    }
    
    .image-preview img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .remove-image {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 30px;
        height: 30px;
        border-radius: 6px;
        background: var(--danger);
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .remove-image:hover {
        transform: scale(1.1);
    }
    
    /* Checkbox */
    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-check-input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--primary-pink);
    }
    
    /* Footer Actions */
    .modal-footer-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--dark-border);
    }
    
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-secondary {
        background: var(--dark-bg);
        color: var(--text-secondary);
        border: 1px solid var(--dark-border);
    }
    
    .btn-secondary:hover {
        background: var(--dark-card);
        color: var(--text-primary);
    }
    
    .btn-primary {
        background: var(--primary-gradient);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--glow-pink);
    }
</style>

<script>
    // Open Modal
    function openUserAddModal() {
        document.getElementById('userAddCrosshairModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    // Close Modal
    function closeUserAddModal() {
        document.getElementById('userAddCrosshairModal').classList.remove('active');
        document.body.style.overflow = '';
        document.getElementById('userCrosshairForm').reset();
        document.getElementById('imagePreview').style.display = 'none';
    }
    
    // Image Preview
    document.getElementById('crosshairImageInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Remove Image
    function removeImage() {
        document.getElementById('crosshairImageInput').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    }
    
    // Close modal on outside click
    document.getElementById('userAddCrosshairModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeUserAddModal();
        }
    });
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeUserAddModal();
        }
    });
</script>