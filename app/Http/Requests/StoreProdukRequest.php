<?php

namespace App\Http\Requests;

use App\Models\Produk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProdukRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('produk_create'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'umkm_id' => [
                'integer',
                'exists:umkms,id',
                'required',
            ],
            'nama' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:produks,slug',
            ],
            'deskripsi' => [
                'string',
                'required',
            ],
            'harga' => [
                'numeric',
                'required',
            ],
            'satuan_id' => [
                'integer',
                'exists:satuan_produks,id',
                'required',
            ],
            'kategori_id' => [
                'integer',
                'exists:kategori_produks,id',
                'required',
            ],
            'is_tersedia' => [
                'boolean',
            ],
            'is_tampilkan' => [
                'boolean',
            ],
        ];
    }
}
