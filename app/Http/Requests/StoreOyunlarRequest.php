<?php

namespace App\Http\Requests;

use App\Models\Oyunlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOyunlarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('oyunlar_create');
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
