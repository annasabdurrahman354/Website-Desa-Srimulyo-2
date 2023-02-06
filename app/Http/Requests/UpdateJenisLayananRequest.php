<?php

namespace App\Http\Requests;

use App\Models\JenisLayanan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJenisLayananRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('jenis_layanan_edit'),
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
                'unique:jenis_layanans,nama,' . request()->route('jenisLayanan')->id,
            ],
            'deskripsi' => [
                'string',
                'required',
            ],
            'biaya' => [
                'numeric',
                'required',
            ],
            'pelayanan_online' => [
                'boolean',
            ],
            'syarat_layanan' => [
                'array',
            ],
            'syarat_layanan.*.id' => [
                'integer',
                'exists:syarat_layanans,id',
            ],
        ];
    }
}
