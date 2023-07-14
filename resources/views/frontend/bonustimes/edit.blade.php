@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.bonustime.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bonustimes.update", [$bonustime->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="bonusadi">{{ trans('cruds.bonustime.fields.bonusadi') }}</label>
                            <input class="form-control" type="text" name="bonusadi" id="bonusadi" value="{{ old('bonusadi', $bonustime->bonusadi) }}">
                            @if($errors->has('bonusadi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bonusadi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bonustime.fields.bonusadi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bonustarihi">{{ trans('cruds.bonustime.fields.bonustarihi') }}</label>
                            <input class="form-control date" type="text" name="bonustarihi" id="bonustarihi" value="{{ old('bonustarihi', $bonustime->bonustarihi) }}">
                            @if($errors->has('bonustarihi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bonustarihi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bonustime.fields.bonustarihi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection