<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBonustimeRequest;
use App\Http\Requests\StoreBonustimeRequest;
use App\Http\Requests\UpdateBonustimeRequest;
use App\Models\Bonustime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BonustimeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonustime_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonustimes = Bonustime::all();

        return view('frontend.bonustimes.index', compact('bonustimes'));
    }

    public function create()
    {
        abort_if(Gate::denies('bonustime_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bonustimes.create');
    }

    public function store(StoreBonustimeRequest $request)
    {
        $bonustime = Bonustime::create($request->all());

        return redirect()->route('frontend.bonustimes.index');
    }

    public function edit(Bonustime $bonustime)
    {
        abort_if(Gate::denies('bonustime_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bonustimes.edit', compact('bonustime'));
    }

    public function update(UpdateBonustimeRequest $request, Bonustime $bonustime)
    {
        $bonustime->update($request->all());

        return redirect()->route('frontend.bonustimes.index');
    }

    public function show(Bonustime $bonustime)
    {
        abort_if(Gate::denies('bonustime_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonustime->load('bonusadiBonuseklemes');

        return view('frontend.bonustimes.show', compact('bonustime'));
    }

    public function destroy(Bonustime $bonustime)
    {
        abort_if(Gate::denies('bonustime_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonustime->delete();

        return back();
    }

    public function massDestroy(MassDestroyBonustimeRequest $request)
    {
        $bonustimes = Bonustime::find(request('ids'));

        foreach ($bonustimes as $bonustime) {
            $bonustime->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
