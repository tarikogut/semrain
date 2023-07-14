<?php

namespace App\Http\Requests;

use App\Models\Oyunlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOyunlarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('oyunlar_edit');
    }

    public function rules()
    {
        return [
            'oyun_adi' => [
                'string',
                'nullable',
            ],
        ];
    }
}
