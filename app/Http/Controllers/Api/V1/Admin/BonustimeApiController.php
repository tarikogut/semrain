<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonustimeRequest;
use App\Http\Requests\UpdateBonustimeRequest;
use App\Http\Resources\Admin\BonustimeResource;
use App\Models\Bonustime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonustimeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonustime_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonustimeResource(Bonustime::all());
    }

    public function store(StoreBonustimeRequest $request)
    {
        $bonustime = Bonustime::create($request->all());

        return (new BonustimeResource($bonustime))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bonustime $bonustime)
    {
        abort_if(Gate::denies('bonustime_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonustimeResource($bonustime);
    }

    public function update(UpdateBonustimeRequest $request, Bonustime $bonustime)
    {
        $bonustime->update($request->all());

        return (new BonustimeResource($bonustime))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bonustime $bonustime)
    {
        abort_if(Gate::denies('bonustime_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonustime->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
