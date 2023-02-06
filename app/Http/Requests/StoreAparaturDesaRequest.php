<?php

namespace App\Http\Requests;

use App\Models\AparaturDesa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAparaturDesaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('aparatur_desa_create'),
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
