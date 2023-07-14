@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.oyunlar.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.oyunlars.update", [$oyunlar->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="oyun_adi">{{ trans('cruds.oyunlar.fields.oyun_adi') }}</label>
                            <input class="form-control" type="text" name="oyun_adi" id="oyun_adi" value="{{ old('oyun_adi', $oyunlar->oyun_adi) }}">
                            @if($errors->has('oyun_adi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('oyun_adi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.oyunlar.fields.oyun_adi_helper') }}</span>
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