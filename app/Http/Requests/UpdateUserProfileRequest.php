<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'phone_number' => 'required',
            'email' => ['required', 'string', 'email', 'unique:users,email,'. auth()->id()],
            'address' => ['required', 'string', 'max:255'],
        ];
    }
}
