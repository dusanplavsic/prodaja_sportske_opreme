<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KupciStoreRequest extends FormRequest
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
            'ime' => ['required', 'string', 'max:50'],
            'prezime' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'telefon' => ['required', 'string', 'max:50'],
        ];
    }
}
