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
            'bed' => ['required'],
            'address' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            // 'latitude' => ['required'],
            // 'longitude' => ['required'],
            // commentati così da permettere allo store di registrare le coordinate dall'input indirizzo

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
            'bed.required' => 'il numero di posti letto è richiesto',
            'address.required' => 'Indirizzo richiesto',
            'image.required' => 'Almeno un immagine è richiesta.',
            'latitude.required' => 'La latitudine è richiesta.',
            'longitude.required' => 'La longitudine è richiesta.',
            'image.image' => 'Inserire un formato di immagine valido.',
        ];
    }
}
