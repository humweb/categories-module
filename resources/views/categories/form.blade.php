@extends('layouts.master')
@section('content')
    {!! Form::model($category,['class' => '','url' => $url, 'method' => $method]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            New Category <div class="pull-right">Parent <span class="label label-default">{{ $parentName }}</span></div>
        </div>
        <div class="panel-body">

            <div class="form-group">
                {!! Form::label('label', 'Title', ['class' => 'control-label']) !!}
                {!! Form::text('title', null, ['class' => 'has-slug form-control','data-slug_target' => "#slug"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop