<?php

namespace App\Http\Requests;

use App\Models\ProdukHukum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProdukHukumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('produk_hukum_edit'),
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
            'judul' => [
                'string',
                'required',
                'unique:produk_hukums,judul,' . request()->route('produkHukum')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:produk_hukums,slug,' . request()->route('produkHukum')->id,
            ],
            'jenis' => [
                'required',
                'in:' . implode(',', array_keys(ProdukHukum::JENIS_SELECT)),
            ],
            'tahun' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'is_aktif' => [
                'boolean',
            ],
        ];
    }
}
