<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'surname' => ['required'],
            'email' => ['required'],
            'content' => ['required'],
            'apartment_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è richiesto',
            'surname.required' => 'Il cognome è richiesto',
            'email.required' => 'L\'email è richiesta',
            'content.required' => 'Il contenuto è richiesto',
            'apartment_id.required' => 'L\'id apartment è richiesto',
        ];
    }
}
