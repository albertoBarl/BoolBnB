<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            'title' => ['required', 'unique:apartments'],
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
            'title.required' => 'Il titolo è richiesto.',
            'title.unique' => 'Esiste già un appartamento con questo titolo.',
            'description.required' => 'la descrizione è richiesta.',
            'square_feet.required' => 'la metratura è richiesta.',
            'bathroom.required' => 'Il numero di bagni è richiesto.',
            'room.required' => 'Il numero di stanze è richiesto.',
            'address.required' => 'Indirizzo richiesto.',
            'image.required' => 'Almeno un immagine è richiesta.',
            'latitude.required' => 'La latitudine è richiesta.',
            'longitude.required' => 'La longitudine è richiesta.',
            'price.required' => 'Il prezzo è richiesto.',
            'image.image' => 'Inserire un formato di immagine valido.',
        ];
    }
}
