<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegistrationValidation extends FormRequest {

    public $rules =
    [
        'nama' => 'required|string',
        'email' => 'required|email|unique:users',
        'jenisKelamin' => 'required|string|in:L,P',
        'jenisKulit' => 'required|string',
        'keluhan' => 'required|string',
        'tanggalLahir' => 'required|date',
        'pass' => 'required|string'
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return $this->rules;
    }

    public function messages()
    {
        return [
            'nama.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email telah terdaftar. Silakan login.',
            'pass.required' => 'Kolom password wajib diisi.'
        ];
    }
    protected function failedValidation(Validator $validator) {
        $response = response()->json([
            'code' => 200,
            'message' => $validator->errors()->first(),
            'data' => null
        ], 200);

        throw new HttpResponseException($response);
    }
}
