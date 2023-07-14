<?php

namespace App\Http\Requests;

use App\Models\Bonustime;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBonustimeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bonustime_create');
    }

    public function rules()
    {
        return [
            'bonusadi' => [
                'string',
                'nullable',
            ],
            'bonustarihi' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
