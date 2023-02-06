<?php

namespace App\Http\Requests;

use App\Models\BerkasPelayanan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBerkasPelayananRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('berkas_pelayanan_create'),
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
            'pelayanan_id' => [
                'integer',
                'exists:pelayanans,id',
                'required',
            ],
            'syarat_layanan_id' => [
                'integer',
                'exists:syarat_layanans,id',
                'required',
            ],
            'teks_syarat' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
                'in:' . implode(',', array_keys(BerkasPelayanan::STATUS_RADIO)),
            ],
            'catatan_reviewer' => [
                'string',
                'required',
            ],
        ];
    }
}
