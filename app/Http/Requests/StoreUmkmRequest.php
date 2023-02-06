<?php

namespace App\Http\Requests;

use App\Models\Umkm;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUmkmRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('umkm_create'),
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
            'pemilik_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'nama_umkm' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:umkms,slug',
            ],
            'deskripsi' => [
                'string',
                'required',
            ],
            'nomor_telepon' => [
                'string',
                'required',
            ],
            'alamat' => [
                'string',
                'required',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'umkm.waktu_keterlihatan' => [
                'nullable',
                'date_format:' . config('project.datetime_format'),
            ],
            'kategori_id' => [
                'integer',
                'exists:kategori_umkms,id',
                'required',
            ],
            'is_aktif' => [
                'boolean',
            ],
            'is_terverifikasi' => [
                'boolean',
            ],
        ];
    }
}
