<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourResquest extends FormRequest
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
        $tourId = $this->route('tour') ? $this->route('tour')->id : null;
        return [
            'tour_code' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Z0-9-]+$/',
                Rule::unique('tours', 'tour_code')->ignore($tourId),
            ],
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tours', 'slug')->ignore($tourId),
            ],
            'is_active' => 'required|boolean',
        ];
    }
}
