<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class NewCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::findOrFail(auth()->id());
        return ($user->role == 2);
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
            'price' => ['required', 'numeric'],
            'overview' => ['string', 'max:300'],
            'subjects' => ['required', 'string', 'max:200'],
            'outcomes' => ['string'],
            'pre' => ['nullable', 'string', 'max:200'],
            'about' => ['string'],
            'image' => ['required', 'image'],
            'category' => ['required', 'numeric']
        ];
    }
}
