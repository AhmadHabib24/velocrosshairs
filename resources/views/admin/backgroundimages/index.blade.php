@extends('admin.layout')

@section('title', 'Background Images')

@section('content')
<style>
    /* Alert Messages */
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .alert-success {
        background: rgba(0, 210, 91, 0.15);
        border: 1px solid var(--success);
        color: var(--success);
    }
    
    /* Content Card */
    .content-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 1.5rem;
    }
    
    .content-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .content-card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }
    
    /* Button */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-primary {
        background: var(--primary-gradient);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--glow-pink);
    }
    
    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
    
    .btn-info {
        background: #3498db;
        color: white;
    }
    
    .btn-warning {
        background: var(--warning);
        color: white;
    }
    
    .btn-danger {
        background: var(--danger);
        color: white;
    }
    
    /* Table */
    .table-responsive {
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table thead {
        background: rgba(255, 45, 95, 0.1);
    }
    
    .table th {
        padding: 1rem;
        text-align: left;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table td {
        padding: 1rem;
        border-bottom: 1px solid var(--dark-border);
        font-size: 0.85rem;
        color: var(--text-secondary);
    }
    
    .table tbody tr:hover {
        background: rgba(255, 45, 95, 0.05);
    }
    
    .bg-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .bg-image:hover {
        transform: scale(1.1);
    }
    
    .category-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .category-tag {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        background: rgba(255, 45, 95, 0.15);
        color: var(--primary-pink);
    }
    
    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 2000;
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
        border-radius: 12px;
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
    }
    
    .modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-title {
        font-size: 1.2rem;
        font-weight: 600;
    }
    
    .modal-close {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 1.5rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    
    .modal-close:hover {
        color: var(--primary-pink);
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    /* Form */
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem;
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
        box-shadow: var(--glow-pink);
    }
    
    .form-text {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
        display: block;
    }
    
    /* Select2 Custom Styling */
    .select2-container--default .select2-selection--multiple {
        background: var(--dark-bg) !important;
        border: 1px solid var(--dark-border) !important;
        border-radius: 8px !important;
        padding: 0.5rem !important;
        min-height: 45px !important;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: var(--primary-gradient) !important;
        border: none !important;
        color: white !important;
        border-radius: 6px !important;
        padding: 0.3rem 0.8rem !important;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white !important;
        margin-right: 0.5rem !important;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: var(--danger) !important;
    }
    
    .select2-dropdown {
        background: var(--dark-card) !important;
        border: 1px solid var(--dark-border) !important;
        border-radius: 8px !important;
    }
    
    .select2-results__option {
        color: var(--text-primary) !important;
        padding: 0.75rem !important;
    }
    
    .select2-results__option--highlighted {
        background: rgba(255, 45, 95, 0.15) !important;
    }
    
    .select2-search__field {
        background: var(--dark-bg) !important;
        border: 1px solid var(--dark-border) !important;
        color: var(--text-primary) !important;
        border-radius: 8px !important;
        padding: 0.5rem !important;
    }
    
    /* Image Preview */
    .image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        margin-top: 0.5rem;
    }
    
    /* Image Modal */
    .image-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.95);
        z-index: 3000;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    
    .image-modal.active {
        display: flex;
    }
    
    .image-modal img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    }
