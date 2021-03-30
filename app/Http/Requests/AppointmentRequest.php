<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $todayDate = Carbon::today()->format('d-m-Y');
//        $now =Carbon::now()->format('H:i');
        return [
             'name' => ['required', 'string', 'max:255'],
             'surname' => ['required', 'string', 'max:255'],
             'date_of_birth' => ['required', 'date','before:today'],
             'phone_number' =>['required'],
             'email' => ['required', 'string', 'email', 'max:255'],
             'date' => ['required', 'date','after:'.$todayDate],
             'time'=>['required', 'string'],
            'user_id' =>['sometimes','required'],
        ];
    }
}
