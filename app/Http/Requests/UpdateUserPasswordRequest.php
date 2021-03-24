<?php

namespace App\Http\Requests;

use App\Rules\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
            'current_password' => ['required', new CurrentPassword],
            'password' => ['required','string'],
            'password_confirmation' => ['required', 'same:password'],
        ];

    }

}
