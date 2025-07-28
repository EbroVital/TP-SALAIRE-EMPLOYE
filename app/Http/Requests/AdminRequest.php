<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom'=> 'required',
            'email'=> 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de l\'administrateur est requis',
            'email.required' => 'Le mail est requis',
            'email.email' => 'Le mail n\'est pas valide',
            'email.unique' => 'Cette adresse mail est déjà lié à un compte',
            'password.required' => 'Le mot de passe est requis'
        ];
    }
}
