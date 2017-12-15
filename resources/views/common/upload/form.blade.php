<div class="box-body">
    <div class="form-group">
        {{ Form::label('name', 'Upload Title :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Entity Title', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('category_id', 'Choose Category :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('category_id', $documentCategory->getSelectOptions('id', 'title') , null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('doc_type', 'Select Document Level :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('doc_type', [1 => 'Internal', 2 => 'External'],  null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>


<div class="box-body">
    <div class="form-group">
        {{ Form::label('upload_file', 'Upload Media :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::file('upload_file') }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('external_link', 'External Link :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('external_link', null, ['class' => 'form-control', 'placeholder' => 'External Link']) }}
        </div>
    </div>
</div>