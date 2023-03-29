<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            'title' => ['required', Rule::unique('apartments')->ignore($this->apartment)],
            'description' => ['required'],
            'square_feet' => ['required'],
            'bathroom' => ['required'],
            'room' => ['required'],
            'address' => ['required'],
            'image' => ['nullable', 'image'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'price' => ['required'],

            'services' => ['exists:services,id'],

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo non può essere nullo.',
            'title.unique' => 'Esiste già un appartamento con questo titolo.',
            'description.required' => 'la descrizione non può essere nulla.',
            'square_feet.required' => 'la metratura non può essere nulla.',
            'bathroom.required' => 'Il numero di bagni non può essere nullo.',
            'room.required' => 'Il numero di stanze non può essere nullo.',
            'address.required' => 'L\' Indirizzo non può essere nullo.',
            'image.required' => 'Inserire almeno un\' immagine valida.',
            'latitude.required' => 'La latitudine non può essere nulla.',
            'longitude.required' => 'La longitudine non può essere nulla.',
            'price.required' => 'Il prezzo non può essere nullo.',
            'image.image' => 'Inserire un formato di immagine valido.',
        ];
    }
}
