@extends('admin.layout')

@section('title', 'Crosshairs Management')

@section('content')
<style>
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
    
    .tabs-container {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--dark-border);
    }
    
    .tab-button {
        padding: 0.75rem 1.5rem;
        background: none;
        border: none;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
    }
    
    .tab-button:hover {
        color: var(--text-primary);
    }
    
    .tab-button.active {
        color: var(--primary-pink);
        border-bottom-color: var(--primary-pink);
    }
    
    .tab-button .count {
        display: inline-block;
        margin-left: 0.5rem;
        padding: 0.2rem 0.5rem;
        background: rgba(255, 45, 95, 0.15);
        border-radius: 12px;
        font-size: 0.75rem;
    }
    
    .tab-button.active .count {
        background: rgba(255, 45, 95, 0.25);
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }
    
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
    
    .btn-info {
        background: #3498db;
        color: white;
    }
    
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
    
    .crosschair-image {
        width: 60px;
        height: 60px;
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
    
    .crosshair-code-display {
        background: var(--dark-bg);
        padding: 0.5rem;
        border-radius: 6px;
        font-family: monospace;
        font-size: 0.75rem;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: var(--primary-coral);
    }
    
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
        overflow-y: auto;
    }
    
    .modal.active {
        display: flex;
    }
    
    .modal-content {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        width: 100%;
        max-width: 700px;
        max-height: 90vh;
        overflow-y: auto;
        margin: auto;
    }
    
    .modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        background: var(--dark-card);
        z-index: 10;
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
    
    .seo-section {
        background: rgba(52, 152, 219, 0.05);
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        border: 1px solid rgba(52, 152, 219, 0.2);
    }
    
    .seo-section-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #3498db;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .char-counter {
        font-size: 0.7rem;
        color: var(--text-muted);
        float: right;
    }
    
    .char-counter.warning {
        color: var(--warning);
    }
    
    .char-counter.danger {
        color: var(--danger);
    }
    
    .detail-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .detail-label {
        font-weight: 600;
        min-width: 150px;
        color: var(--text-muted);
    }
    
    .detail-value {
        flex: 1;
        color: var(--text-primary);
    }
    
    .code-box {
        background: var(--dark-bg);
        padding: 1rem;
        border-radius: 8px;
        font-family: monospace;
        word-break: break-all;
        color: var(--primary-coral);
        border: 1px solid var(--dark-border);
    }
        /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 3rem;
        flex-wrap: wrap;
    }
    
    .pagination .page-link {
        padding: 0.5rem 1rem;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        color: var(--text-secondary);
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover,
    .pagination .page-item.active .page-link {
        background: var(--primary-pink);
        color: white;
        border-color: var(--primary-pink);
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
        <h2 class="content-card-title">All CrossChairs</h2>
        <button class="btn btn-primary" onclick="openAddModal()">
            <i class="fas fa-plus"></i>
            Add CrossChair
        </button>
    </div>
    
    <div class="tabs-container">
        <button class="tab-button active" onclick="switchTab('active')" id="activeTab">
            Active CrossChairs
            <span class="count">{{ $activeCrosschairs->total() }}</span>
        </button>
        <button class="tab-button" onclick="switchTab('inactive')" id="inactiveTab">
            Inactive CrossChairs
            <span class="count">{{ $inactiveCrosschairs->total() }}</span>
        </button>
    </div>
    
    <div class="tab-content active" id="activeContent">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Code</th>
                        <th>Views</th>
                        <th>Copies</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeCrosschairs as $crosschair)
                        <tr>
                            <td>{{ $crosschair->id }}</td>
                            <td>
                                @if($crosschair->image)
                                    <img src="{{ asset('storage/' . $crosschair->image) }}" 
                                         alt="{{ $crosschair->name }}" 
                                         class="crosschair-image">
                                @else
                                    <div class="crosschair-image" style="background: var(--dark-bg); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-crosshairs" style="color: var(--text-muted);"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $crosschair->name }}</strong><br>
                                <small style="color: var(--text-muted);">{{ $crosschair->slug }}</small>
                            </td>
                            <td>
                                <span class="badge" style="background: rgba(255, 45, 95, 0.15); color: var(--primary-pink);">
                                    {{ $crosschair->category->name }}
                                </span>
                            </td>
                            <td>
                                <div class="crosshair-code-display" title="{{ $crosschair->crosshair_code }}">
                                    {{ $crosschair->crosshair_code }}
                                </div>
                            </td>
                            <td>
                                <i class="fas fa-eye" style="color: var(--text-muted);"></i> {{ $crosschair->views }}
                            </td>
                            <td>
                                <i class="fas fa-copy" style="color: var(--text-muted);"></i> {{ $crosschair->copies }}
                            </td>
                            <td>
                                <span class="badge badge-success">Active</span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button class="btn btn-sm btn-info" 
                                            onclick="viewCrosschair({{ $crosschair->id }})"
                                            title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" 
                                            onclick="openEditModal({{ $crosschair->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" 
                                            onclick="toggleStatus({{ $crosschair->id }})">
                                        <i class="fas fa-toggle-on"></i>
                                    </button>
                                    <form action="{{ route('admin.CrossChair.destroy', $crosschair->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this crosschair?');"
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
                            <td colspan="9" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                                No active crosshairs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="pagination">
            {{ $activeCrosschairs->appends(['inactive_page' => request('inactive_page')])->links('vendor.pagination.custom') }}
        </div>
    </div>
    
    <div class="tab-content" id="inactiveContent">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Code</th>
                        <th>Views</th>
                        <th>Copies</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inactiveCrosschairs as $crosschair)
                        <tr>
                            <td>{{ $crosschair->id }}</td>
                            <td>
                                @if($crosschair->image)
                                    <img src="{{ asset('storage/' . $crosschair->image) }}" 
                                         alt="{{ $crosschair->name }}" 
                                         class="crosschair-image">
                                @else
                                    <div class="crosschair-image" style="background: var(--dark-bg); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-crosshairs" style="color: var(--text-muted);"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $crosschair->name }}</strong><br>
                                <small style="color: var(--text-muted);">{{ $crosschair->slug }}</small>
                            </td>
                            <td>
                                <span class="badge" style="background: rgba(255, 45, 95, 0.15); color: var(--primary-pink);">
                                    {{ $crosschair->category->name }}
                                </span>
                            </td>
                            <td>
                                <div class="crosshair-code-display" title="{{ $crosschair->crosshair_code }}">
                                    {{ $crosschair->crosshair_code }}
                                </div>
                            </td>
                            <td>
                                <i class="fas fa-eye" style="color: var(--text-muted);"></i> {{ $crosschair->views }}
                            </td>
                            <td>
                                <i class="fas fa-copy" style="color: var(--text-muted);"></i> {{ $crosschair->copies }}
                            </td>
                            <td>
                                <span class="badge badge-danger">Inactive</span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button class="btn btn-sm btn-info" 
                                            onclick="viewCrosschair({{ $crosschair->id }})"
                                            title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" 
                                            onclick="openEditModal({{ $crosschair->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" 
                                            onclick="toggleStatus({{ $crosschair->id }})">
                                        <i class="fas fa-toggle-off"></i>
                                    </button>
                                    <form action="{{ route('admin.CrossChair.destroy', $crosschair->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this crosschair?');"
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
                            <td colspan="9" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                                No inactive crosshairs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="pagination">
            {{ $inactiveCrosschairs->appends(['active_page' => request('active_page')])->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

<div class="modal" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add New CrossChair</h3>
            <button class="modal-close" onclick="closeAddModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.CrossChair.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">CrossChair Name *</label>
                    <input type="text" name="name" class="form-control" id="add_name" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Slug (SEO URL)</label>
                    <input type="text" name="slug" class="form-control" id="add_slug" placeholder="Leave empty to auto-generate">
                    <small class="form-text">Leave empty to auto-generate from name</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">CrossHair Code *</label>
                    <textarea name="crosshair_code" class="form-control" rows="3" required placeholder="0;P;C;1;h;0;f;0;0l;5;0o;0;0a;1;0f;0;1b;0"></textarea>
                    <small class="form-text">Paste the complete Valorant crosshair code</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">CrossChair Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text">Upload a screenshot of the crosshair (PNG, JPG, WEBP)</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                
                <div class="seo-section">
                    <h4 class="seo-section-title">
                        <i class="fas fa-search"></i>
                        SEO Settings
                    </h4>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Meta Title (SEO)
                            <span class="char-counter" id="add_meta_title_count">0/60</span>
                        </label>
                        <input type="text" name="meta_title" class="form-control" id="add_meta_title" placeholder="Leave empty to auto-generate">
                        <small class="form-text">Recommended: 50-60 characters. Auto-generated if empty.</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Meta Description (SEO)
                            <span class="char-counter" id="add_meta_desc_count">0/160</span>
                        </label>
                        <textarea name="meta_description" class="form-control" id="add_meta_description" rows="3" placeholder="Leave empty to auto-generate"></textarea>
                        <small class="form-text">Recommended: 150-160 characters. Auto-generated if empty.</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Meta Keywords (SEO)</label>
                        <input type="text" name="meta_keywords" class="form-control" placeholder="valorant, crosshair, gaming, fps">
                        <small class="form-text">Comma-separated keywords for SEO</small>
                    </div>
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
                        Save CrossChair
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit CrossChair</h3>
            <button class="modal-close" onclick="closeEditModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category_id" id="edit_category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">CrossChair Name *</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Slug (SEO URL)</label>
                    <input type="text" name="slug" id="edit_slug" class="form-control">
                    <small class="form-text">Leave empty to auto-generate from name</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">CrossHair Code *</label>
                    <textarea name="crosshair_code" id="edit_crosshair_code" class="form-control" rows="3" required></textarea>
                    <small class="form-text">Paste the complete Valorant crosshair code</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">CrossChair Image</label>
                    <div id="current_image_preview" style="margin-bottom: 0.5rem;"></div>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text">Leave empty to keep current image</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Display Order</label>
                    <input type="number" name="order" id="edit_order" class="form-control">
                </div>
                
                <div class="seo-section">
                    <h4 class="seo-section-title">
                        <i class="fas fa-search"></i>
                        SEO Settings
                    </h4>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Meta Title (SEO)
                            <span class="char-counter" id="edit_meta_title_count">0/60</span>
                        </label>
                        <input type="text" name="meta_title" id="edit_meta_title" class="form-control">
                        <small class="form-text">Recommended: 50-60 characters. Auto-generated if empty.</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Meta Description (SEO)
                            <span class="char-counter" id="edit_meta_desc_count">0/160</span>
                        </label>
                        <textarea name="meta_description" id="edit_meta_description" class="form-control" rows="3"></textarea>
                        <small class="form-text">Recommended: 150-160 characters. Auto-generated if empty.</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Meta Keywords (SEO)</label>
                        <input type="text" name="meta_keywords" id="edit_meta_keywords" class="form-control">
                        <small class="form-text">Comma-separated keywords for SEO</small>
                    </div>
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
                        Update CrossChair
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="viewModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">CrossChair Details</h3>
            <button class="modal-close" onclick="closeViewModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="viewModalContent">
        </div>
    </div>
</div>

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    function switchTab(tab) {
        const activeTab = document.getElementById('activeTab');
        const inactiveTab = document.getElementById('inactiveTab');
        const activeContent = document.getElementById('activeContent');
        const inactiveContent = document.getElementById('inactiveContent');
        
        if (tab === 'active') {
            activeTab.classList.add('active');
            inactiveTab.classList.remove('active');
            activeContent.classList.add('active');
            inactiveContent.classList.remove('active');
        } else {
            activeTab.classList.remove('active');
            inactiveTab.classList.add('active');
            activeContent.classList.remove('active');
            inactiveContent.classList.add('active');
        }
    }
    
    function updateCharCounter(inputId, counterId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        
        if (input && counter) {
            input.addEventListener('input', function() {
                const length = this.value.length;
                counter.textContent = `${length}/${maxLength}`;
                
                counter.classList.remove('warning', 'danger');
                if (length > maxLength) {
                    counter.classList.add('danger');
                } else if (length > maxLength * 0.9) {
                    counter.classList.add('warning');
                }
            });
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        updateCharCounter('add_meta_title', 'add_meta_title_count', 60);
        updateCharCounter('add_meta_description', 'add_meta_desc_count', 160);
        updateCharCounter('edit_meta_title', 'edit_meta_title_count', 60);
        updateCharCounter('edit_meta_description', 'edit_meta_desc_count', 160);
        
        const addNameInput = document.getElementById('add_name');
        const addSlugInput = document.getElementById('add_slug');
        
        if (addNameInput && addSlugInput) {
            addNameInput.addEventListener('input', function() {
                if (!addSlugInput.value || addSlugInput.value === '') {
                    const slug = this.value.toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    addSlugInput.value = slug;
                }
            });
        }
    });
    
    function openAddModal() {
        document.getElementById('addModal').classList.add('active');
    }
    
    function closeAddModal() {
        document.getElementById('addModal').classList.remove('active');
    }
    
    function openEditModal(crosschairId) {
        fetch(`/admin/CrossChair/${crosschairId}/edit`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_category_id').value = data.category_id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_slug').value = data.slug;
            document.getElementById('edit_crosshair_code').value = data.crosshair_code;
            document.getElementById('edit_description').value = data.description || '';
            document.getElementById('edit_meta_title').value = data.meta_title || '';
            document.getElementById('edit_meta_description').value = data.meta_description || '';
            document.getElementById('edit_meta_keywords').value = data.meta_keywords || '';
            document.getElementById('edit_order').value = data.order;
            document.getElementById('is_active_edit').checked = data.is_active;
            
            const metaTitleLength = (data.meta_title || '').length;
            const metaDescLength = (data.meta_description || '').length;
            document.getElementById('edit_meta_title_count').textContent = `${metaTitleLength}/60`;
            document.getElementById('edit_meta_desc_count').textContent = `${metaDescLength}/160`;
            
            const imagePreview = document.getElementById('current_image_preview');
            if (data.image) {
                imagePreview.innerHTML = `<img src="/storage/${data.image}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">`;
            } else {
                imagePreview.innerHTML = '';
            }
            
            document.getElementById('editForm').action = `/admin/CrossChair/${crosschairId}`;
            document.getElementById('editModal').classList.add('active');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load crosschair data');
        });
    }
    
    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }
    
    function viewCrosschair(crosschairId) {
        fetch(`/admin/CrossChair/${crosschairId}/edit`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const content = `
                <div class="detail-row">
                    <div class="detail-label">ID:</div>
                    <div class="detail-value">${data.id}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
                    <div class="detail-value"><strong>${data.name}</strong></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Slug:</div>
                    <div class="detail-value"><code style="color: var(--primary-coral);">${data.slug}</code></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Category:</div>
                    <div class="detail-value">${data.category ? data.category.name : 'N/A'}</div>
                </div>
                ${data.image ? `
                <div class="detail-row">
                    <div class="detail-label">Image:</div>
                    <div class="detail-value">
                        <img src="/storage/${data.image}" style="max-width: 100%; height: auto; border-radius: 8px; margin-top: 0.5rem;">
                    </div>
                </div>
                ` : ''}
                <div class="detail-row">
                    <div class="detail-label">Crosshair Code:</div>
                    <div class="detail-value">
                        <div class="code-box">${data.crosshair_code}</div>
                        <button onclick="copyCrosshairCode('${data.crosshair_code}')" class="btn btn-sm btn-primary" style="margin-top: 0.5rem;">
                            <i class="fas fa-copy"></i> Copy Code
                        </button>
                    </div>
                </div>
                ${data.description ? `
                <div class="detail-row">
                    <div class="detail-label">Description:</div>
                    <div class="detail-value">${data.description}</div>
                </div>
                ` : ''}
                <div class="detail-row">
                    <div class="detail-label">Display Order:</div>
                    <div class="detail-value">${data.order}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">
                        <span class="badge ${data.is_active ? 'badge-success' : 'badge-danger'}">
                            ${data.is_active ? 'Active' : 'Inactive'}
                        </span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Views:</div>
                    <div class="detail-value"><i class="fas fa-eye"></i> ${data.views || 0}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Copies:</div>
                    <div class="detail-value"><i class="fas fa-copy"></i> ${data.copies || 0}</div>
                </div>
                <div class="seo-section" style="margin-top: 1.5rem;">
                    <h4 class="seo-section-title">
                        <i class="fas fa-search"></i> SEO Information
                    </h4>
                    <div class="detail-row">
                        <div class="detail-label">Meta Title:</div>
                        <div class="detail-value">${data.meta_title || 'Not set'}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Meta Description:</div>
                        <div class="detail-value">${data.meta_description || 'Not set'}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Meta Keywords:</div>
                        <div class="detail-value">${data.meta_keywords || 'Not set'}</div>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Created:</div>
                    <div class="detail-value">${new Date(data.created_at).toLocaleString()}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Updated:</div>
                    <div class="detail-value">${new Date(data.updated_at).toLocaleString()}</div>
                </div>
            `;
            
            document.getElementById('viewModalContent').innerHTML = content;
            document.getElementById('viewModal').classList.add('active');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load crosschair details');
        });
    }
    
    function closeViewModal() {
        document.getElementById('viewModal').classList.remove('active');
    }
    
    function copyCrosshairCode(code) {
        navigator.clipboard.writeText(code).then(() => {
            alert('Crosshair code copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy:', err);
            alert('Failed to copy code');
        });
    }
    
    function toggleStatus(crosschairId) {
        if (!confirm('Are you sure you want to toggle this crosschair status?')) {
            return;
        }
        
        fetch(`/admin/CrossChair/${crosschairId}/toggle-status`, {
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
    
    document.getElementById('viewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeViewModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
            closeViewModal();
        }
    });
</script>
@endpush
@endsection