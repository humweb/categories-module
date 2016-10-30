@extends('layouts.master')
@section('content')
<div class="panel panel-default panel-nestable panel-sidebar">
    <div class="panel-heading">
        <div class="loading hidden"></div>
        <a href="{{route('admin.category.create')}}"
           class="modal-link btn btn-success btn-xs"
           data-title="Create Item"
           data-label="Save"
           data-icon="align-justify">
            <i class="fa fa-plus"></i> Category
        </a>
        <div class="pull-right">
            <a href="#" data-action="expandAll" class="nestable_action btn  btn-primary-outline btn-xs">
                <i class="fa fa-chevron-down"></i>
            </a>
            <a href="#" data-action="collapseAll" class="nestable_action btn btn-primary-outline btn-xs">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="panel-body">
        <div id="nestable-container" class="dd"><h3>Yeahh!</h3>{!! $tree !!}</div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.panel-nestable').mbNestable({
            url: {
                data: '{{route('admin.category.data')}}',
                move: '{{route('admin.category.move')}}',
                delete: '{{route('admin.category.destroy', ['category' => '__ID__'])}}'
            },
            max_depth: 5,
            csrf_token: '{{ csrf_token() }}'
        });

    });
</script>
@stop