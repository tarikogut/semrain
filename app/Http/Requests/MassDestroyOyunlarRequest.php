<?php

namespace App\Http\Requests;

use App\Models\Oyunlar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOyunlarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('oyunlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:oyunlars,id',
        ];
    }
}
