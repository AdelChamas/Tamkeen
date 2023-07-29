<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewLessonRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:100'],
            'video' => ['required', 'file', 'mimes:mp4,avi,mov,wmw'],
            'poster' => ['nullable', 'file'],
            'attachment' => ['nullable'],
            'quiz' => ['nullable', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('requests.required'),
            'title.string' => __('requests.title_string'),
            'title.max' => __('requests.title_max'),
            'description.required' => __('requests.required'),
            'description.string' => __('requests.description_string'),
            'description.max' => __('requests.description_max'),
        ];
    }
}
