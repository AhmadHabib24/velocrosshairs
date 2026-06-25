@extends('admin.layout')

@section('title', 'Add Tag')

@section('content')
<style>
    .content-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: 12px; padding: 1.5rem; max-width: 600px; margin: 0 auto; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; }
    .form-control { width: 100%; padding: 0.75rem; background: var(--dark-bg); border: 1px solid var(--dark-border); border-radius: 8px; color: var(--text-primary); }
    .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; }
    .btn-primary { background: var(--primary-gradient); color: white; }
    .btn-secondary { background: var(--dark-bg); color: var(--text-secondary); border: 1px solid var(--dark-border); }
</style>

<div class="content-card">
    <h2 style="margin-bottom: 1.5rem;">Add Tag</h2>
    
    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Tag</button>
        </div>
    </form>
</div>
@endsection
