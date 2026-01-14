<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PorudzbineStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'kupac_id' => ['required', 'integer', 'exists:Kupci,id'],
            'datum_porudzbine' => ['required', 'date'],
            'status' => ['required', 'string'],
            'ukupan_iznos' => ['required', 'integer'],
        ];
    }
}
