<?php

namespace App\Http\Requests;

use App\Models\DokumenUmum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDokumenUmumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('dokumen_umum_create'),
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
                'unique:dokumen_umums,judul',
            ],
            'slug' => [
                'string',
                'required',
                'unique:dokumen_umums,slug',
            ],
            'tahun_terbit' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'deskripsi' => [
                'string',
                'required',
            ],
            'is_aktif' => [
                'boolean',
            ],
        ];
    }
}
