@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bonustime.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bonustimes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bonustime.fields.id') }}
                        </th>
                        <td>
                            {{ $bonustime->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonustime.fields.bonusadi') }}
                        </th>
                        <td>
                            {{ $bonustime->bonusadi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bonustime.fields.bonustarihi') }}
                        </th>
                        <td>
                            {{ $bonustime->bonustarihi }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bonustimes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#bonusadi_bonuseklemes" role="tab" data-toggle="tab">
                {{ trans('cruds.bonusekleme.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bonusadi_bonuseklemes">
            @includeIf('admin.bonustimes.relationships.bonusadiBonuseklemes', ['bonuseklemes' => $bonustime->bonusadiBonuseklemes])
        </div>
    </div>
</div>

@endsection