</style>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="content-card">
    <div class="content-card-header">
        <h2 class="content-card-title">Background Images</h2>
        <button class="btn btn-primary" onclick="openAddModal()">
            <i class="fas fa-plus"></i>
            Add Background Image
        </button>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Assigned Categories</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($backgroundImages as $bgImage)
                    <tr>
                        <td>{{ $bgImage->id }}</td>
                        <td>
                            @if($bgImage->image)
                               <img src="{{ asset('storage/' . $bgImage->image) }}" 
     alt="{{ $bgImage->name }}" 
     class="bg-image"
     onclick="showImageModal('{{ asset('storage/' . $bgImage->image) }}')">

                            @else
                                <div class="bg-image" style="background: var(--dark-bg); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="color: var(--text-muted);"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $bgImage->name }}</td>
                        <td>
                            <div class="category-tags">
                                @if($bgImage->assigned_categories && count($bgImage->assigned_categories) > 0)
                                    @php
                                        $categories = \App\Models\Category::whereIn('id', $bgImage->assigned_categories)->get();
                                    @endphp
                                    @foreach($categories as $category)
                                        <span class="category-tag">{{ $category->name }}</span>
                                    @endforeach
                                @else
                                    <span style="color: var(--text-muted); font-size: 0.8rem;">No categories assigned</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($bgImage->creator)
                                {{ $bgImage->creator->name }}
                            @else
                                <span style="color: var(--text-muted);">N/A</span>
                            @endif
                        </td>
                        <td>{{ $bgImage->created_at->format('M d, Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-info" 
                                        onclick="openEditModal({{ $bgImage->id }})"
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.CrossChairbg.copy', $bgImage->id) }}" 
                                      method="POST" 
                                      style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" title="Copy">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.CrossChairbg.destroy', $bgImage->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this background image?');"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                            No background images found. Click "Add Background Image" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 1.5rem;">
        {{ $backgroundImages->links() }}
    </div>
</div>

<!-- Add Background Image Modal -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add New Background Image</h3>
            <button class="modal-close" onclick="closeAddModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.CrossChairbg.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Image Name *</label>
                    <input type="text" name="name" class="form-control" required placeholder="Enter image name">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Background Image *</label>
                    <input type="file" 
                           name="image" 
                           class="form-control" 
                           accept="image/*" 
                           required
                           onchange="previewImage(event, 'add_preview')">
                    <small class="form-text">Accepted formats: JPEG, PNG, JPG, GIF, WEBP (Max: 5MB)</small>
                    <div id="add_preview"></div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Assign to Categories</label>
                    <select name="assigned_categories[]" 
                            id="add_categories" 
                            class="form-control" 
                            multiple="multiple">
                        @php
                            $allCategories = \App\Models\Category::where('is_active', true)->orderBy('order')->get();
                        @endphp
                        @foreach($allCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text">Select one or more categories. Leave empty for no assignment.</small>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                    <button type="button" class="btn" onclick="closeAddModal()" style="background: var(--dark-bg); color: var(--text-secondary);">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Save Background Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Background Image Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Background Image</h3>
            <button class="modal-close" onclick="closeEditModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Image Name *</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Background Image</label>
                    <div id="current_image_preview" style="margin-bottom: 0.5rem;"></div>
                    <input type="file" 
                           name="image" 
                           class="form-control" 
                           accept="image/*"
                           onchange="previewImage(event, 'edit_preview')">
                    <small class="form-text">Leave empty to keep current image</small>
                    <div id="edit_preview"></div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Assign to Categories</label>
                    <select name="assigned_categories[]" 
                            id="edit_categories" 
                            class="form-control" 
                            multiple="multiple">
                        @foreach($allCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text">Select one or more categories</small>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                    <button type="button" class="btn" onclick="closeEditModal()" style="background: var(--dark-bg); color: var(--text-secondary);">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Background Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="image-modal" id="imageModal" onclick="closeImageModal()">
    <img id="modalImage" src="" alt="Preview">
</div>

<!-- Include jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@push('scripts')
<script>
    // CSRF Token Setup
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Initialize Select2
    $(document).ready(function() {
        $('#add_categories').select2({
            placeholder: 'Select categories',
            allowClear: true,
            dropdownParent: $('#addModal')
        });
        
        $('#edit_categories').select2({
            placeholder: 'Select categories',
            allowClear: true,
            dropdownParent: $('#editModal')
        });
    });
    
    // Add Modal Functions
    function openAddModal() {
        document.getElementById('addModal').classList.add('active');
        $('#add_categories').val(null).trigger('change'); // Reset select2
    }
    
    function closeAddModal() {
        document.getElementById('addModal').classList.remove('active');
        document.getElementById('add_preview').innerHTML = '';
    }
    
    // Edit Modal Functions
    function openEditModal(bgImageId) {
        fetch(`/CrossChairbg/${bgImageId}/edit`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Populate form fields
            document.getElementById('edit_name').value = data.name;
            
            // Set selected categories in Select2
            $('#edit_categories').val(data.assigned_categories).trigger('change');
            
            // Show current image if exists
            const imagePreview = document.getElementById('current_image_preview');
            if (data.image) {
                imagePreview.innerHTML = `
                    <div style="margin-bottom: 1rem;">
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">Current Image:</p>
                        <img src="/storage/${data.image}" class="image-preview">
                    </div>
                `;
            } else {
                imagePreview.innerHTML = '';
            }
            
            // Clear edit preview
            document.getElementById('edit_preview').innerHTML = '';
            
            // Set form action
            document.getElementById('editForm').action = `/CrossChairbg/${bgImageId}`;
            
            // Open modal
            document.getElementById('editModal').classList.add('active');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load background image data');
        });
    }
    
    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }
    
    // Image Preview Function
    function previewImage(event, previewId) {
        const file = event.target.files[0];
        const preview = document.getElementById(previewId);
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div style="margin-top: 1rem;">
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">Preview:</p>
                        <img src="${e.target.result}" class="image-preview">
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    }
    
    // Image Modal Functions
    function showImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.add('active');
    }
    
    function closeImageModal() {
        document.getElementById('imageModal').classList.remove('active');
    }
    
    // Close modals when clicking outside
    document.getElementById('addModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddModal();
        }
    });
    
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
    
    // Close modals with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
            closeImageModal();
        }
    });
</script>
@endpush
@endsection