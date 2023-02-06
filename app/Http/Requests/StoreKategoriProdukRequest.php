<?php

namespace App\Http\Requests;

use App\Models\KategoriProduk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKategoriProdukRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('kategori_produk_create'),
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
            'kategori' => [
                'string',
                'required',
                'unique:kategori_produks,kategori',
            ],
        ];
    }
}
