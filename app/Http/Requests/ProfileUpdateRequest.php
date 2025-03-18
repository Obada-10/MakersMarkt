<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Bepaal of de gebruiker de aanvraag mag uitvoeren.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Verkrijg de geldige validatieregels voor de aanvraag.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',  // Valideer afbeelding
        ];
    }
}
