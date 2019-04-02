@section('content')
    {!! Form::model($category, ['class' => '','url' => $url, 'method' => 'post']) !!}
    <div class="card card-default">
        <div class="card-header">
            New Category
        </div>
        <div class="card-body">

            <div class="form-group">
                {!! Form::label('label', 'Title', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'has-slug form-control','data-slug_target' => "#slug"]) !!}
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop