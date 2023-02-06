<?php

namespace App\Http\Requests;

use App\Models\Kontak;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKontakRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('kontak_edit'),
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
                'unique:kontaks,nama,' . request()->route('kontak')->id,
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
