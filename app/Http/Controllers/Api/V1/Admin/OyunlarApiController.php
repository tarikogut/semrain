<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOyunlarRequest;
use App\Http\Requests\UpdateOyunlarRequest;
use App\Http\Resources\Admin\OyunlarResource;
use App\Models\Oyunlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OyunlarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('oyunlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OyunlarResource(Oyunlar::all());
    }

    public function store(StoreOyunlarRequest $request)
    {
        $oyunlar = Oyunlar::create($request->all());

        return (new OyunlarResource($oyunlar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Oyunlar $oyunlar)
    {
        abort_if(Gate::denies('oyunlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OyunlarResource($oyunlar);
    }

    public function update(UpdateOyunlarRequest $request, Oyunlar $oyunlar)
    {
        $oyunlar->update($request->all());

        return (new OyunlarResource($oyunlar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Oyunlar $oyunlar)
    {
        abort_if(Gate::denies('oyunlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $oyunlar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
