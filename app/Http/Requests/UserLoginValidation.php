<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginValidation extends FormRequest {

    public $rules =
    [
        'email' => 'required|email',
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

    protected function failedValidation(Validator $validator) {
        $response = response()->json([
            'code' => 200,
            'message' => $validator->errors()->first(),
            'data' => null
        ], 200);

        throw new HttpResponseException($response);
    }
}
