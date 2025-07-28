<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeRequest extends FormRequest
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
            'departement_id' => 'required|integer',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|unique:employes,email',
            'contact' => 'required|unique:employes,contact',
            'montant' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'email.required' => "L'adresse email est requis",
            'email.unique' => "L'adresse email est déjà utilisé",
            'phone.required' => 'Le numero de telephone est requis',
            'phone.unique' => 'Le numero de telephone est déjà utilisé'
        ];
    }

}
