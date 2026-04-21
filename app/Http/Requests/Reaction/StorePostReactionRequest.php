<?php

namespace App\Http\Requests\Reaction;

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
            'emoji' => ['required', new Enum(ReactionEmoji::class)]
        ];
    }
    
    public function messages(): array
    {
        return [
            'emoji.required' => 'Emoji is required.',
            'emoji.enum' => 'Invalid emoji selected.',
        ];
    }
}
