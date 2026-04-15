<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ReactionEmoji;

class StorePostReactionRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'emoji' => ['required', new Enum(ReactionEmoji::class)]
        ];
    }
    
    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'The specified user does not exist.',
            'emoji.required' => 'Emoji is required.',
            'emoji.enum' => 'Invalid emoji selected.',
        ];
    }
}
