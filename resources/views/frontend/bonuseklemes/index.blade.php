@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bonusekleme_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.bonuseklemes.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bonusekleme.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bonusekleme.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Bonusekleme">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.bonusadi') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.oyun_adi') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bonusekleme.fields.yatirim') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bonuseklemes as $key => $bonusekleme)
                                    <tr data-entry-id="{{ $bonusekleme->id }}">
                                        <td>
                                            {{ $bonusekleme->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($bonusekleme->bonusadis as $key => $item)
                                                <span>{{ $item->bonusadi }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $bonusekleme->oyun_adi ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bonusekleme->yatirim ?? '' }}
                                        </td>
                                        <td>
                                            @can('bonusekleme_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.bonuseklemes.show', $bonusekleme->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bonusekleme_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.bonuseklemes.edit', $bonusekleme->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bonusekleme_delete')
                                                <form action="{{ route('frontend.bonuseklemes.destroy', $bonusekleme->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('bonusekleme_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.bonuseklemes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Bonusekleme:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection