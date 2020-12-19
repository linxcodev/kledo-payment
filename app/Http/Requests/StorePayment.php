<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayment extends FormRequest
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
        return [
            'payment_name'      => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
          'payment_name.required' => 'Nama payment wajib diisi.',
          'payment_name.min' => 'Nama minimal diisi dengan 5 karakter.',
        ];
    }
}
