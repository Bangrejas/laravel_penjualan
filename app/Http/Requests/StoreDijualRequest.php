<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDijualRequest extends FormRequest
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
            'kode_barang' => 'required|exists:barang,kode_barang',
            'harga' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0',
            'brutto' => 'nullable|numeric|min:0',
            'jumlah' => 'nullable|numeric|min:0',
        ];
    }
}
