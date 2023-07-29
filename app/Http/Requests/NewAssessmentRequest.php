<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewAssessmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (auth()->user()->role == 2);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:150', 'unique:App\Models\Assessment,title'],
            'structure' => ['required'],
            'duration' => ['required', 'numeric'],
            'type' => ['required', 'numeric', 'max_digits:1']
        ];
    }
}
