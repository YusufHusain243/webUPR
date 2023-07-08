<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillboardRequest extends FormRequest
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
            'judul_id' => 'required',
            'judul_en' => 'required',
            'content_id' => 'required',
            'content_en' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'judul_id.required' => 'Judul (ID) tidak boleh kosong',
            'judul_en.required' => 'Judul (EN) tidak boleh kosong',
            'content_id.required' => 'Content (ID) tidak boleh kosong',
            'content_en.required' => 'Content (EN) tidak boleh kosong',
        ];
    }
}
