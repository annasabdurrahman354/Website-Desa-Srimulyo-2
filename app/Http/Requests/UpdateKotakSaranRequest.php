<?php

namespace App\Http\Requests;

use App\Models\KotakSaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKotakSaranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('kotak_saran_edit'),
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
            'pengirim' => [
                'string',
                'nullable',
            ],
            'nomor_telepon' => [
                'string',
                'nullable',
            ],
            'isi' => [
                'string',
                'required',
            ],
        ];
    }
}
