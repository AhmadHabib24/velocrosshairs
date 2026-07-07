@extends('admin.layout')

@section('title', 'Add Blog')

@section('content')
<style>
    .content-card { background: var(--dark-card); border: 1px solid var(--dark-border); border-radius: 12px; padding: 1.5rem; max-width: 1000px; margin: 0 auto; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; }
    .form-control { width: 100%; padding: 0.75rem; background: var(--dark-bg); border: 1px solid var(--dark-border); border-radius: 8px; color: var(--text-primary); }
    .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; }
    .btn-primary { background: var(--primary-gradient); color: white; }
    .btn-secondary { background: var(--dark-bg); color: var(--text-secondary); border: 1px solid var(--dark-border); }
    .tox-tinymce { border: 1px solid var(--dark-border) !important; border-radius: 8px !important; }

    /* Select2 Dark Theme Customization */
    .select2-container--default .select2-selection--multiple {
        background-color: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 8px;
        min-height: 45px;
        padding: 4px;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: var(--primary-pink);
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: rgba(255, 45, 95, 0.1);
        border: 1px solid var(--primary-pink);
        color: var(--primary-pink);
        border-radius: 4px;
        padding: 4px 8px;
        margin-top: 5px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: var(--primary-pink);
        margin-right: 5px;
        border-right: none;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background: transparent;
        color: var(--danger);
    }
    .select2-dropdown {
        background-color: var(--dark-card) !important;
        border: 1px solid var(--dark-border) !important;
    }
    .select2-container--default .select2-results__option {
        color: var(--text-primary) !important;
    }
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: rgba(255, 45, 95, 0.2) !important;
        color: var(--primary-pink) !important;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: var(--primary-pink) !important;
        color: white !important;
    }
    .select2-container .select2-search--inline .select2-search__field {
        color: var(--text-primary) !important;
        margin-top: 8px;
    }
</style>

<div class="content-card">
    <h2 style="margin-bottom: 1.5rem;">Add Blog</h2>
    
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Slug (Optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Auto-generated if left blank">
        </div>

        <div style="display: flex; gap: 1rem;">
            <div class="form-group" style="flex: 1;">
                <label class="form-label">Category *</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="flex: 1;">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Tags</label>
            <select name="tags[]" class="form-control select2-tags" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Cover Image *</label>
            <input type="file" name="image" class="form-control" required accept="image/*">
        </div>

        <div class="form-group">
            <label class="form-label">Content *</label>
            <textarea name="content" id="blogContent" class="form-control">{{ old('content') }}</textarea>
        </div>

        <h3 style="margin: 2rem 0 1rem; padding-top: 1rem; border-top: 1px solid var(--dark-border);">SEO Fields</h3>

        <div class="form-group">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
        </div>

        <div class="form-group">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Meta Keywords</label>
            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="comma, separated, keywords">
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Blog</button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-tags').select2({
            placeholder: "Select tags",
            allowClear: true
        });
    });
</script>
<script src="https://cdn.tiny.cloud/1/ztumrn6qh6dox1xnai9cezm4ltqnm9wr6c533m2akebnn3op/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    tinymce.init({
        selector: '#blogContent',
        height: 500,
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'tinymceai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        tinymceai_token_provider: async () => {
            await fetch(`https://demo.api.tiny.cloud/1/ztumrn6qh6dox1xnai9cezm4ltqnm9wr6c533m2akebnn3op/auth/random`, { method: "POST", credentials: "include" });
            return { token: await fetch(`https://demo.api.tiny.cloud/1/ztumrn6qh6dox1xnai9cezm4ltqnm9wr6c533m2akebnn3op/jwt/tinymceai`, { credentials: "include" }).then(r => r.text()) };
        },
        uploadcare_public_key: '153553e64f8e7a8c5619',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>
@endpush
@endsection
