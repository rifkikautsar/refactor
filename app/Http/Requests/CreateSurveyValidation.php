<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateSurveyValidation extends FormRequest
{
    public $rules =
    [
        'user_id' => 'required|integer',
        'porsi_minum' => 'required|string',
        'jam_tidur' => 'required|string',
        'olahraga'  => 'required|string|in:Ya,Tidak',
        'sinar_matahari' => 'required|string|in:Ya,Tidak',
        'kondisi1' => 'required|string',
        'kondisi2' => 'required|string',
        'kondisi3' => 'required|string'
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
