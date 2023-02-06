<?php

namespace App\Http\Requests;

use App\Models\KategoriProduk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKategoriProdukRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('kategori_produk_edit'),
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
                'unique:kategori_produks,kategori,' . request()->route('kategoriProduk')->id,
            ],
        ];
    }
}
