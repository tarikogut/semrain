<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonuseklemeRequest;
use App\Http\Requests\UpdateBonuseklemeRequest;
use App\Http\Resources\Admin\BonuseklemeResource;
use App\Models\Bonusekleme;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonuseklemeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonusekleme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonuseklemeResource(Bonusekleme::with(['bonusadis'])->get());
    }

    public function store(StoreBonuseklemeRequest $request)
    {
        $bonusekleme = Bonusekleme::create($request->all());
        $bonusekleme->bonusadis()->sync($request->input('bonusadis', []));

        return (new BonuseklemeResource($bonusekleme))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bonusekleme $bonusekleme)
    {
        abort_if(Gate::denies('bonusekleme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonuseklemeResource($bonusekleme->load(['bonusadis']));
    }

    public function update(UpdateBonuseklemeRequest $request, Bonusekleme $bonusekleme)
    {
        $bonusekleme->update($request->all());
        $bonusekleme->bonusadis()->sync($request->input('bonusadis', []));

        return (new BonuseklemeResource($bonusekleme))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bonusekleme $bonusekleme)
    {
        abort_if(Gate::denies('bonusekleme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusekleme->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
