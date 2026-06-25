<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $categoryId = $this->route('category') ? $this->route('category')->id : null;
        
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug,' . $categoryId,
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0'
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required',
            'name.max' => 'Category name cannot exceed 255 characters',
            'slug.unique' => 'This slug is already taken',
            'meta_title.max' => 'Meta title should not exceed 255 characters',
            'meta_description.max' => 'Meta description should not exceed 500 characters',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'Image must be: jpeg, png, jpg, gif, or webp',
            'image.max' => 'Image size cannot exceed 2MB',
            'order.min' => 'Order must be a positive number'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert is_active checkbox to boolean
        if ($this->has('is_active')) {
            $this->merge([
                'is_active' => true
            ]);
        } else {
            $this->merge([
                'is_active' => false
            ]);
        }
    }
}