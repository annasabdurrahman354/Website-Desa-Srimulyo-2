<?php

namespace App\Http\Requests;

use App\Models\Carousel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCarouselRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('carousel_edit'),
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
                'required',
            ],
            'link_tujuan' => [
                'string',
                'nullable',
            ],
            'is_aktif' => [
                'boolean',
            ],
        ];
    }
}
