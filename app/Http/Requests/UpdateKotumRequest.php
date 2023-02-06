<?php

namespace App\Http\Requests;

use App\Models\Kota;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKotaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('kota_edit'),
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
            'provinsi_id' => [
                'integer',
                'exists:provinsis,id',
                'required',
            ],
            'nama' => [
                'string',
                'required',
            ],
        ];
    }
}
