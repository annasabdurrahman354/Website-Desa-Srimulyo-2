<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('user_create'),
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
            'name' => [
                'string',
                'required',
            ],
            'nik' => [
                'string',
                'min:16',
                'max:16',
                'required',
            ],
            'nomor_telepon' => [
                'string',
                'required',
            ],
            'jenis_kelamin' => [
                'required',
                'in:' . implode(',', array_keys(User::JENIS_KELAMIN_RADIO)),
            ],
            'tempat_lahir_id' => [
                'integer',
                'exists:kota,id',
                'required',
            ],
            'tanggal_lahir' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'alamat' => [
                'string',
                'required',
            ],
            'email' => [
                'email:rfc',
                'required',
                'unique:users,email',
            ],
            'password' => [
                'string',
                'required',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'roles.*.id' => [
                'integer',
                'exists:roles,id',
            ],
            'locale' => [
                'string',
                'nullable',
            ],
        ];
    }
}
