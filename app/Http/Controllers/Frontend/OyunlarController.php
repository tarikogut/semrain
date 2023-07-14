<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOyunlarRequest;
use App\Http\Requests\StoreOyunlarRequest;
use App\Http\Requests\UpdateOyunlarRequest;
use App\Models\Oyunlar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OyunlarController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('oyunlar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $oyunlars = Oyunlar::all();

        return view('frontend.oyunlars.index', compact('oyunlars'));
    }

    public function create()
    {
        abort_if(Gate::denies('oyunlar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.oyunlars.create');
    }

    public function store(StoreOyunlarRequest $request)
    {
        $oyunlar = Oyunlar::create($request->all());

        return redirect()->route('frontend.oyunlars.index');
    }

    public function edit(Oyunlar $oyunlar)
    {
        abort_if(Gate::denies('oyunlar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.oyunlars.edit', compact('oyunlar'));
    }

    public function update(UpdateOyunlarRequest $request, Oyunlar $oyunlar)
    {
        $oyunlar->update($request->all());

        return redirect()->route('frontend.oyunlars.index');
    }

    public function show(Oyunlar $oyunlar)
    {
        abort_if(Gate::denies('oyunlar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.oyunlars.show', compact('oyunlar'));
    }

    public function destroy(Oyunlar $oyunlar)
    {
        abort_if(Gate::denies('oyunlar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $oyunlar->delete();

        return back();
    }

    public function massDestroy(MassDestroyOyunlarRequest $request)
    {
        $oyunlars = Oyunlar::find(request('ids'));

        foreach ($oyunlars as $oyunlar) {
            $oyunlar->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
