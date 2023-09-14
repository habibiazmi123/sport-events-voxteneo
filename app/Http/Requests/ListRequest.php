<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "page" => "integer",
            "perPage" => "integer"
        ];
    }

    public function validationData(): array
    {
        $data = $this->all();

        $data['page'] = $data['page'] ?? 1;
        $data['perPage'] = $data['perPage'] ?? 10;

        return $data;
    }
}
