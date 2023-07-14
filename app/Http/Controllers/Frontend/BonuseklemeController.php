<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonuseklemeRequest;
use App\Http\Requests\StoreBonuseklemeRequest;
use App\Http\Requests\UpdateBonuseklemeRequest;
use App\Models\Bonusekleme;
use App\Models\Bonustime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonuseklemeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonusekleme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonuseklemes = Bonusekleme::with(['bonusadis'])->get();

        return view('frontend.bonuseklemes.index', compact('bonuseklemes'));
    }

    public function create()
    {
        abort_if(Gate::denies('bonusekleme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusadis = Bonustime::pluck('bonusadi', 'id');

        return view('frontend.bonuseklemes.create', compact('bonusadis'));
    }

    public function store(StoreBonuseklemeRequest $request)
    {
        $bonusekleme = Bonusekleme::create($request->all());
        $bonusekleme->bonusadis()->sync($request->input('bonusadis', []));

        return redirect()->route('frontend.bonuseklemes.index');
    }

    public function edit(Bonusekleme $bonusekleme)
    {
        abort_if(Gate::denies('bonusekleme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusadis = Bonustime::pluck('bonusadi', 'id');

        $bonusekleme->load('bonusadis');

        return view('frontend.bonuseklemes.edit', compact('bonusadis', 'bonusekleme'));
    }

    public function update(UpdateBonuseklemeRequest $request, Bonusekleme $bonusekleme)
    {
        $bonusekleme->update($request->all());
        $bonusekleme->bonusadis()->sync($request->input('bonusadis', []));

        return redirect()->route('frontend.bonuseklemes.index');
    }

    public function show(Bonusekleme $bonusekleme)
    {
        abort_if(Gate::denies('bonusekleme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusekleme->load('bonusadis');

        return view('frontend.bonuseklemes.show', compact('bonusekleme'));
    }

    public function destroy(Bonusekleme $bonusekleme)
    {
        abort_if(Gate::denies('bonusekleme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonusekleme->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonuseklemeRequest $request)
    {
        $bonuseklemes = Bonusekleme::find(request('ids'));

        foreach ($bonuseklemes as $bonusekleme) {
            $bonusekleme->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
