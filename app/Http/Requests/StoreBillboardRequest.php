<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillboardRequest extends FormRequest
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
            'judul_id' => 'required|unique:billboards,judul_id',
            'judul_en' => 'required|unique:billboards,judul_en',
            'content_id' => 'required',
            'content_en' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];
    }

    public function messages(): array
    {
        return [
            'judul_id.required' => 'Judul (ID) tidak boleh kosong',
            'judul_en.required' => 'Judul (EN) tidak boleh kosong',
            'judul_id.unique' => 'Judul (ID) sudah ada',
            'judul_en.unique' => 'Judul (EN) sudah ada',
            'content_id.required' => 'Content (ID) tidak boleh kosong',
            'content_en.required' => 'Content (EN) tidak boleh kosong',
        ];
    }
}
