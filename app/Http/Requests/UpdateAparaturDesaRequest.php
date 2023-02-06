<?php

namespace App\Http\Requests;

use App\Models\AparaturDesa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAparaturDesaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('aparatur_desa_edit'),
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
            ],
            'posisi' => [
                'string',
                'required',
            ],
            'is_aktif' => [
                'boolean',
            ],
        ];
    }
}
