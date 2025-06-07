<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkdayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'day' => 'required|date|unique:workdays,day' . ($this->workday? ",{$this->workday->id}" : ''),
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}
