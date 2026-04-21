<?php

namespace App\Http\Requests\Comment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment_content' => 'required|string|min:5',
            'post_id'=>'required|integer|exists:posts,id'
        ];
    }
    public function messages(): array
    {
        return [
            'comment_content.required' => 'The comment content field is required.',
            'comment_content.string' => 'The comment content must be a string.',
            'comment_content.min' => 'The comment content must be at least 5 characters.',
            'post_id.required' => 'The post ID field is required.',
            'post_id.integer' => 'The post ID must be an integer.',
            'post_id.exists' => 'The specified post ID does not exist.'
        ];
    }
}
