@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.bonusekleme.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bonuseklemes.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bonusekleme->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.bonusadi') }}
                                    </th>
                                    <td>
                                        @foreach($bonusekleme->bonusadis as $key => $bonusadi)
                                            <span class="label label-info">{{ $bonusadi->bonusadi }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.oyun_adi') }}
                                    </th>
                                    <td>
                                        {{ $bonusekleme->oyun_adi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.yatirim') }}
                                    </th>
                                    <td>
                                        {{ $bonusekleme->yatirim }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.bonuseklemes.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection