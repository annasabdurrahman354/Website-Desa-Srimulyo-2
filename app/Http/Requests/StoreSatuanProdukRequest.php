<?php

namespace App\Http\Requests;

use App\Models\SatuanProduk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSatuanProdukRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('satuan_produk_create'),
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
            'satuan' => [
                'string',
                'required',
                'unique:satuan_produks,satuan',
            ],
        ];
    }
}
