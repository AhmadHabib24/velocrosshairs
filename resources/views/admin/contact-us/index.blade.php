@extends('admin.layout')

@section('title', 'Admin Contact Messages')

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
    
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-pink);
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
    
    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
    
    .btn-success {
        background: var(--success);
        color: white;
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
    
    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-pending {
        background: rgba(255, 193, 7, 0.15);
        color: var(--warning);
    }
    
    .status-read {
        background: rgba(33, 150, 243, 0.15);
        color: #3498db;
    }
    
    .status-replied {
        background: rgba(0, 210, 91, 0.15);
        color: var(--success);
    }
    
    .status-archived {
        background: rgba(158, 158, 158, 0.15);
        color: #9e9e9e;
    }
    
    /* Message Preview */
    .message-preview {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
        max-width: 700px;
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
    
    .detail-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .detail-label {
        font-weight: 600;
        color: var(--text-primary);
        min-width: 150px;
    }
    
    .detail-value {
        color: var(--text-secondary);
        flex: 1;
    }
</style>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Contacts</div>
        <div class="stat-value">{{ $contactStats['total_contacts'] }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Pending</div>
        <div class="stat-value" style="color: var(--warning);">{{ $contactStats['pending_contacts'] }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Read</div>
        <div class="stat-value" style="color: #3498db;">{{ $contactStats['read_contacts'] }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Replied</div>
        <div class="stat-value" style="color: var(--success);">{{ $contactStats['replied_contacts'] }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-label">Archived</div>
        <div class="stat-value" style="color: #9e9e9e;">{{ $contactStats['archived_contacts'] }}</div>
    </div>
</div>

<!-- Contacts Table -->
<div class="content-card">
    <div class="content-card-header">
        <h2 class="content-card-title">Contact Messages</h2>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Crosshair Code</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->formatted_subject }}</td>
                        <td>
                            <div class="message-preview" title="{{ $contact->message }}">
                                {{ Str::limit($contact->message, 50) }}
                            </div>
                        </td>
                        <td>
                            @if($contact->crosshair_code)
                                <code style="background: var(--dark-bg); padding: 0.25rem 0.5rem; border-radius: 4px;">
                                    {{ $contact->crosshair_code }}
                                </code>
                            @else
                                <span style="color: var(--text-muted);">N/A</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-{{ $contact->status }}">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </td>
                        <td>{{ $contact->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <button class="btn btn-sm btn-info" 
                                        onclick="viewContact({{ $contact->id }})"
                                        title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                @if($contact->status === 'pending')
                                    <form action="{{ route('admin.contacts.markAsRead', $contact->id) }}" 
                                          method="POST" 
                                          style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Mark as Read">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif
                                
                                @if($contact->status === 'read')
                                    <form action="{{ route('admin.contacts.markAsReplied', $contact->id) }}" 
                                          method="POST" 
                                          style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Mark as Replied">
                                            <i class="fas fa-reply"></i>
                                        </button>
                                    </form>
                                @endif
                                
                                <form action="{{ route('admin.contacts.archive', $contact->id) }}" 
                                      method="POST" 
                                      style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" title="Archive">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.contacts.delete', $contact->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this contact?');"
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
                        <td colspan="9" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                            No contact messages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 1.5rem;">
        {{ $contacts->links() }}
    </div>
</div>

<!-- View Contact Modal -->
<div class="modal" id="viewModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Contact Details</h3>
            <button class="modal-close" onclick="closeViewModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="contactDetails">
            <!-- Contact details will be loaded here -->
        </div>
    </div>
</div>

@push('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    function viewContact(contactId) {
        fetch(`/admin/contacts/${contactId}`, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const detailsHtml = `
                <div class="detail-row">
                    <div class="detail-label">ID:</div>
                    <div class="detail-value">${data.id}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
                    <div class="detail-value">${data.name}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value">${data.email}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Subject:</div>
                    <div class="detail-value">${data.formatted_subject}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Crosshair Code:</div>
                    <div class="detail-value">${data.crosshair_code || 'N/A'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">
                        <span class="status-badge status-${data.status}">${data.status}</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">IP Address:</div>
                    <div class="detail-value">${data.ip_address || 'N/A'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">User Agent:</div>
                    <div class="detail-value" style="word-break: break-all;">${data.user_agent || 'N/A'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Submitted:</div>
                    <div class="detail-value">${new Date(data.created_at).toLocaleString()}</div>
                </div>
                <div class="detail-row" style="border-bottom: none;">
                    <div class="detail-label">Message:</div>
                </div>
                <div style="padding: 1rem; background: var(--dark-bg); border-radius: 8px; margin-top: 0.5rem;">
                    ${data.message}
                </div>
            `;
            
            document.getElementById('contactDetails').innerHTML = detailsHtml;
            document.getElementById('viewModal').classList.add('active');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load contact details');
        });
    }
    
    function closeViewModal() {
        document.getElementById('viewModal').classList.remove('active');
    }
    
    // Close modal when clicking outside
    document.getElementById('viewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeViewModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewModal();
        }
    });
</script>
@endpush
@endsection