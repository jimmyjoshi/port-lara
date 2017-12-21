@extends ('backend.layouts.app')

@section ('title', isset($title) ? $title : 'Edit Entity')

@section('page-header')
    <h1>
        Entity
        <small>Edit</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($item, ['route' => [$repository->getActionRoute('updateRoute'), $item], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Entity</h3>
                    <div class="box-tools pull-right">
                        @include('common.company.header-buttons', ['listRoute' => $repository->getActionRoute('listRoute'), 'createRoute' => $repository->getActionRoute('createRoute')])
                    </div>
            </div>

            @include('common.company.form')
            
        </div>

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route($repository->getActionRoute('listRoute'), 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
                </div>

                <div class="pull-right">
                    {{ Form::submit('Update', ['class' => 'btn btn-success btn-xs']) }}
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    {{ Form::close() }}
@endsection