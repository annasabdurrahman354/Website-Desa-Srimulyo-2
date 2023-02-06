<?php

namespace App\Http\Requests;

use App\Models\Pelayanan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePelayananRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('pelayanan_edit'),
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
            'pemohon_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'jenis_layanan_id' => [
                'integer',
                'exists:jenis_layanans,id',
                'required',
            ],
            'kode' => [
                'string',
                'required',
                'unique:pelayanans,kode,' . request()->route('pelayanan')->id,
            ],
            'catatan_pemohon' => [
                'string',
                'nullable',
            ],
            'catatan_reviewer' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
                'in:' . implode(',', array_keys(Pelayanan::STATUS_SELECT)),
            ],
        ];
    }
}
