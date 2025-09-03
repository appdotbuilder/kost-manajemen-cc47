<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKostRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'rules' => 'nullable|string',
            'facilities' => 'nullable',
            'gender_type' => 'required|in:putra,putri,campur',
            'kost_type' => 'required|in:reguler,eksklusif',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama kost wajib diisi.',
            'address.required' => 'Alamat kost wajib diisi.',
            'city.required' => 'Kota wajib diisi.',
            'province.required' => 'Provinsi wajib diisi.',
            'postal_code.required' => 'Kode pos wajib diisi.',
            'gender_type.required' => 'Jenis kelamin wajib dipilih.',
            'gender_type.in' => 'Jenis kelamin harus putra, putri, atau campur.',
            'kost_type.required' => 'Tipe kost wajib dipilih.',
            'kost_type.in' => 'Tipe kost harus reguler atau eksklusif.',
        ];
    }
}