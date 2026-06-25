@extends('admin.layout')

@section('title', 'Categories')

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
    
    .btn-success {
        background: var(--success);
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
    
    .category-image {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-success {
        background: rgba(0, 210, 91, 0.15);
        color: var(--success);
    }
    
    .badge-danger {
        background: rgba(255, 71, 87, 0.15);
        color: var(--danger);
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
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-check-input {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
    
    .form-text {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
        display: block;
    }
</style>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="content-card">
    <div class="content-card-header">
        <h2 class="content-card-title">All Categories</h2>
        <button class="btn btn-primary" onclick="openAddModal()">
            <i class="fas fa-plus"></i>
            Add Category
        </button>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            @if($category->image)
                               <img src="{{ url('storage/app/public/' . $category->image) }}" 
     alt="{{ $category->name }}" 
     class="category-image">

                            @else
                                <div class="category-image" style="background: var(--dark-bg); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="color: var(--text-muted);"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td><code style="color: var(--primary-coral);">{{ $category->slug }}</code></td>
                        <td>{{ $category->order }}</td>
                        <td>
                            <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <button class="btn btn-sm btn-warning" 
                                        onclick="openEditModal({{ $category->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-success" 
                                        onclick="toggleStatus({{ $category->id }})">
                                    <i class="fas fa-toggle-on"></i>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this category?');"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                            No categories found. Click "Add Category" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 1.5rem;">
        {{ $categories->links() }}
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add New Category</h3>
            <button class="modal-close" onclick="closeAddModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Slug (SEO URL)</label>
                    <input type="text" name="slug" class="form-control" placeholder="Leave empty to auto-generate">
                    <small class="form-text">Leave empty to auto-generate from name</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Meta Title (SEO)</label>
                    <input type="text" name="meta_title" class="form-control" placeholder="Leave empty to use category name">
                    <small class="form-text">Recommended: 50-60 characters</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Meta Description (SEO)</label>
                    <textarea name="meta_description" class="form-control" rows="3"></textarea>
                    <small class="form-text">Recommended: 150-160 characters</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Meta Keywords (SEO)</label>
                    <input type="text" name="meta_keywords" class="form-control" placeholder="keyword1, keyword2, keyword3">
                    <small class="form-text">Comma-separated keywords</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Category Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active_add" value="1" checked>
                        <label for="is_active_add" class="form-label" style="margin-bottom: 0;">Active</label>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="btn" onclick="closeAddModal()" style="background: var(--dark-bg); color: var(--text-secondary);">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Category</h3>
            <button class="modal-close" onclick="closeEditModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Slug (SEO URL)</label>
                    <input type="text" name="slug" id="edit_slug" class="form-control">
                    <small class="form-text">Leave empty to auto-generate from name</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="edit_description" class="form-control"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Meta Title (SEO)</label>
                    <input type="text" name="meta_title" id="edit_meta_title" class="form-control">
                    <small class="form-text">Recommended: 50-60 characters</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Meta Description (SEO)</label>
                    <textarea name="meta_description" id="edit_meta_description" class="form-control" rows="3"></textarea>
                    <small class="form-text">Recommended: 150-160 characters</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Meta Keywords (SEO)</label>
                    <input type="text" name="meta_keywords" id="edit_meta_keywords" class="form-control">
                    <small class="form-text">Comma-separated keywords</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Category Image</label>
                    <div id="current_image_preview" style="margin-bottom: 0.5rem;"></div>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text">Leave empty to keep current image</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="order" id="edit_order" class="form-control">
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active_edit" value="1">
                        <label for="is_active_edit" class="form-label" style="margin-bottom: 0;">Active</label>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="btn" onclick="closeEditModal()" style="background: var(--dark-bg); color: var(--text-secondary);">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // CSRF Token Setup
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Add Modal Functions
    function openAddModal() {
        document.getElementById('addModal').classList.add('active');
    }
    
    function closeAddModal() {
        document.getElementById('addModal').classList.remove('active');
    }
    
    // Edit Modal Functions
    function openEditModal(categoryId) {
        fetch(`/admin/categories/${categoryId}/edit`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Populate form fields
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_slug').value = data.slug;
            document.getElementById('edit_description').value = data.description || '';
            document.getElementById('edit_meta_title').value = data.meta_title || '';
            document.getElementById('edit_meta_description').value = data.meta_description || '';
            document.getElementById('edit_meta_keywords').value = data.meta_keywords || '';
            document.getElementById('edit_order').value = data.order;
            document.getElementById('is_active_edit').checked = data.is_active;
            
            // Show current image if exists
            const imagePreview = document.getElementById('current_image_preview');
            if (data.image) {
                imagePreview.innerHTML = `<img src="/storage/${data.image}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">`;
            } else {
                imagePreview.innerHTML = '';
            }
            
            // Set form action
            document.getElementById('editForm').action = `/admin/categories/${categoryId}`;
            
            // Open modal
            document.getElementById('editModal').classList.add('active');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load category data');
        });
    }
    
    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }
    
    // Toggle Status Function
    function toggleStatus(categoryId) {
        if (!confirm('Are you sure you want to toggle this category status?')) {
            return;
        }
        
        fetch(`/admin/categories/${categoryId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to toggle status');
        });
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
        }
    });
</script>
@endpush
@endsection