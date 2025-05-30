<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenjualanRequest extends FormRequest
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
            'no_faktur' => 'required|unique:penjualans,no_faktur',
            'tgl_faktur' => 'required|date',
            'kode_customer' => 'required|exists:customers,kode_customer',
            'kode_jenis' => 'required|exists:jenis_transaksis,kode_jenis',

            // Validasi nested array
            'kode_barang' => 'required|array|min:1',
            'kode_barang.*' => 'required|exists:barangs,kode_barang',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:1',
            'quantity' => 'required|array',
            'quantity.*' => 'required|numeric|min:1',
            'diskon' => 'array',
            'diskon.*' => 'nullable|numeric|min:0',
        ];
    }
}
