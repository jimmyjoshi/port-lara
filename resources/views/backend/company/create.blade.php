@extends ('backend.layouts.app')

@section ('title', isset($repository->moduleTitle) ? 'Create - '. $repository->moduleTitle : 'Create')

@section('page-header')
    <h1>
        {{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }}
        <small>Create</small>
    </h1>
@endsection

@section('content')
    {{ Form::open([
        'route'     => $repository->getActionRoute('storeRoute'),
        'class'     => 'form-horizontal',
        'role'      => 'form',
        'method'    => 'post',
        'files'     => true
    ])}}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Create {{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }}</h3>

                <div class="box-tools pull-right">
                    @include('common.company.header-buttons', [
                        'listRoute'     => $repository->getActionRoute('listRoute'),
                        'createRoute'   => $repository->getActionRoute('createRoute')
                    ])
                </div>
            </div>

            {{-- contact Form --}}
            @include('common.company.form')
            
        </div>

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route($repository->getActionRoute('listRoute'), 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
                </div>

                <div class="pull-right">
                    {{ Form::submit('Create', ['class' => 'btn btn-success btn-xs']) }}
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    {{ Form::close() }}
@endsection

@section('after-scripts')

    <script>
        var getEntitiesUrl = '{!! route('admin.entities.get-by-user-id') !!}';

        jQuery(document).ready(function()
        {
            document.getElementById("fund_id").innerHTML = '';
            bindSelectUserEvent();
        });

        function bindSelectUserEvent()
        {
            jQuery("#user_id").on('change', function()
            {
                resetFunds();
            });
        }

        function resetFunds()
        {
            jQuery.ajax({
                url:        getEntitiesUrl,
                method:     'POST',
                dataType:   'JSON',
                data: {
                    userId: jQuery("#user_id").val()
                },
                success: function(data)
                {
                    if(data.status == true)
                    {
                        setFunOptions(data.funds);
                    }
                    
                },
                error: function(data)
                {
                  console.log(data);  
                }
            });
        }

        function setFunOptions(data)
        {
            var selectElement = document.getElementById("fund_id"),
                option;

            selectElement.innerHTML = '';

            option = document.createElement('option');

            option.text = 'Select Fund';
            option.value = '';

            selectElement.add(option);


            for(var i = 0; i < data.length; i++)
            {
                option = document.createElement('option');

                option.text     = data[i].title;
                option.value    = data[i].id;

                selectElement.add(option);
            }
        }
    </script>
@endsection