<?php

namespace App\Http\Requests;

use App\Models\Artikel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateArtikelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('artikel_edit'),
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
            'judul' => [
                'string',
                'min:40',
                'max:70',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:artikels,slug,' . request()->route('artikel')->id,
            ],
            'penulis_id' => [
                'integer',
                'exists:users,id',
                'required',
            ],
            'rangkuman' => [
                'string',
                'min:50',
                'max:160',
                'required',
            ],
            'konten' => [
                'string',
                'required',
            ],
            'jumlah_pembaca' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'kategori_id' => [
                'integer',
                'exists:kategori_artikels,id',
                'required',
            ],
            'is_diterbitkan' => [
                'boolean',
            ],
        ];
    }
}
