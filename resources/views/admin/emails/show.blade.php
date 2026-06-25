@extends('admin.layout')

@section('title', 'Email Details')
@section('page-title', 'Email Details')

@section('content')
<style>
    .vc-email-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        overflow: hidden;
        margin-top: 1rem;
    }
    .vc-email-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255, 255, 255, 0.02);
    }
    .vc-email-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }
    .vc-btn-back {
        padding: 0.5rem 1rem;
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        color: var(--text-secondary);
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    .vc-btn-back:hover {
        background: var(--primary-pink);
        color: white;
        border-color: var(--primary-pink);
    }
    .vc-email-meta {
        padding: 1.5rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .vc-email-meta-item {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    .vc-email-meta-item strong {
        color: var(--text-primary);
        font-weight: 600;
        min-width: 50px;
        display: inline-block;
    }
    .vc-email-body-container {
        padding: 1.5rem;
    }
    .vc-email-body {
        background: #ffffff;
        color: #000000;
        padding: 2rem;
        border-radius: 8px;
        overflow-x: auto;
    }
</style>

<div class="vc-email-card">
    <div class="vc-email-header">
        <h5 class="vc-email-title">Subject: {{ $email->subject ?? 'No Subject' }}</h5>
        <a href="{{ url()->previous() }}" class="vc-btn-back">
            <i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Back
        </a>
    </div>
    
    <div class="vc-email-meta">
        <div class="vc-email-meta-item">
            <strong>To:</strong> {{ $email->to_email }}
        </div>
        <div class="vc-email-meta-item">
            <strong>Sent:</strong> {{ $email->created_at->format('M d, Y h:i A') }}
        </div>
    </div>
    
    <div class="vc-email-body-container">
        <div class="vc-email-body shadow">
            {!! $email->body !!}
        </div>
    </div>
</div>
@endsection
