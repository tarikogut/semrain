<?php

namespace App\Http\Requests;

use App\Models\Bonusekleme;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBonuseklemeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bonusekleme_create');
    }

    public function rules()
    {
        return [
            'bonusadis.*' => [
                'integer',
            ],
            'bonusadis' => [
                'array',
            ],
            'oyun_adi' => [
                'string',
                'nullable',
            ],
        ];
    }
}
