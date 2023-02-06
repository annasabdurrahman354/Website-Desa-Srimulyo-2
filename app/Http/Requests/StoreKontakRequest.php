<?php

namespace App\Http\Requests;

use App\Models\Kontak;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKontakRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('kontak_create'),
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
                'unique:kontaks,nama',
            ],
            'kontak' => [
                'string',
                'required',
            ],
            'jenis_kontak' => [
                'required',
                'in:' . implode(',', array_keys(Kontak::JENIS_KONTAK_SELECT)),
            ],
        ];
    }
}
