@extends('admin.layout')

@section('title', 'Blog Categories')

@section('content')
<style>
    .alert { padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem; }
    .alert-success { background: rgba(0, 210, 91, 0.15); border: 1px solid var(--success); color: var(--success); }
    .content-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: 12px; padding: 1.5rem; }
    .content-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-border); }
    .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: none; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; text-decoration: none; }
    .btn-primary { background: var(--primary-gradient); color: white; }
    .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.8rem; }
    .btn-warning { background: var(--warning); color: white; }
    .btn-danger { background: var(--danger); color: white; }
    .table { width: 100%; border-collapse: collapse; }
    .table thead { background: rgba(255, 45, 95, 0.1); }
    .table th, .table td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--dark-border); }
    .badge { padding: 0.3rem 0.8rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }
    .badge-success { background: rgba(0, 210, 91, 0.15); color: var(--success); }
    .badge-danger { background: rgba(255, 71, 87, 0.15); color: var(--danger); }
</style>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

<div class="content-card">
    <div class="content-card-header">
        <h2>Blog Categories</h2>
        <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <span class="badge {{ $category->status ? 'badge-success' : 'badge-danger' }}">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.blog-categories.edit', $category) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
