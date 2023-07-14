@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bonusekleme.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bonuseklemes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="bonusadis">{{ trans('cruds.bonusekleme.fields.bonusadi') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('bonusadis') ? 'is-invalid' : '' }}" name="bonusadis[]" id="bonusadis" multiple>
                    @foreach($bonusadis as $id => $bonusadi)
                        <option value="{{ $id }}" {{ in_array($id, old('bonusadis', [])) ? 'selected' : '' }}>{{ $bonusadi }}</option>
                    @endforeach
                </select>
                @if($errors->has('bonusadis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bonusadis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusekleme.fields.bonusadi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="oyun_adi">{{ trans('cruds.bonusekleme.fields.oyun_adi') }}</label>
                <input class="form-control {{ $errors->has('oyun_adi') ? 'is-invalid' : '' }}" type="text" name="oyun_adi" id="oyun_adi" value="{{ old('oyun_adi', '') }}">
                @if($errors->has('oyun_adi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('oyun_adi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusekleme.fields.oyun_adi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="yatirim">{{ trans('cruds.bonusekleme.fields.yatirim') }}</label>
                <input class="form-control {{ $errors->has('yatirim') ? 'is-invalid' : '' }}" type="number" name="yatirim" id="yatirim" value="{{ old('yatirim', '0') }}" step="0.01">
                @if($errors->has('yatirim'))
                    <div class="invalid-feedback">
                        {{ $errors->first('yatirim') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bonusekleme.fields.yatirim_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection