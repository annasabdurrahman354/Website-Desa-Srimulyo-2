<?php

namespace App\Http\Requests;

use App\Models\DataPenduduk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataPendudukRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('data_penduduk_create'),
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
                'unique:data_penduduks,judul',
            ],
            'slug' => [
                'string',
                'required',
                'unique:data_penduduks,slug',
            ],
            'tahun_pembaruan' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'deskripsi' => [
                'string',
                'required',
            ],
            'is_grafik' => [
                'boolean',
            ],
            'is_tabel' => [
                'boolean',
            ],
            'is_aktif' => [
                'boolean',
            ],
        ];
    }
}
