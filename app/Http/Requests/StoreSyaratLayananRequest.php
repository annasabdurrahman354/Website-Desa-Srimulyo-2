<?php

namespace App\Http\Requests;

use App\Models\SyaratLayanan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSyaratLayananRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('syarat_layanan_create'),
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
            'nama' => [
                'string',
                'required',
                'unique:syarat_layanans,nama',
            ],
            'jenis_berkas' => [
                'required',
                'in:' . implode(',', array_keys(SyaratLayanan::JENIS_BERKAS_SELECT)),
            ],
            'deskripsi' => [
                'string',
                'nullable',
            ],
        ];
    }
}
